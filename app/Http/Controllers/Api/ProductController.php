<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\FileUploadService;

class ProductController extends ApiController
{
    //
    public function index(){
        $id = request('id', 0);
        if(!$id){
            return $this->error(['error' => 'product_index'], 'Invalid request');
        }

        $product = Product::query()->where('id', $id)->first();
        return $this->success($product);
    }

    public function list(){
        $pageCount = request('page_count', 50);
        $page = request('p', 1);
        $order_by=request('order', 'price');

        $query = Product::query();
        $query->orderBy($order_by, 'asc');
        $paginate = $query->paginate($pageCount, '*', 'p', $page);
        $items = $paginate->items();

        return $this->success($items);
    }

    public function store(Request $request)
    {
        $title = $request->get('title', false);
        $sku = $request->get('title', false);
        $restaurant_id = $request->get('restaurant_id', 0);
        $category_id = $request->get('category_id', 0);
        $price = $request->get('price', 0);
        $stock = $request->get('stock', 0);
        $description = $request->get('description', '');

        if(!$title || !$sku || !$category_id || !$restaurant_id){
            return $this->error(['error' => 'product_store'], 'Invalid request');
        }

        $image_url =  null;
        if (request()->hasFile('file')) {
            $file = request()->file('file');

            /** @var FileUploadService $fileService */
            $fileService = app('file_upload');
            $image_url = $fileService->uploadFile($file);
        }

        $product = Product::query()->create([
            'title' => $title,
            'sku' => $sku,
            'restaurant_id' => $restaurant_id,
            'category_id' => $category_id,
            'image_url' => $image_url??'',
            'price' => $price,
            'currency_code' => '$',
            'stock' => $stock,
            'description' => $description,
        ]);

        return $this->success();

    }

    public function update(Request $request)
    {
        $product_id = $request->get('id', false);
        $title = $request->get('title', false);
        $sku = $request->get('title', false);
        $restaurant_id = $request->get('restaurant_id', 0);
        $category_id = $request->get('category_id', 0);
        $price = $request->get('price', 0);
        $stock = $request->get('stock', 0);
        $description = $request->get('description', '');

        if(!$product_id || !$title || !$sku || !$category_id || !$restaurant_id){
            return $this->error(['error' => 'product_update'], 'Invalid request');
        }

        $product = Product::query()->where('id', $product_id)->first();
        if(!$product){
            return $this->error(['error' => 'product_update'], 'Invalid request');
        }

        $image_url =  null;
        if (request()->hasFile('file')) {
            $file = request()->file('file');

            /** @var FileUploadService $fileService */
            $fileService = app('file_upload');
            $image_url = $fileService->uploadFile($file);
        }

        $product->update([
            'title' => $title,
            'sku' => $sku,
            'restaurant_id' => $restaurant_id,
            'category_id' => $category_id,
            'image_url' => $image_url??$product->image_url,
            'price' => $price,
            'currency_code' => '$',
            'stock' => $stock,
            'description' => $description,
        ]);

        return $this->success();
    }

    public function destroy()
    {
        $id = request('id', 0);
        if(!$id){
            return $this->error(['error' => 'product_destroy'], 'Invalid request');
        }

        Product::query()->where('id', $id)->delete();
        return $this->success();
    }
}
