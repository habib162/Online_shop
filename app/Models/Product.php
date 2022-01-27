<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'subcategory_id',
    'childcategory_id','brand_id','pickup_point_id','name','code','unit',
    'tag','color','size','video','purchase_price',
    'selling_price','discount_price','stock_quantity','warehouse',
    'description','thumbnail','images','featured','status','flash_deal_id',
    'cash_on_delivery','admin_id','pickup_point_id'];


    public Function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public Function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
    public Function childcategory(){
        return $this->belongsTo(ChildCategory::class, 'childcategory_id');
    }
    public Function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public Function pickuppoint(){
        return $this->belongsTo(PickupPoint::class, 'pickup_point_id');
    }
}
