<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Notification;
use App\Notifications\NewsletterNotification;
use App\Notifications\ConfirmReservaNotification;

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

    public function confirmReservationSend($datos){
      $url=url(route('confirm-reservation',['token'=>$datos['token'],'reservation'=>$datos['reserva'],'user'=>$datos['user_id']]));
      $data=['url'=>$url,'email'=>$datos['email']];
      $newsData = [
             'name' => $datos['name'],
             'email'=>$datos['email'],
             'body' => Lang::get('Excellent!!'),
             'thanks' => Lang::get('Greetings, '. config('app.name')),
             'newsText' => Lang::get('You have made a pre-reservation at our hostel, we will be very happy to welcome you home. To continue with the missing details, please access the link below:'),
             'newsText1' => Lang::get('If you did not make a pre-reservation, no further action is required.'),
             'newTextBye'=>Lang::get('Thank you for using our application!'),
             'newsUrl' => $url,
             'action_text'=> Lang::get('Confirm'),
         ];
         return Notification::route('mail', $datos['email'])
                       ->notify(new ConfirmReservaNotification($newsData));

    }
}
