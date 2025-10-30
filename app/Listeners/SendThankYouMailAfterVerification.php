<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use App\Mail\UserWelcomeMail;
use Illuminate\Support\Facades\Mail;

class SendThankYouMailAfterVerification
{
    public function handle(Verified $event)
    {
        $user = $event->user;
        Mail::to($user->email)->queue(new UserWelcomeMail($user));
    }
}
