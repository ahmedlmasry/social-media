<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserFollowedNotification extends Notification
{
    use Queueable;
    public $follower;

    /**
     * Create a new notification instance.
     */
    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
            ->subject(__('notifications.follow.subject'))
            ->line(__('notifications.follow.line', [
                'username' => $this->follower->username
            ]))
            ->action(__('notifications.follow.action'),
                url('/users/' . $this->follower->username))
            ->line(__('notifications.thanks'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'follower_id' => $this->follower->id,
            'follower_username' => $this->follower->username,
            'message' => __('notifications.follow.line', [
                'username' => $this->follower->username
            ])
        ];
    }
}
