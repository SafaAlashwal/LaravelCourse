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

        // $products=DB::table('products')
       // ->join('brands','products.brand_id','=','brand.id')
       // ->join('products.*','brands.name')
       // ->get();


        //$products=Product::get()->pluck('name');

       // $products=Product::all();

 //$products=Product::get()->avg('price');
  //$products=Product::get()->max('price');
   //$products=Product::get()->count();

   $products=Product::where('status','=',1)
   //->orwhere('price','>',20)
   //->where('name','like','iphone 12')
   //->whereBetweem('price',[10,100])
   //->whereNotBetweem('price',[10,100])
  //->WhereIn('price',[100,20,50])
  //>WhereColumn('price','brand_id')

  //where([
   // ['price',[10,100]],
  //  ['status','=',1],
  //])

 // whereNull('description')
   // whereNotNull('description')

  // whereDate('created_at','>','2023-06-30')

  //whereYear('created_at','2023')
  //whereMonth('created_at','06')
    //whereDay('created_at','20')
      //wheretime('created_at','06:45:2')

      ->orderBy('id','desc')
      //->inRandomOrder()

      //skip(5)->take(5)->get()  without render

       ->paginate(50);

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
