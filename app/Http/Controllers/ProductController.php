<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::paginate(50);

        return view('products.index')
        ->with('products',$products);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        $brands=Brand::all();

        
        return view('products.create')
        ->with('categories',$categories)
        ->with('brands',$brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $path=$request->file('image')->store('products');

        $product=Product::Create([
            'name'=>$request->name,
            'price'=>$request->price,
            'image'=>$path,
            'description'=>$request->description,
            'brand_id'=>$request->brand_id,
            'status'=>isset($request->status)
        ]);
        $product->categories()->sync($request->categories);
        toastr()->success("Added successfully");
        return redirect(route(('products.index')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories=Category::all();
        $brands=Brand::all();

        
        return view('products.edite')
        ->with('categories',$categories)
        ->with('brands',$brands)
        ->with('products',$products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image);
         $product->delete();
         toastr()->success("تم الحذف بنجاح");
         return redirect(route(('products.index')));
    }
}
