<?php
namespace App\Services;

use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentService
{
    public static function getStripePaymentIntent($price) {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try{
            $intent = PaymentIntent::create([
                'amount' => $price * 100,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);
            return $intent->client_secret;
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
