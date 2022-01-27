<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

            if($request->ajax()){
                    // query builder
                $data=DB::table('coupons')->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action',function($row){ 
                            $actionbtn =' <a href="#"id="editcoupon" class=" btn btn-info btn-sm " data-id=" '.$row->id.' "  data-toggle="modal" data-target="#editmodal" ><i class="fas fa-edit"></i></a>
                                <a href="'.route('coupon.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete_coupon"><i class="fas fa-trash"></i></a>';
                            return $actionbtn;
                        })->rawColumns(['action'])
                            ->make(true);
    
                }
                
            return view('admin.offer.coupon.index');
    }

    public function Destroy($id){
        DB::table('coupons')->where('id',$id)->delete();
        return response()->json('Coupon deleted!');
    }

    public function Store(Request $request){
        $data =array();
        $data['coupon_code']=$request->coupon_code;
        $data['type']=$request->type;
        $data['coupon_amount']=$request->coupon_amount;
        $data['valid_date']=$request->valid_date;
        $data['status']=$request->status;

        DB::table('coupons')->insert($data);
        return response()->json('Coupon stored!');
    }
    public function edit($id){
        $data = DB::table('coupons')->where('id',$id)->first();
        return view('admin.offer.coupon.edit',compact('data'));
    }

    public Function update(Request $request){
        $data =array();
        $data['coupon_code']=$request->coupon_code;
        $data['type']=$request->type;
        $data['coupon_amount']=$request->coupon_amount;
        $data['valid_date']=$request->valid_date;
        $data['status']=$request->status;

        DB::table('coupons')->where('id',$request->id)->update($data);
        return response()->json('Coupon Updated!');
    }

}
