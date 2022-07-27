<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends ApiController
{
    //
    public function list()
    {

        $user = Auth::user();

        $query = DB::table(DB::raw("orders o"))
            ->leftJoin(DB::raw("addresses a"), function ($join) {
                $join->on('a.id', 'o.address_id');
            })
            ->leftJoin(DB::raw("payments p"), function ($join) {
                $join->on('p.id', 'o.payment_id');
            });

        if($user->isCustomer()){
            $query->where('o.user_id', $user->id);
        } else if($user->isDeliverer()){

        }

        $orders = $query->selectRaw('o.id as id, o.order_status as order_status, o.number_shipped as number_shipped, o.order_total as order_total, o.purchase_date as purchase_date, o.address_id as shipping_address_id, a.address as shipping_address, a.name as shipping_name, a.phone_number as shipping_phone_number, o.payment_id as payment_id, p.type as payment_type, p.status as payment_status')
            ->orderBy('o.purchase_date', 'desc')
            ->get();

        $orders_list = [];
        foreach ($orders as $order) {
            $orders_list[] = [
                'id' => $order->id,
                'order_status' => $order->order_status,
                'number_shipped' => $order->number_shipped,
                'order_total' => $order->order_total,
                'purchase_date' => $order->purchase_date,
                'shipping_address' => [
                    'id' => $order->shipping_address_id,
                    'name' => $order->shipping_name,
                    'phone_number' => $order->shipping_phone_number,
                    'address' => $order->shipping_address,
                ],
                'payment' => [
                    'id' => $order->payment_id,
                    'type' => $order->payment_type,
                    'status' => $order->payment_status,
                ],
            ];
        }
        return $this->success($orders_list);
    }

    //
    public function create()
    {
        $address = request('address', false);
        $payment = request('payment', false);
        if (!$address || !$payment) {
            return $this->error(['error' => 'order_create'], 'Invalid request');
        }

        $user_id = Auth::id();

        DB::transaction(function () use ($user_id, $address, $payment) {
            if ($address['id']) {
                $shipping_address = Address::query()->where('id', $address['id'])->first();
            } else {
                $shipping_address = Address::query()->create([
                    'user_id' => $user_id,
                    'name' => $address['name'],
                    'phone_number' => $address['phone'],
                    'address' => $address['full_address'],
                    'latitude' => $address['lat'],
                    'longitude' => $address['lng'],
                ]);
            }

            $payment = Payment::query()->create([
                'user_id' => $user_id,
                'price' => $payment['price'],
                'delivery_fee' => $payment['delivery_fee'],
                'total' => $payment['total'],
                'type' => $payment['type'],
                'data' => json_encode($payment['data'], true),
                'status' => Payment::STATUS_PAYED,
            ]);

            $cart = Cart::query()->where('user_id', $user_id)->first();
            $products = $cart->products ? json_decode($cart->products, true) : [];

            $order = Order::query()->create([
                'user_id' => $user_id,
                'order_status' => Order::ORDER_STATUS_PURCHASED,
                'number_shipped' => 0,
                'order_total' => $payment['total'],
                'currency_code' => '$',
                'address_id' => $shipping_address->id,
                'payment_id' => $payment->id,
                'purchase_date' => now(),
            ]);

            foreach ($products as $p) {
                $product = Product::query()->where('id', $p['id'])->first();
                if (!$product) {
                    // todo
                    continue;
                }
                OrderItem::query()->create([
                    'user_id' => $user_id,
                    'order_id' => $order->id,
                    'title' => $product->title,
                    'sku' => $product->sku,
                    'quantity_ordered' => $p['quantity'],
                    'quantity_shipped' => 0,
                    'item_price' => $product->price,
                    'currency_code' => '$',
                    'image_url' => $product->image_url,
                    'fee' => 0,
                    'shipping_cost' => 0,
                ]);
            }

            $cart->delete();
        });

        return $this->success();
    }

    public function detail()
    {
        $order_id = request('id', false);
        if (!$order_id) {
            return $this->error(['error' => 'order_detail'], 'Invalid request');
        }

        $order = Order::query()->where('id', $order_id)->first();
        if (!$order) {
            return $this->success(null);
        }

        $user = Auth::user();
        if(!$user->isAdmin() && $order->user_id != $user->id){
            return $this->error(['error' => 'order_detail'], 'Invalid request');
        }

        $shipping = Address::query()->where('id', $order->address_id)->first();
        $payment = Payment::query()->where('id', $order->payment_id)->first();
        $delivery = Delivery::query()->where('order_id', $order->id)->first();

        $order_items = [];
        $items_total = 0;
        $order_data = OrderItem::query()->where('order_id', $order_id)->get();
        foreach ($order_data as $o) {
            $order_items[] = [
                'title' => $o->title,
                'sku' => $o->sku,
                'image_url' => $o->image_url,
                'quantity_ordered' => $o->quantity_ordered,
                'quantity_shipped' => $o->quantity_shipped,
                'item_price' => $o->item_price,
                'shipping_cost' => $o->shipping_cost
            ];
            $items_total += $o->item_price * $o->quantity_ordered;
        }

        // todo
        $delivery_fee = 0;

        $order_detail = [
            'id' => $order->id,
            'order_status' => $order->order_status,
            'items_total' => $items_total,
            'delivery_fee' => $delivery_fee,
            'order_total' => $order->order_total,
            'purchase_date' => $order->purchase_date,
            'order_items' => $order_items,
            'shipping' => [
                'name' => $shipping->name,
                'phone_number' => $shipping->phone_number,
                'address' => $shipping->address,
            ],
            'payment' => [
                'type' => $payment?$payment->type:'',
                'status' => $payment?$payment->status:'',
            ],
            'tracking' => $delivery?[
                'tracking_number' => $delivery->tracking_number,
                'shipping_status' => $delivery->shipping_status,
                'datetime' => $delivery->datetime,
                'history' => json_decode($delivery->history, true)
            ]:null,
            'customer' => []
        ];
        return $this->success($order_detail);
    }

    //
    public function updateStatus()
    {
        $order_id = request('order_id', false);
        $order_status = request('order_status', -1);
        if (!$order_id || $order_status == -1) {
            return $this->error(['error' => 'update_status'], 'Invalid request');
        }
        $order = Order::query()->where('id', $order_id)->first();
        if(!$order){
            return $this->error(['error' => 'order_update'], 'Invalid request');
        }
        $order->update([
            'order_status' => $order_status
        ]);
        return $this->success();
    }

    public function updateShipping()
    {
        $order_id = request('order_id', false);
        $tracking_number = request('tracking_number', false);
        $shipping_status = request('shipping_status', -1);
        $datetime = request('datetime', -1);
        if (!$order_id || !$tracking_number || $shipping_status == -1 || $datetime == -1) {
            return $this->error(['error' => 'update_shipping'], 'Invalid request');
        }
        $order = Order::query()->where('id', $order_id)->first();
        if(!$order){
            return $this->error(['error' => 'update_shipping'], 'Invalid request');
        }

        $shipping = Delivery::query()->where('order_id', $order_id)->first();
        if(!$shipping){
            Delivery::query()->create([
                'order_id' => $order_id,
                'tracking_number' => $tracking_number,
                'shipping_status' => $shipping_status,
                'longitude' => 0,
                'latitude' => 0,
                'datetime' => date_format(date_create($datetime),'Y-m-d H:i:s'),
                'history' => json_encode([[
                    'status' => $shipping_status,
                    'datetime' => $datetime
                ]])
            ]);
        } else if($shipping_status != $shipping->shipping_status){
            $history = $shipping->history?json_decode($shipping->history, true):[];
            array_push($history, [
                'status' => $shipping_status,
                'datetime' => $datetime
            ]);
            $shipping->update([
                'shipping_status' => $shipping_status,
                'datetime' => date_format(date_create($datetime),'Y-m-d H:i:s'),
                'history' => json_encode($history)
            ]);
        } else {
            $shipping->update([
                'datetime' => date_format(date_create($datetime),'Y-m-d H:i:s'),
            ]);
        }
        return $this->success();
    }

    // Payment
    public function getStripeIntent(){
        $price = request('price', false);
        if (!$price) {
            return $this->error(['error' => 'stripe_intent'], 'Invalid request');
        }

        /** @var PaymentService $paymentService */
        $paymentService = app('payment');
        return $this->success($paymentService->getStripePaymentIntent($price));
    }
}
