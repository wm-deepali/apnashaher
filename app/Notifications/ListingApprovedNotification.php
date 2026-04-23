<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ListingApprovedNotification extends Notification
{
     use Queueable;

    protected $instituteName;

    public function __construct($instituteName)
    {
        $this->instituteName = $instituteName;
    }

    // Only database channel
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message_title' => 'Your listing has been approved!',
            'message' => "Congratulations, {$this->instituteName}, your listing is now live.",
            'type' => 'Listing Approved',
        ];
    }
}