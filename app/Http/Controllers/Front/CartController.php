<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function AddToCartQV(Request $request){
        // $product = DB::table('products')->where('id',$request->id)->first();
        $product = Product::find($request->id);
        Cart::add([
            'id'=>$product->id,
            'name'=>$product->name,
            'qty'=>$request->qty,
            'price'=>$request->price,
            'weight'=>'1',
            'options'=>['size'=>$product->size, 'color'=>$request->color, 'thumbnail'=>$product->thumbnail]

        ]);

        return response()->json("Product added on cart");
    }

    // all cart
    public function AllCart(){
        $data =array();
        $data['cart_qty']=Cart::count();
        $data['cart_total']=Cart::total();

        return response()->json($data);
    }

    // wishlist
    public function addwishlist($id){
        if (Auth::check()) {
            $check = DB::table('wishlists')->where('product_id',$id)->where('user_id',Auth::id())->first();
            if($check){
                $notification=array('messege' => 'Already have it on your wishlist !','alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
            else{
                $data = array();
                $data['product_id'] = $id;
                $data['user_id'] = Auth::id();
                $data['date'] = date('d , F Y');
                DB::table('wishlists')->insert($data);
    
                $notification=array('messege' => 'product added on wishlist!','alert-type'=>'success');
                return redirect()->back()->with($notification);
            }
        }
        $notification=array('messege' => 'Login Your Account','alert-type'=>'error');
        return redirect()->back()->with($notification);
       
    }
    public function Wishlist(){
        if(Auth::check()){
            $wishlist = DB::table('wishlists')->leftJoin('products','wishlists.product_id','products.id')->select('products.name','products.thumbnail','products.slug','wishlists.*')->where('wishlists.user_id',Auth::id())->get();
            return view('frontend.cart.wishlist',compact('wishlist'));
        }
        $notification=array('messege' => 'Login Your Account','alert-type'=>'error');
        return redirect()->back()->with($notification);
    }

    public function ClearWishlist(){
        DB::table('wishlists')->where('user_id',Auth::id())->delete();
        $notification=array('messege' => 'wishlist Clear!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function WishlistProductDelete($id){
        DB::table('wishlists')->where('id',$id)->delete();
        $notification=array('messege' => 'wishlist Deleted!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    // Cart
    public function RemoveProduct($rowId){
        Cart::remove($rowId);
        return response()->json('success!!');
    }

    public function UpdateQty($rowId,$qty){
        Cart::update($rowId,['qty' => $qty]);
        return response()->json('successfully updated!!');
    }
    public function UpdateColor($rowId,$color){
        $product = Cart::get($rowId);
        $size = $product->options->size;
        $thumbnail = $product->options->thumbnail;
        Cart::update($rowId,['options' => ['color'=>$color, 'size' =>$size, 'thumbnail' => $thumbnail]]);
        return response()->json('successfully updated!!');
    }

    public function UpdateSize($rowId,$size){
        $product = Cart::get($rowId);
        $color = $product->options->color;
        $thumbnail = $product->options->thumbnail;
        Cart::update($rowId,['options' => ['size'=>$size, 'color' =>$color, 'thumbnail' => $thumbnail]]);
        return response()->json('successfully updated!!');
    }

    public function EmptyCart(){
        Cart::destroy();
        $notification=array('messege' => 'Cart item clear','alert-type'=>'success');
        return redirect()->to('/')->with($notification);

    }


    public function MyCart(){
        $content = Cart::content();
        return view('frontend.cart.cart',compact('content'));
        
    }
}
