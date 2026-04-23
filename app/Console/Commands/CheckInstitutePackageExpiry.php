<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\InstitutePlan;
use App\Notifications\PackageExpiredNotification;
use App\Notifications\PackageExpiryReminderNotification;

class CheckInstitutePackageExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-institute-package-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // All active plans
        $plans = InstitutePlan::with('institute')
            ->where('plan_status', 'completed')
            ->get();

        foreach ($plans as $plan) {

            if (!$plan->institute) continue;

            $daysLeft = $today->diffInDays($plan->expiry_date, false);

            if ($daysLeft < 0) continue;

            // Reminder per plan
            if (in_array($daysLeft, [15, 7, 3])) {
                $plan->institute->notify(
                    new PackageExpiryReminderNotification($plan, $daysLeft)
                );
            }

            // Expired per plan
            if ($daysLeft == 0) {
                $plan->update(['plan_status' => 'expired']);

                $plan->institute->notify(
                    new PackageExpiredNotification($plan)
                );
            }
        }
    }
}
