<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\InstitutePlan;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InstitutePlanController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'institute_id' => 'required',
            'plan_id' => 'required'
        ]);

        $plan = Package::findOrFail($request->plan_id);

        $institutePlan = InstitutePlan::updateOrCreate(
            ['institute_id' => $request->institute_id],
            [
                'plan_id' => $request->plan_id,
                'price' => $plan->offered_price
            ]
        );

        if ($plan->offered_price == 0) {
            $institutePlan->update([
                'start_date' => now(),
                'plan_status' => 'completed',
                'expiry_date' => now()->addDays(365)
            ]);
        }

        return response()->json([
            'status' => true,
            'plan' => $plan
        ]);
    }

    public function upgradePlan(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:packages,id'
        ]);

        $instituteId = auth('institute')->id();
        $newPlan = Package::findOrFail($request->plan_id);

        $existingPlan = InstitutePlan::where('institute_id', $instituteId)->first();

        // ===============================
        // ✅ CHECK EXISTING PLAN
        // ===============================
        if ($existingPlan) {

            $currentPlan = Package::find($existingPlan->plan_id);
            $isExpired = $existingPlan->expiry_date && $existingPlan->expiry_date < now();

            // ❌ SAME PLAN (ONLY BLOCK IF ACTIVE)
            if (
                $existingPlan->plan_id == $newPlan->id &&
                $existingPlan->plan_status == 'completed' &&
                !$isExpired
            ) {
                return response()->json([
                    'status' => false,
                    'message' => 'Already active plan'
                ]);
            }

            // ❌ DOWNGRADE BLOCK
            if ($currentPlan && $newPlan->offered_price < $currentPlan->offered_price) {
                return response()->json([
                    'status' => false,
                    'message' => 'Downgrade not allowed'
                ]);
            }
        }

        // ===============================
        // ✅ UPDATE PLAN (FOR PAYMENT FLOW)
        // ===============================
        $institutePlan = InstitutePlan::updateOrCreate(
            ['institute_id' => $instituteId],
            [
                'plan_id' => $newPlan->id,
                'price' => $newPlan->offered_price,
                'plan_status' => 'pending',
                'expiry_date' => null // reset until payment success
            ]
        );

        return response()->json([
            'status' => true,
            'institute_id' => $instituteId
        ]);
    }

}