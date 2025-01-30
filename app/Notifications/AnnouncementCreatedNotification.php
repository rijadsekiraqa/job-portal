<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AnnouncementCreatedNotification extends Notification
{
    use Queueable;

    protected $announcement;

    /**
     * Create a new notification instance.
     */
    public function __construct($announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Një Shpallje e Re u Krijua')
            ->line('Një shpallje e re u krijua: ' . $this->announcement->job_title)
            ->action('Shiko Shpalljen', url('/announcements/' . $this->announcement->id))
            ->line('Faleminderit për përdorimin e aplikacionit tonë!');
    }

    /**
     * Store the notification in the database.
     */
    public function toDatabase($notifiable)
    {
        $notificationData = [
            'title' => $this->announcement->user->name . ' ' . $this->announcement->user->lastname . ' krijoi një shpallje me titull:',
            'message' => $this->announcement->job_title,
            'is_read' => 0,
        ];

        // Generate the correct link based on the user role
        if ($notifiable->hasRole('super-admin')) {
            // Super-admin link to manage the announcement
            $notificationData['link'] = route('announcements.view', ['id' => $this->announcement->id]);
        } else {
            // Employee link to view the announcement
            $notificationData['link'] = route('announcements.show', ['announcement' => $this->announcement->id]);
        }

        return $notificationData;
    }
}
