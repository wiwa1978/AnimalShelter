<?php

namespace App\Filament\Admin\Resources\AnimalResource\Pages;

use App\Models\User;
use NumberFormatter;
use Stripe\Customer;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Filament\Resources\Pages\Page;
use App\Filament\Admin\Resources\AnimalResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class Checkout extends Page
{
    use InteractsWithRecord;

    protected static string $resource = AnimalResource::class;

    protected static string $view = 'filament.admin.resources.animal-resource.pages.checkout';

    protected StripeClient $stripe;
    protected string $checkoutKey;
    public string $clientSecret;



    public function mount(int | string $record): void
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);


        $this->record     = $this->resolveRecord($record);
        $this->heading    = 'Checkout: ' . $this->record->name;
        $this->subheading = $formatter->formatCurrency($this->record->publish_price / 100, 'eur');
        $this->checkoutKey = 'checkout.' . $this->record->id;
        $this->clientSecret = $this->getClientSecret();
    }

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    protected function getClientSecret(): string
    {
        $user          = auth()->user();
        $customer      = $this->getStripeCustomer($user);
        $paymentIntent = $this->getPaymentIntent($customer);

        return $paymentIntent->client_secret;
    }

    protected function getStripeCustomer(User $user): Customer
    {
        if ($user->stripe_customer_id !== null) {
            return $this->stripe->customers->retrieve($user->stripe_customer_id);
        }

        $customer = $this->stripe->customers->create([
            'name'  => $user->name,
            'email' => $user->email,
        ]);

        $user->update(['stripe_customer_id' => $customer->id]);

        return $customer;
    }

    protected function getPaymentIntent(Customer $customer): PaymentIntent
    {
        $paymentIntentId = session($this->checkoutKey);

        if ($paymentIntentId === null) {
            return $this->createNewPaymentIntent($customer);
        }

        $paymentIntent = $this->stripe->paymentIntents->retrieve($paymentIntentId);

        if ($paymentIntent->status !== 'requires_payment_method') {
            return $this->createNewPaymentIntent($customer);
        }

        if ($paymentIntent->status === 'processing') {
            return redirect()->route('filament.admin.pages.payment-status', [
                'payment_intent'               => $paymentIntent->id,
                'payment_intent_client_secret' => $paymentIntent->client_secret,
                'redirect_status'              => $paymentIntent->status,
            ]);
        }

        return $paymentIntent;
    }

    protected function createNewPaymentIntent(Customer $customer): PaymentIntent
    {
        //dd($this->record->id);
        $paymentIntent = $this->stripe->paymentIntents->create([
            'customer'           => $customer->id,
            'setup_future_usage' => 'off_session',
            'amount'             => $this->record->publish_price,
            'currency'           => config('services.stripe.currency'),
            'metadata'           => [
                'animal_id'  => $this->record->id,
                'user_id'    => auth()->id(),
            ],
        ]);

        session([$this->checkoutKey => $paymentIntent->id]);

        return $paymentIntent;
    }
}
