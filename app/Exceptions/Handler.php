<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Mail\Mailable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /*public function report(Exception $e)
{
    if ($e instanceof \Exception) {
        // Fetch the error information we would like to
        // send to the view for emailing
        $error['file']    = $e->getFile();
        $error['code']    = $e->getCode();
        $error['line']    = $e->getLine();
        $error['message'] = $e->getMessage();
        $error['trace']   = $e->getTrace();

        // Only send email reports on production server
        if(ENV('APP_ENV') == "production"){
            #1. Queue email for sending on "exceptions_emails" queue
            #2. Use the emails.exception_notif view shown below
            #3. Pass the error array to the view as variable $e
            Mail::queueOn('exception_emails', 'mail.exception_notif', ["e" => $error], function ($m) {
                $m->subject("Laravel Error");
                $m->from(ENV("MAIL_FROM"), ENV("MAIL_NAME"));
                $m->to("ing.arasay@gmail.com", "Webmaster");
            });

        }
    }

    // Pass the error on to continue processing
    return parent::report($e);
}*/
}
