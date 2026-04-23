<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PackageExpiredNotification extends Notification
{
     use Queueable;

    public function __construct(public $plan) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'plan_expired',
            'message' => "Your plan '{$this->plan->plan->name}' has expired today.",
            'plan_id' => $this->plan->id,
            'expiry_date' => $this->plan->expiry_date->toDateString(),
        ];
    }
}
