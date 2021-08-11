<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Products\Entities\Product;

class ProductsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getAllProducts()
    {
        $data = Product::all();
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function AddProduct(Request $request)
    {  
        $validatedData = $request->validate([
            'title'=>'required|regex:/^[\pL\s]*$/u|max:250',
            'description'=>'nullable|regex:/^[\pL\s]*$/u|max:600',
            'price'=>'required|integer',
        ]);
        $product=Product::create($request->all());
       if($product)
        {
            return response()->json($product, 200);
        }
        return response()->json("some thing want Rong", 500);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('products::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('products::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
