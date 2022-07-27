<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    //
    public function index(){
        $id = request('id', 0);
        if(!$id){
            return $this->error(['error' => 'category_index'], 'Invalid request');
        }

        $product = Category::query()->where('id', $id)->first();
        return $this->success($product);
    }

    public function list(){
        $items = Category::query()->get();

        return $this->success($items);
    }

    public function store()
    {
        $name = request('name', false);
        $short_description = request('short_description', false);
        $description = request('description', false);

        if(!$name){
            return $this->error(['error' => 'category_store'], 'Invalid request');
        }

        $image_url =  null;
        if (request()->hasFile('file')) {
            $file = request()->file('file');

            /** @var FileUploadService $fileService */
            $fileService = app('file_upload');
            $image_url = $fileService->uploadFile($file);
        }

        $product = Category::query()->create([
            'name' => $name,
            'short_description' => $short_description,
            'description' => $description,
            'image_url' => $image_url??''
        ]);

        return $this->success($product);

    }

    public function update()
    {
        $category_id = request('id', false);
        $name = request('name', false);
        $short_description = request('short_description', false);
        $description = request('description', false);

        if(!$category_id){
            return $this->error(['error' => 'category_update'], 'Invalid request');
        }

        $category = Category::query()->where('id', $category_id)->first();
        if(!$category){
            return $this->error(['error' => 'category_update'], 'Invalid request');
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
            'short_description' => $short_description,
            'description' => $description,
            'image_url' => $image_url??$category->image_url,
        ]);

        return $this->success();
    }

    public function destroy()
    {
        $id = request('id', false);
        if(!$id){
            return $this->error(['error' => 'category_destroy'], 'Invalid request');
        }

        Category::query()->where('id', $id)->delete();
        return $this->success();
    }
}
