<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Institute;
use App\Models\InstitutePlan;
use Carbon\Carbon;
use App\Models\Package;

class CustomDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now();

        // Total institutes
        $totalListings = Institute::count();

        // Free plan (active)
        $freeListings = Institute::whereHas('activePlan', function($q) {
            $q->whereHas('plan', function($p) {
                $p->where('name', 'Free'); // assuming package name
            })
            ->where('plan_status', 'completed')
            ->where('expiry_date', '>=', now());
        })->count();

        // Standard plan (active)
        $standardListings = Institute::whereHas('activePlan', function($q) {
            $q->whereHas('plan', function($p) {
                $p->where('name', 'Standard');
            })
            ->where('plan_status', 'completed')
            ->where('expiry_date', '>=', now());
        })->count();

        // Premium plan (active)
        $premiumListings = Institute::whereHas('activePlan', function($q) {
            $q->whereHas('plan', function($p) {
                $p->where('name', 'Premium');
            })
            ->where('plan_status', 'completed')
            ->where('expiry_date', '>=', now());
        })->count();

        return view('admin.dashboard',  compact(
        'totalListings',
        'freeListings',
        'standardListings',
        'premiumListings'
    ));
    }
}
