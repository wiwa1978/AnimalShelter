<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Animal;
use App\Models\Purchase;
use Stripe\PaymentIntent;
use Illuminate\Bus\Queueable;
use App\Enums\AnimalPublishState;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessPurchase implements ShouldQueue
{
    protected $paymentIntent;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(PaymentIntent $paymentIntent)
    {
        $this->paymentIntent = $paymentIntent;
    }

    public function handle(): void
    {
        $metadata = $this->paymentIntent->metadata;
        $purchase_price   = $this->paymentIntent->amount_received;

        Purchase::create([
            'animal_id'         => $metadata->animal_id,
            'user_id'           => $metadata->user_id,
            'purchase_price'    => $purchase_price,
            'purchase_date'     => Carbon::now(),
        ]);

        $animal = Animal::find($metadata->animal_id);
        $animal->published_state = AnimalPublishState::Published;
        $animal->published_at = Carbon::now()->format('Y-m-d H:i:s');
        $animal->save();
    }
}
