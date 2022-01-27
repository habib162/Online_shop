<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if($request->ajax()){
            // query builder
        $data=DB::table('pickuppoints')->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){ 
                    $actionbtn =' <a href="#"id="editcoupon" class=" btn btn-info btn-sm " data-id=" '.$row->id.' "  data-toggle="modal" data-target="#editmodal" ><i class="fas fa-edit"></i></a>
                        <a href="'.route('pickup_point.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete_coupon"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
                })->rawColumns(['action'])
                    ->make(true);

        }
        
    return view('admin.pickup.index');
    }

    public function store(Request $request){
        $data =array();
        $data['pickup_point_name']=$request->pickup_point_name;
        $data['pickup_point_address']=$request->pickup_point_address;
        $data['pickup_point_phone']=$request->pickup_point_phone;
        $data['pickup_point_phone_two']=$request->pickup_point_phone_two;

        DB::table('pickuppoints')->insert($data);
        return response()->json('Successfully Inserted!');
    }

    public function Destroy($id){
        DB::table('pickuppoints')->where('id',$id)->delete();
        return response()->json('successfully deleted!');
    }

    public function edit($id){
        $data=DB::table('pickuppoints')->where('id',$id)->first();
        return view('admin.pickup.edit',compact('data'));
    }
    public function update(Request $request){
        $data =array();
        $data['pickup_point_name']=$request->pickup_point_name;
        $data['pickup_point_address']=$request->pickup_point_address;
        $data['pickup_point_phone']=$request->pickup_point_phone;
        $data['pickup_point_phone_two']=$request->pickup_point_phone_two;

        DB::table('pickuppoints')->where('id',$request->id)->update($data);
        return response()->json('Successfully updated!');
    }

    
}
