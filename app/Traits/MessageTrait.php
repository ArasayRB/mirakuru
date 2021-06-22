<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Notification;
use App\Notifications\NewsletterNotification;
use App\Notifications\ConfirmReservaNotification;
use App\Notifications\MakeReviewNotification;
use App\Notifications\DeleteNotification;
use App\Notifications\ContactoNotification;

trait MessageTrait
{
    public function contactSend($datos){
      $email=$datos->email;
      $contact_id=$datos->id;

                $newsData = [
                       'name' => Lang::get('Request Contact '.$datos['name'].' ,email: '.$datos['email']),
                       'email'=>$email,
                       'body' => Lang::get('You sended succefully this contact message to hoster: '),
                       'thanks' => Lang::get('Greetings, '. config('app.name')),
                       'newsText' => Lang::get($datos['mensage']),
                       'newsText1' => Lang::get('You go to receive very soon an answare.')
                   ];

                   Notification::route('mail', $email)
                                 ->notify(new ContactoNotification($newsData));
    }

    public function contactHosterSend($datos, $hostal){
      $email=$hostal[0]->email;
      $contact_id=$datos->id;

                $newsData = [
                       'name' => Lang::get('Request Contact '.$datos['name'].' ,email: '.$datos['email']),
                       'email'=>$email,
                       'body' => Lang::get('You are receiving a new contact email with content: '),
                       'thanks' => Lang::get('Greetings, '. config('app.name')),
                       'newsText' => Lang::get($datos['mensage']),
                       'newsText1' => Lang::get('Please, send an answare as soon like is possible for you.')
                   ];

                   Notification::route('mail', $email)
                                 ->notify(new ContactoNotification($newsData));
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

    public function reviewAdviceSend($datos){
      $url=url(route('home'));
      $newsData = [
             'name' => $datos['name'],
             'email'=>$datos['email'],
             'body' => Lang::get('Great!!'),
             'thanks' => Lang::get('Greetings, '. config('app.name')),
             'newsText' => Lang::get('We hope your days was you spended in our hostal magnificent very well. Can you share with other travelers your experience with our service? If you want  leave a review our hostal click in the below button please, we be greatfull of count with your opinion. Be WELCOME ALLWAYS!!'),
             'newsText1' => Lang::get('If you dont have a reservation finished with us, please you do not need do any thing with this email').'.',
             'newTextBye'=>Lang::get('Thank you for using our application!'),
             'newsUrl' => $url,
             'action_text'=> Lang::get('Go'),
         ];
         return Notification::route('mail', $datos['email'])
                       ->notify(new MakeReviewNotification($newsData));
    }

    public function discardReservationDelete($datos){
      $newsData = [
             'email'=>$datos['email'],
             'body' => Lang::get('Notification'),
             'thanks' => Lang::get('Greetings, '. config('app.name')),
             'newsText' => Lang::get('You receive this email because you just deleted a reservation: '.$datos['name']),
             'newsText1' => Lang::get('If you did not make this operation, no further action is required.'),
             'newTextBye'=>Lang::get('Thank you for using our application!'),
         ];
         return Notification::route('mail', $datos['email'])
                       ->notify(new DeleteNotification($newsData));
    }
}
