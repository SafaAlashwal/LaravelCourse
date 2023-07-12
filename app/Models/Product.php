<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use App\Models\Category;
//use App\Models\Brand;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=['id','created_at'];

    
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
       return $this->BelongsTo(User::class); 
    }
    public function userWhodelete()
    {
       return $this->BelongsTo(User::class,'deleted_by'); 
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'product_categories');
    }
    public function images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
}
