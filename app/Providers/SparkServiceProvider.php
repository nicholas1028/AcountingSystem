<?php

namespace App\Providers;

use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [

        'vendor' => 'AvanSaber Inc',
        'product' => 'Pi.TEAM',
        'street' => '2035 Sunset Lake RD Suite B-2',
        'location' => 'Newark, DE 19702',
        'phone' => '+1 408 398 6759',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = 'support@pi.team';

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        //
        'mailnike@gmail.com'
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        Spark::useStripe()->noCardUpFront()->teamTrialDays(360);


        Spark::freeTeamPlan('Free', 'free')
            ->features([
                'Single User License', 'Invoice Management', 'Inventory Management', 'Ledger Management', 'Email support', 'Get Paid - Credit / Debit Cards - NetBanking', 'Reports and Dashboard'
            ])
            ->maxTeams(1)
            ->maxTeamMembers(1);


        Spark::teamPlan('Basic', 'basic')
            ->price(5.00)
            ->archived()
            ->maxTeams(1)
            ->maxTeamMembers(1)
            ->features([
                'Single User License', 'Invoice Management', 'Inventory Management', 'Ledger Management', 'Email support', 'Get Paid - Credit / Debit Cards - NetBanking', 'Reports and Dashboard'
            ]);

        Spark::useTwoFactorAuth();

        Spark::collectBillingAddress();
    }

    /**
     *
     *
     * @return void
     */
    public function register()
    {
        Spark::referToTeamAs('company');
    }
}
