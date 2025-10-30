<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Collection;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $userid = Auth::user()->id;
                $user = User::where('id', $userid)->first();
                if ($user->role == 2) {
                    $users = User::where('id', $userid)->first();
                    $notification = $users->unreadNotifications;
                    view()->share('notifications', $notification);
                } else {
                }
            }

        });
        $collections = Collection::where('status', 1)->where('active', 1)->orderByRaw('CAST(order_no AS UNSIGNED) ASC')->get();
        view()->share('collections', $collections);


        
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Please Verify Your Email Address')
                // ->line('Click the button below to verify your email address.')
                // ->action('Verify Email Address', $url);
                ->view('frontend.emails.email-verification',[
                    'url' => $url,
                    'user' => $notifiable
                ]);
        });
    }
}
