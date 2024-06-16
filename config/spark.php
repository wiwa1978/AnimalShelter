<?php

use Spark\Features;
use App\Models\User;
use App\Models\Organization;

return [

    /*
    |--------------------------------------------------------------------------
    | Spark Path
    |--------------------------------------------------------------------------
    |
    | This configuration option determines the URI at which the Spark billing
    | portal is available. You are free to change this URI to a value that
    | you prefer. You shall link to this location from your application.
    |
    */

    'path' => 'billing',

    'dashboard_url' => '/app',

    /*
    |--------------------------------------------------------------------------
    | Spark Middleware
    |--------------------------------------------------------------------------
    |
    | These are the middleware that requests to the Spark billing portal must
    | pass through before being accepted. Typically, the default list that
    | is defined below should be suitable for most Laravel applications.
    |
    */

    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    |
    | These configuration values allow you to customize the branding of the
    | billing portal, including the primary color and the logo that will
    | be displayed within the billing portal. This logo value must be
    | the absolute path to an SVG logo within the local filesystem.
    |
    */

    // 'brand' =>  [
    //     'logo' => realpath(__DIR__.'/../public/svg/billing-logo.svg'),
    //     'color' => 'bg-gray-800',
    // ],

    /*
    |--------------------------------------------------------------------------
    | Proration Behavior
    |--------------------------------------------------------------------------
    |
    | This value determines if charges are prorated when making adjustments
    | to a plan such as incrementing or decrementing the quantity of the
    | plan. This also determines proration behavior if changing plans.
    |
    */

    'prorates' => true,

    /*
    |--------------------------------------------------------------------------
    | Spark Date Format
    |--------------------------------------------------------------------------
    |
    | This date format will be utilized by Spark to format dates in various
    | locations within the billing portal, such as while showing invoice
    | dates. You should customize the format based on your own locale.
    |
    */

    'date_format' => 'F j, Y',

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Some of Spark's features are optional. You may disable the features by
    | removing them from this array. By removing features from this array
    | you can customize your Spark experience for your own application.
    |
    */

    'features' => [
        Features::billingAddressCollection(['required' => true]),
        // Features::mustAcceptTerms(),
        Features::euVatCollection(['home-country' => 'BE']),
        Features::invoiceEmails(['custom-addresses' => true]),
        Features::paymentNotificationEmails(),
    ],

    /*
    |--------------------------------------------------------------------------
    | Invoice Configuration
    |--------------------------------------------------------------------------
    |
    | The following configuration options allow you to configure the data that
    | appears in PDF invoices generated by Spark. Typically, this data will
    | include a company name as well as your company contact information.
    |
    */

    'invoice_data' => [
        'vendor' => 'Your Product',
        'product' => 'Your Product',
        'street' => '111 Example St.',
        'location' => 'Los Angeles, CA',
        'phone' => '555-555-5555',
    ],

    /*
    |--------------------------------------------------------------------------
    | Spark Billable
    |--------------------------------------------------------------------------
    |
    | Below you may define billable entities supported by your Spark driven
    | application. The Stripe edition of Spark currently only supports a
    | single billable model entity (team, user, etc.) per application.
    |
    | In addition to defining your billable entity, you may also define its
    | plans and the plan's features, including a short description of it
    | as well as a "bullet point" listing of its distinctive features.
    |
    */

    'billables' => [

        'organization' => [
            'model' => Organization::class,

            'trial_days' => 0,

            'default_interval' => 'monthly',

            'plans' => [
                [
                    'name' => 'Free Plan',
                    'short_description' => 'This is the fallback free plan.',
                    'monthly_id' => 'price_1P5tRP21JyPRVPKfrt4JmGeN',
                    'yearly_id' => 'price_1P5tSI21JyPRVPKfdCqROLI5',
                    'features' => [
                        '1 user in your organization',
                        '1 animal',
                    ],
                    'options' => [
                        'animals' => 1000,
                        'users' => 1000
                    ],
                    // IMPORTANT
                    'archived' => true,
                    
                ],
                // [
                //     'name' => 'Bronze',
                //     'short_description' => 'This is the bronze plan.',
                //     'monthly_id' => 'price_1P5tRP21JyPRVPKfrt4JmGeN',
                //     'yearly_id' => 'price_1P5tSI21JyPRVPKfdCqROLI5',
                //     'features' => [
                //         '1 user in your organization',
                //         '1 animal',
                //     ],
                //     'options' => [
                //         'animals' => 1,
                //         'users' => 1
                //     ],
                //     'archived' => false,
                // ],
                // [
                //     'name' => 'Silver',
                //     'short_description' => 'This is the silver plan.',
                //     'monthly_id' => 'price_1P5tUf21JyPRVPKfm5lt38ry',
                //     'yearly_id' => 'price_1P2wlF21JyPRVPKfQofPAXhY',
                //     'features' => [
                //         'Up to 2 users in your organization',
                //         'Up to 3 animals',
                //     ],
                //     'options' => [
                //         'animals' => 3,
                //         'users' => 1
                //     ],
                //     'archived' => false,
                // ],
                // [
                //     'name' => 'Gold',
                //     'short_description' => 'This is the gold plan.',
                //     'monthly_id' => 'price_1P5tW221JyPRVPKfqpeG7sXn',
                //     'yearly_id' => 'price_1P2wmG21JyPRVPKfVzJGtlXw',
                //     'features' => [
                //         'Unlimited users in your organization',
                //         'Upload unlimited animals',
                //     ],
                //     'options' => [
                //         'animals' => 1000,
                //         'users' => 1000
                //     ],
                //     'archived' => false,
                // ],
            ],

        ],
    ],
];
