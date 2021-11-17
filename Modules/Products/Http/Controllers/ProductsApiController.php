<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Products\Entities\Product;
use Illuminate\Support\Facades\Storage;
use Modules\Products\Http\Resources\Product as productResource;
use Modules\Products\Http\Resources\Products as ProductsResource;

class ProductsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getAllProducts()
    {
        $products = Product::paginate(2);

        return response()->json(ProductResource::collection($products), 200);
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
         if( !$product )
         {
            return response()->json( ["message"=> "product not found"], 200);
         }
        return response()->json( new ProductResource($product), 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function AddProduct(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|regex:/^[\pL\s]*$/u|max:250',
            'description' => 'nullable|regex:/^[\pL\s]*$/u|max:600',
            'price' => 'required|integer',
            'image'=>'required|file'
        ]);
        $data = $request->all();
        $file = $data['image'];
        $savedFile = Storage::disk('public_upload')->putFileAs('products', $file,'product_'.$file->getClientOriginalName());
        $data['image_path'] = 'product_'.$file->getClientOriginalName();
        $product = Product::create($data);
        if ($product) {
            return response()->json(new productResource($product), 200);
        }
        return response()->json("some thing went Rong", 500);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|regex:/^[\pL\s]*$/u|max:250',
            'description' => 'nullable|regex:/^[\pL\s]*$/u|max:600',
            'price' => 'required|integer',
        ]);
        $product = Product::where('id', $id)->update($request->all());
        if ($product) {
            return response()->json( productResource::collection($product), 200);
        }
        return response()->json("some thing went Rong", 500);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete($id)
    {
       $deleted = Product::destroy($id);
        if ($deleted) {
            return response()->json($deleted, 200);
        }
        return response()->json("some thing went Rong", 500);
    }
}
