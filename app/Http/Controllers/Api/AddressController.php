<?php


namespace App\Http\Controllers\Api;


use App\Models\Address;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;

class AddressController extends ApiController
{
    function getAddressFromCoordinate(){
        $lat = request('lat', false);
        $lng = request('lng', false);
        if(!$lat || !$lng){
            return $this->error(['errors' => 'getAddressFromCoordinate'], 'Invalid Request.');
        }

        try{
            $client = new Client();
            $api_key = env('GOOGLE_API_KEY');
            $request_url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${api_key}";

            $response = $client->request('GET', $request_url);
            $data = json_decode((string)$response->getBody(), true);

            return $this->success($data['results'][0]);
        } catch (\Exception $e){
            return $this->error(['error' => 'getAddressFromCoordinate'], $e->getMessage());
        } catch (GuzzleException $e) {
            return $this->error(['error' => 'getAddressFromCoordinate'], $e->getMessage());
        }

    }

    function list(){
        $user_id = Auth::id();
        $items = Address::query()->where('user_id', $user_id)->get()->toArray();

        return $this->success($items);
    }
}
