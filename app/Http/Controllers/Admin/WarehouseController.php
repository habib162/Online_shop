<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

    if($request->ajax()){
            // query builder
            $data=DB::table('warehouses')->get();
                

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){ 
                        $actionbtn =' <a href="#" id="editware" class=" btn btn-info btn-sm " data-id=" '.$row->id.' "  data-toggle="modal" data-target="#editmodal" ><i class="fas fa-edit"></i></a>
                            <a href="'.route('warehouse.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                        return $actionbtn;
                    })->rawColumns(['action'])
                      ->make(true);

        }
        
        return view('admin.warehouse.index');
    }

    public function Store(Request $request){
        $validated = $request->validate([
            'warehouse_name' => 'required|unique:warehouses',
            
        ]);

        $data = array();
        $data['warehouse_name']= $request->warehouse_name;
        $data['warehouse_address']= $request->warehouse_address;
        $data['warehouse_phone']= $request->warehouse_phone;

        DB::table('warehouses')->insert($data);
        $notification = array('messege'=>" warehouse inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id){
        DB::table('warehouses')->where('id',$id)->delete();
        $notification = array('messege'=>" warehouse deleted!",'alert-type'=>'danger');
        return redirect()->back()->with($notification);
    }

    public function edit($id){
       $warehouse =  DB::table('warehouses')->where('id',$id)->first();
        return view('admin.warehouse.edit',compact('warehouse'));
    }

    public function update(Request $request){
        $data = array();
        $data['warehouse_name']= $request->warehouse_name;
        $data['warehouse_address']= $request->warehouse_address;
        $data['warehouse_phone']= $request->warehouse_phone;
        $data =  DB::table('warehouses')->where('id',$request->id)->update($data);

        $notification = array('messege'=>" warehouse updated!",'alert-type'=>'success');
        return redirect()->route('warehouse.index')->with($notification);

    }


}
