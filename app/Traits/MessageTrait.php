<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Notification;
use App\Notifications\NewsletterNotification;

trait MessageTrait
{
    public function contactSend($datos){


      return (new MailMessage)
         ->subject(Lang::get('Request Contact '.$datos['name'].' ,email: '.$datos['email']))
         ->to('hostalgranfamilia@gmail.com','Arasay Rodriguez Bastida')
         ->from($datos['email'],$datos['name'])
         ->line(Lang::get('You are receiving a new contact email with content: '))
         ->line(Lang::get($datos['content']))
         ->line(Lang::get('Please, send an answare as soon like is possible for you.'))
         ->salutation(Lang::get('Greetings, '. config('app.name')));
    }

    public function newsletterSend($suscripcion,$hostal){

      $email=$suscripcion->email;
      $suscripcion_id=$suscripcion->id;

      $url=url(route('unsubscribe',['suscriptor'=>$suscripcion_id,'hostal'=>$hostal]));
      $newsletter_id=$suscripcion_id.$hostal;
      $data=['url'=>$url,'email'=>$email];

                $newsData = [
                       'name' => $email,
                       'email'=>$email,
                       'body' => Lang::get('Thank you for subscribe!'),
                       'thanks' => Lang::get('Greetings, '. config('app.name')),
                       'newsText' => Lang::get('If you did not subscribe link this url for unsubscribe'),
                       'newsUrl' => $url,
                       'action_text'=> Lang::get('Unsubscribe'),
                       'newsletter_id' => $newsletter_id
                   ];

                   Notification::route('mail', $email)
                                 ->notify(new NewsletterNotification($newsData));

                   dd('Task completed!');
    }
}
