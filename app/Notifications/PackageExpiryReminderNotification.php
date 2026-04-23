<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PackageExpiryReminderNotification extends Notification
{
     use Queueable;

    public function __construct(public $plan, public $daysLeft) {}

    public function via($notifiable)
    {
        return ['database']; // future me 'mail' add kar sakte ho
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'plan_expiry_reminder',
            'message' => "Your plan '{$this->plan->plan->name}' will expire in {$this->daysLeft} day(s).",
            'plan_id' => $this->plan->id,
            'expiry_date' => $this->plan->expiry_date->toDateString(),
        ];
    }
}