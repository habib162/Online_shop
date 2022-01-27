<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{   

    // root page
    public function index(){
        $category = DB::table('categories')->orderBy('category_name','ASC')->get();
        $bannerproduct = Product::where('status',1)->where('product_slider',1)->latest()->first();
        $featured = Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(16)->get();
        $popular_product = Product::where('status',1)->orderBy('product_views','DESC')->limit(16)->get();
        $trendy_product= Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(16)->get();
        $brand=$brand= DB::table('brands')->get();
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();

        // home page category
        $home_category = DB::table('categories')->where('home_page',1)->orderBy('category_name','ASC')->get();
        return view('frontend.index',compact('category','bannerproduct','featured','popular_product','trendy_product','home_category','brand','random_product'));
    }

    // single product page with calling method
    public function Details($slug){
        // $product=DB::table('products')->where('slug',$slug)->first();
        $product=Product::where('slug',$slug)->first();
                Product::where('slug',$slug)->increment('product_views');
        $related_product = DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','desc')->take(10)->get();
        $review=Review::where('product_id',$product->id)->orderBy('id','desc')->take(6)->get();
        return view('frontend.product.product_details',compact('product','related_product','review'));
    }

    // product quick view
    public function ProductQuickView($id){
        $product = Product::where('id',$id)->first();
        return view('frontend.product.quick_view',compact('product'));
    }


    // Category wise products page

    public function CategoryWiseProduct($id){
        $category = DB::table('categories')->where('id',$id)->first();
        $subcategory= DB::table('subcategories')->where('category_id',$id)->get();
        $brand= DB::table('brands')->get();
        $product= DB::table('products')->where('category_id',$id)->paginate(20);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.category_products',compact('category','subcategory','brand','product','random_product'));
        
    }

    // subcategory wise product page

    public function SubCategoryWiseProduct($id){
        $subcategory = DB::table('subcategories')->where('id',$id)->first();
        $childcategory= DB::table('childcategories')->where('subcategory_id',$id)->get();
        $brand= DB::table('brands')->get();
        $product= DB::table('products')->where('subcategory_id',$id)->paginate(20);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.subcategory_products',compact('subcategory','childcategory','brand','product','random_product'));
    }

     // child wise product page

     public function ChildCategoryWiseProduct($id){
        $childcategory = DB::table('childcategories')->where('id',$id)->first();
        $category= DB::table('categories')->get();
        $brand= DB::table('brands')->get();
        $product= DB::table('products')->where('childcategory_id',$id)->paginate(20);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.childcategory_products',compact('childcategory','category','brand','product','random_product'));
    }

    
    public function BrandWiseProduct($id){
        $brands = DB::table('brands')->where('id',$id)->first();
        $category= DB::table('categories')->get();
        $brand= DB::table('brands')->get();
        $product= DB::table('products')->where('brand_id',$id)->paginate(20);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.brandwise_products',compact('brand','category','brands','product','random_product'));
    }
}
