<?php

namespace App\Http\Controllers;


//use permission;
use permission;
use App\Models\Brand;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     { 
         $this->middleware('permission:access-brands', ['only' => ['index', 'show']]);
         $this->middleware('permission:create-brands', ['only' => ['create', 'store']]);
         $this->middleware('permission:update-brands', ['only' => ['edit', 'store']]);
         $this->middleware('permission:delete-brands', ['only' => ['destroy']]);
     }


    public function index()
    {
        $brands=Brand::

        
//        whereExists(function ($query) {
//            $query->select(DB::raw(1))
//                ->from('products')
//                ->whereColumn('brands.id', 'products.brand_id');
//        })


//           whereIn('id',function ($query){
//                $query->select('brand_id')
//                    ->from('products');
//            })
               all();
        return view('brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {//return view('brands.create');
        if ($request->hasFile('image')) {
           // $img = $request->file('bookcover');


        $path=$request->file('image')->store('brands');}
        Brand::create(
            ['name'=>$request->name,
            'image'=>$path

        ]);
        toastr()->success("Added successfully");
            return redirect(route(('brands.index')));
    }  /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {  
        $path=$brand->image;
        if($request->hasfile('image'))
        {
            
        $path=$request->file('image')->store('brands');
        Storage::delete($brand->image);
        }
        $brand->Update(
            ['name'=>$request->name,
            'image'=>$path

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if($brand->products->count()==0)
        {
            Storage::delete($brand->image);
         $brand->delete();
            toastr()->success("تم الحذف بنجاح");
        }
        else
            toastr()->error("لم يتم الحذف بنجاح");
            return redirect(route(('brands.index')));

        
    }
}


