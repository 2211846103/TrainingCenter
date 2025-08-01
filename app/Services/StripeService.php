<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Carbon;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;

class StripeService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createCourseProduct(string $name, string $description, int $amount, string $currency = 'usd')
    {
        $product = Product::create([
            'name' => $name,
            'description' => $description,
            'images' => [],
        ]);

        $price = Price::create([
            'product' => $product->id,
            'unit_amount' => $amount,
            'currency' => $currency,
        ]);

        return [
            'product_id' => $product->id,
            'price_id' => $price->id
        ];
    }

    public function getMonthlyRevenue()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->timestamp;
        $endOfMonth = Carbon::now()->endOfMonth()->timestamp;

        $revenue = 0;
        $hasMore = true;
        $startingAfter = null;

        while ($hasMore) {
            $params = [
                'created' => [
                    'gte' => $startOfMonth,
                    'lte' =>$endOfMonth
                ],
                'limit' => 100,
            ];

            if ($startingAfter) {
                $params['starting_after'] = $startingAfter;
            }
            $payments = PaymentIntent::all($params);

            foreach ($payments->data as $payment) {
                if ($payment->status === 'succeeded') {
                    $revenue += $payment->amount_received;
                }
            }

            $hasMore = $payments->has_more;
            $startingAfter = $hasMore ? end($payments->data)->id : null;
        }

        return $revenue / 100;
    }
}
