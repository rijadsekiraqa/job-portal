<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AnnouncementStatusNotification extends Notification
{
    use Queueable;

    protected $announcement;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($announcement, $status)
    {
        $this->announcement = $announcement;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Store the notification in the database.
     */
    public function toDatabase($notifiable)
    {
        $statusMessages = [
            'approved' => 'është aprovuar.',
            'canceled' => 'është refuzuar.',
            'expired' => 'ka skaduar.',
        ];

        return [
            'title' => 'Shpallja:', // Static title
            'message' => '"' . $this->announcement->job_title . '" ' . $statusMessages[$this->status],
            'link' => route('announcements.show', $this->announcement->id),
            'is_read' => 0,
        ];
    }
}
