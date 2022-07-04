<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource(Product::with(['manufacturer'])->get());
    }

    public function store(StoreProductRequest $request)
    {
        $imagesArr = [];

        foreach ($request->photos as $file) {
            
            $unique = bin2hex(random_bytes(10));
            // $file_pre = public_path().$user->image;
            $file = $file;
            
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = $unique.'.'.$extension;
            $path = public_path().'/uploads/products/image';
            $uplaod = $file->move($path,$fileName);
            $image = '/uploads/products/image/'.$fileName;

            array_push($imagesArr, $image);
        }

        $meta = json_encode($request->input('meta'));
        $images = json_encode($imagesArr);

        $request['meta'] = $meta;
        $request['images'] = $images;

        $product = Product::create($request->all());
        
        // $product = Product::create($request->all());
        // $product->categories()->sync($request->input('categories', []));
        // $product->tags()->sync($request->input('tags', []));
        // foreach ($request->input('photos', []) as $file) {
        //     $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        // }

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource($product->load(['manufacturer']));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $imagesArr = [];

        echo('<pre>');
        print_r($request->all());
        echo('</pre>');
        die('asdasd');

        foreach ($request->photos as $file) {
            
            $unique = bin2hex(random_bytes(10));
            // $file_pre = public_path().$user->image;
            $file = $file;
            
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = $unique.'.'.$extension;
            $path = public_path().'/uploads/products/image';
            $uplaod = $file->move($path,$fileName);
            $image = '/uploads/products/image/'.$fileName;

            array_push($imagesArr, $image);
        }

        $meta = json_encode($request->input('meta'));
        $images = json_encode($imagesArr);

        $request['meta'] = $meta;
        $request['images'] = $images;

        $product->update($request->all());

        // $product->update($request->all());
        // $product->categories()->sync($request->input('categories', []));
        // $product->tags()->sync($request->input('tags', []));
        // if (count($product->photos) > 0) {
        //     foreach ($product->photos as $media) {
        //         if (!in_array($media->file_name, $request->input('photos', []))) {
        //             $media->delete();
        //         }
        //     }
        // }
        // $media = $product->photos->pluck('file_name')->toArray();
        // foreach ($request->input('photos', []) as $file) {
        //     if (count($media) === 0 || !in_array($file, $media)) {
        //         $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        //     }
        // }

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
