<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Institute;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class CustomDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now();

        // Total institutes
        $totalListings = Institute::count();

        // Free plan (active)
        $freeListings = Institute::whereHas('activePlan', function ($q) {
            $q->whereHas('plan', function ($p) {
                $p->where('name', 'Free'); // assuming package name
            })
                ->where('plan_status', 'completed')
                ->where('expiry_date', '>=', now());
        })->count();

        // Standard plan (active)
        $standardListings = Institute::whereHas('activePlan', function ($q) {
            $q->whereHas('plan', function ($p) {
                $p->where('name', 'Standard');
            })
                ->where('plan_status', 'completed')
                ->where('expiry_date', '>=', now());
        })->count();

        // Premium plan (active)
        $premiumListings = Institute::whereHas('activePlan', function ($q) {
            $q->whereHas('plan', function ($p) {
                $p->where('name', 'Premium');
            })
                ->where('plan_status', 'completed')
                ->where('expiry_date', '>=', now());
        })->count();

        return view('admin.dashboard', compact(
            'totalListings',
            'freeListings',
            'standardListings',
            'premiumListings'
        ));
    }

    public function profileSetting()
    {
        $user = Auth::user();
        return view('admin.profile-setting', compact('user'));
    }

    public function updateProfileSetting(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // password update
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        // image upload
        if ($request->hasFile('image')) {

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->extension();

            $data['avatar'] = $file->storeAs('users', $filename, 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profile Updated');
    }
}
