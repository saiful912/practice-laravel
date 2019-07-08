<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Dear ' . $this->user->full_name)
            ->line('Your account has been created successfully! Please verify your account to login.')
            ->action('Click to Verify Your Account', route('verify', $this->user->email_verification_token))
            ->line('Thank you for using our application!')
            ->line('- LLC Team');
    }


    //    public function toNexmo($notifiable)
//    {
//        return (new NexmoMessage())
//            ->content('Dear ' . $this->user->full_name . '. Your account is registered. - LLC Team');
//    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array|NexmoMessage
     */
    public function toArray($notifiable)
    {
        return [

        ];
    }
}
