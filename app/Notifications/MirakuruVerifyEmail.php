<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Lang;

class MirakuruVerifyEmail extends VerifyEmail
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      $verificationUrl = $this->verificationUrl($notifiable);

      if (static::$toMailCallback) {
          return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
      }

      return (new MailMessage)
          ->subject(Lang::get('Hostal Mirakuru Gran Familia: Verify Email Address'))
          ->greeting(Lang::get('Welcome to our hostal web'))
          ->line(Lang::get('Please click the button below to verify your email address.'))
          ->action(Lang::get('Verify Email Address'), $verificationUrl)
          ->line(Lang::get('If you did not create an account, no further action is required.'))
          ->line(Lang::get('Thank you for using our application!'))
          ->salutation(Lang::get('Greetings, '. config('app.name')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
