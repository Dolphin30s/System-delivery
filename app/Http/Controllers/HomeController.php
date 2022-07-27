<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Use Vue Auth Middleware
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($route = 'home')
    {
        return view('home', compact('route'));
    }

    public function request()
    {
        $type=request('type', 'full');
        switch ($type){
            case 'heavy':
                $title="Heavy-weight SOLUTION";
                $text="This delivery solution is designed solely for companies or individuals that are in need of delivery of heavy, big and bulky items. The tools and the right delivery agents are selected for this solution.";
                break;
            case 'race':
                $title="RELAY RACE SOLUTION";
                $text="The relay race solution is designed for long and extra long routes. For instance, a 600 miles gig can only be efficiently carried out only if it had been executed by a chain of fresh and energetic drivers. Therefore we make sure that a driver only carries parcels in the areas that he has 2 years of delivery experience in.";
                break;
            case 'demand':
                $title="On-Demand SOLUTION";
                $text="This section is for companies or individuals requesting same-day solutions, or require extra variables.";
                break;
            default:
                $title="Full services (WHITE GLOVE DELIVERY)";
                $text="We deliberately handpicked our finest delivery partner for this type of delivery. They are well trained and fitted to professionally install your parcel wherever you choose to.";
                break;
        }
        return view('request', compact('type', 'title', 'text'));
    }

    public function tracking(){
        return view('tracking');
    }

    public function track(){
        $tracking_no = request('tracking_no', '');
        $delivery = Delivery::query()->where('tracking_number', $tracking_no)->first();
        $order_detail = null;
        $tracking = null;
        if($delivery){
            $order = Order::query()->where('id', $delivery->order_id)->first();
            $address = Address::query()->where('id', $order->address_id)->first();
            $order_detail = [
                'order_id' => $order->id,
                'tracking_number' => $delivery->tracking_number,
                'order_status' => Order::getOrderStatusLabel($order->order_status),
                'delivery_address' => $address->address
            ];

            $histories = json_decode($delivery->history, true);
            $tracking = [
                [
                    'status' => 'Ordered',
                    'datetime' => date_format(date_create($order->purchase_date),'d/m/Y H:i')
                ]
            ];
            foreach ($histories as $item){
                array_push($tracking, [
                    'status' => Delivery::getShippingStatusLabel($item['status']),
                    'datetime' => date_format(date_create($item['datetime']),'d/m/Y H:i')
                ]);
            }
        }
        return view('tracking', compact('tracking_no', 'order_detail', 'tracking'));
    }
}
