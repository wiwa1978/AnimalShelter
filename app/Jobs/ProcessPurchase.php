<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stripe\PaymentIntent;

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
    }
}
