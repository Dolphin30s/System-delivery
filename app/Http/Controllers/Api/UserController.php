<?php


namespace App\Http\Controllers\Api;


use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    function index(){
        $id = request('id', 0);
        if(!$id){
            return $this->error(['error' => 'user_index'], 'Invalid request');
        }

        $product = User::query()->where('id', $id)->first(['id', 'name', 'email', 'phone', 'role', 'gender', 'birth_date', 'image_url', 'valid']);
        return $this->success($product);
    }

    function profile(){
        $id = Auth::id();
        if(!$id){
            return $this->error(['error' => 'user_index'], 'Invalid request');
        }

        $product = User::query()->where('id', $id)->first(['id', 'name', 'email', 'phone', 'role', 'gender', 'birth_date', 'image_url', 'valid', 'cc2']);
        return $this->success($product);
    }

    function list(){
        $items = User::query()->get(['id', 'name', 'email', 'phone', 'role', 'gender', 'birth_date', 'image_url', 'valid']);

        return $this->success($items);
    }

    function update(){
        $id = request('id', false);
        if(!$id){
            return $this->error(['error' => 'user_update'], 'Invalid request');
        }

        $updates = [];
        $valid = request('valid', -1);
        if($valid > -1){
            $updates['valid'] = $valid;
        }

        $role = request('role', false);
        if($role){
            $updates['role'] = $role;
        }

        $name = request('name', false);
        if($name){
            $updates['name'] = $name;
        }

        $phone = request('phone', false);
        if($phone){
            $updates['phone'] = $phone;
        }

        $gender = request('gender', false);
        if($gender){
            $updates['gender'] = $gender;
        }

        $birth_date = request('birth_date', false);
        if($birth_date){
            $updates['birth_date'] = $birth_date;
        }

        if (request()->hasFile('file')) {
            $file = request()->file('file');

            /** @var FileUploadService $fileService */
            $fileService = app('file_upload');
            $updates['image_url'] = $fileService->uploadFile($file);;
        }

        $user = User::query()->where('id', $id)->first();
        $user->update($updates);
        return $this->success();
    }

    function destroy(){
        $id = request('id', false);
        if(!$id){
            return $this->error(['error' => 'category_destroy'], 'Invalid request');
        }

        User::query()->where('id', $id)->delete();
        return $this->success();
    }
}
