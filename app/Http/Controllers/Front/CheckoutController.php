<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // checkout page
    public function Checkout(){
        if(!Auth::check()){
            $notification=array('messege' => 'Login your Account!','alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        $content = Cart::content();
        return view('frontend.cart.checkout',compact('content'));
    }

    public function ApplyCoupon(Request $request){
        $check = DB::table('coupons')->where('coupon_code',$request->coupon)->first();
        if ($check) {
            //    coupon exist
            if (date('y-m-d',strtotime(date('y-m-d'))) <= date('y-m-d',strtotime($check->valid_date))) {
               session()->put('coupon', [
                   'name'=>$check->coupon_code,
                   'discount'=> $check->coupon_amount,
                   'after_discount'=>(int)Cart::subtotal()-(int)$check->coupon_amount
               ]);
               $notification=array('messege' => 'Coupon Applied','alert-type'=>'success');
               return redirect()->back()->with($notification);

            }else{
                $notification=array('messege' => 'expired Coupon Code','alert-type'=>'error');
                return redirect()->back()->with($notification);
            }

        

        }else{
            $notification=array('messege' => 'Coupon Code invalid! Try Again!!!','alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }

    public function RemoveCoupon(){
        session()->forget('coupon');
        $notification=array('messege' => 'Coupon Code removed!','alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    // order place
    public function OrderPlace(Request $request){
        $order=array();
        $order['user_id']=Auth::id();
        $order['c_name']=$request->c_name;
        $order['c_phone']=$request->c_phone;
        $order['c_country']=$request->c_country;
        $order['c_address']=$request->c_address;
        $order['c_email']=$request->c_email;
        $order['c_zipcode']=$request->c_zipcode;
        $order['c_extra_phone']=$request->c_extra_phone;
        $order['c_city']=$request->c_city;
        if($request->session()->has('coupon')){
            $order['subtotal']=Cart::subtotal();
            $order['total']=Cart::total(); 
            $order['coupon_code']=$request->session()->get('coupon')['name'];
            $order['coupon_discount']=$request->session()->get('coupon')['discount'];
            $order['after_discount']=$request->session()->get('coupon')['after_discount'];
        }
        else{
            $order['subtotal']=Cart::subtotal();
            $order['total']=Cart::total();
        }

        $order['payment_type']=$request->payment_type;
        $order['tax']=0;
        $order['shipping_charge']=0;
        $order['order_id']=rand(10000,10000);
        $order['status']=0;
        $order['date']=date('d-m-y');
        $order['month']=date('F');
        $order['year']=date('Y');

       dd($order);
    }


}
