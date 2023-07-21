<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->greeting('Hallo!')
                ->salutation('Viele Grüße')
                ->subject('E-Mail Adresse verifizieren')
                ->line('Klicke auf den Knopf, um deine E-Mail Adresse zu verifizieren.')
                ->action('Verifizieren', $url);
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->greeting('Hallo')
                ->salutation('Viele Grüße')
                ->subject('Passwort zurücksetzen')
                ->line('Klicke auf den Knopf, um dein Passwort zurückzusetzen.')
                ->action('Passwort zurücksetzen', $url);
        });
    }
}
