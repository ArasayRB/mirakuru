<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MakeReviewNotification extends Notification
{
    use Queueable;
    private $dataNews;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($dataNews)
    {
        $this->dataNews=$dataNews;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      return (new MailMessage)
                  ->subject($this->dataNews['name'])
                  ->line($this->dataNews['body'])
                  ->line($this->dataNews['newsText'])
                  ->action($this->dataNews['action_text'], $this->dataNews['newsUrl'])
                  ->line($this->dataNews['newsText1'])
                  ->line($this->dataNews['newTextBye'])
                  ->salutation($this->dataNews['thanks']);
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
