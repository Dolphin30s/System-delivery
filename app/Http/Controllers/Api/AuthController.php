<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index()
    {
        $member = Auth::user();
        $data = array_filter($member->getAttributes(), function($key) {
            return !in_array($key, ['password', 'id', 'remember_token']);
        }, ARRAY_FILTER_USE_KEY);
        return $this->success($data);
    }

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'phone' => 'required',
            //'email' => 'email',
            'gender' => 'required',
            'birthday' => 'required',
            'cc2' => 'required',
            'password' => 'required|min:3'
        ]);
        if ($v->fails())
        {
            return $this->error(['errors' => $v->errors()], 'Registration failed.', 422);
        }
        $user = $this->create($request->all());
        return $this->success();
    }

    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        if ($token = $this->guard()->attempt($credentials, true)) {
            return $this->success()->header('Authorization', $token)->cookie('token', $token);
        }
        return $this->error(['error' => 'login_error'], 'Login failed', 401);
    }

    public function logout()
    {
        $this->guard()->logout();
        return $this->success([], 'Logged out successfully');
    }

    public function refresh(Request $request)
    {
        try{
            if ($token = $this->guard()->refresh()) {
                return response()
                    ->json(['status' => 'successs'], 200)
                    ->header('Authorization', $token);
            }
        } catch (\Exception $e){

        }
        return $this->error(['error' => 'refresh_token_error'], 'Refresh token failed.', 401);
    }

    public function me(Request $request)
    {

    }

    public function verify(Request $request)
    {

    }

    public function resend(Request $request)
    {

    }

    /**
     * @return \Illuminate\Contracts\Auth\Guard
     */
    private function guard()
    {
        return Auth::guard('api');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'role' => User::USER_ROLE_CUSTOMER,
            'birth_date' => $data['birthday'],
            'gender' => $data['gender'],
            'picid' => '0_0',
            'cc2' => $data['cc2'],
            'valid' => true
        ]);
    }

}
