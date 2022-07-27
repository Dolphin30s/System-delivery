<?php

namespace App\Http\Controllers\Api;

use App\Models\Restaurant;
use App\Services\FileUploadService;

class RestaurantController extends ApiController
{
    //

    public function index(){
        $id = request('id', 0);
        if(!$id){
            return $this->error(['error' => 'restaurant_index'], 'Invalid request');
        }

        $product = Restaurant::query()->where('id', $id)->first();
        return $this->success($product);
    }

    public function list(){
        $items = Restaurant::query()->get();

        return $this->success($items);
    }

    public function store()
    {
        $name = request('name', false);
        $location = request('location', false);
        $description = request('description', false);

        if(!$name){
            return $this->error(['error' => 'restaurant_store'], 'Invalid request');
        }

        $image_url =  null;
        if (request()->hasFile('file')) {
            $file = request()->file('file');

            /** @var FileUploadService $fileService */
            $fileService = app('file_upload');
            $image_url = $fileService->uploadFile($file);
        }

        $product = Restaurant::query()->create([
            'name' => $name,
            'location' => $location,
            'description' => $description,
            'image_url' => $image_url??''
        ]);

        return $this->success();

    }

    public function update()
    {
        $category_id = request('id', false);
        $name = request('name', false);
        $location = request('location', false);
        $description = request('description', false);

        if(!$category_id){
            return $this->error(['error' => 'restaurant_update'], 'Invalid request');
        }

        $category = Restaurant::query()->where('id', $category_id)->first();
        if(!$category){
            return $this->error(['error' => 'restaurant_update'], 'Invalid request');
        }

        $image_url =  null;
        if (request()->hasFile('file')) {
            $file = request()->file('file');

            /** @var FileUploadService $fileService */
            $fileService = app('file_upload');
            $image_url = $fileService->uploadFile($file);
        }

        $category->update([
            'name' => $name,
            'location' => $location,
            'description' => $description,
            'image_url' => $image_url??$category->image_url,
        ]);

        return $this->success();
    }

    public function destroy()
    {
        $id = request('id', false);
        if(!$id){
            return $this->error(['error' => 'restaurant_destroy'], 'Invalid request');
        }

        Restaurant::query()->where('id', $id)->delete();
        return $this->success();
    }
}
