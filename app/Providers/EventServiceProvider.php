<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(\Slides\Saml2\Events\SignedIn::class, function (\Slides\Saml2\Events\SignedIn $event) {

            $messageId = $event->getAuth()->getLastMessageId();

            // your own code preventing reuse of a $messageId to stop replay attacks
            $samlUser = $event->getSaml2User();

            $userData = [
                'id' => $samlUser->getUserId(),
                'attributes' => $samlUser->getAttributes(),
                'assertion' => $samlUser->getRawSamlAssertion()
            ];

            $inputs = [
                'sso_user_id'  => $samlUser->getUserId(),
                'username'     => $samlUser->getAttribute('http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name'),
                'email'        => $samlUser->getAttribute('http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress'),
                'first_name'   => $samlUser->getAttribute('http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname'),
                'last_name'    => $samlUser->getAttribute('http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname'),
                'password'     => Hash::make('anything'),
            ];
            $user = User::where('sso_user_id', $inputs['sso_user_id'])->first();

            if($user){
                Auth::login($user);

            }else{
                $user_new = User::create([

                    'name' => $inputs['first_name'][0],
                    'lastname' => $inputs['last_name'][0],
                    'email' => $inputs['email'][0],
                    'password' => $inputs['password'],
                    'identity_card' => '1111',
                    'estado_id' => '1',
                    'sso_user_id' =>  $inputs['sso_user_id'],
                    ])->assignRole('Usuario');
                Auth::login($user_new);

            }


            });



        Event::listen('Slides\Saml2\Events\SignedOut', function (SignedOut $event) {
            Auth::logout();
            Session::save();
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
