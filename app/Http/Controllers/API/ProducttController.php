<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;

class ProducttController extends BaseAPIController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::all();
       // return $products;

       return $this->sendResponse(ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('create-products'))
        return $this->sendError('unauthorized',[]);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'user_id'=>auth()->id(),
            'description' => 'nullable',
            'price'=>'required|numeric',
            'categories' => "nullable|array",
            'categories.*' => "required|exists:categories,id",
            'brand_id'=>'required|numeric|exists:brands,id',
            "image"=>[request()->id>0?"nullable":"required","image","max:51120"]

        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        $bath='';
        if ($request->hasFile('image'))
            $bath = $request->file('image')->store('products');


        $product = Product::create([
            'name' => $request->name,
            'user_id'=>auth()->id(),
            'description' => $request->description,
            'image' => $bath,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'status' => isset($request->status)
        ]);

        $product->categories()->sync($request->categories);

        return  $this->sendResponse(new ProductResource($product));


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}