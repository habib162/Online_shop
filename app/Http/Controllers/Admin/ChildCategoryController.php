<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){    //jokhon yajra datatable use korbo tokhon Request niye kaj korte hbe and obossoi ekhan thekei data return korte hbe
        
        if($request->ajax()){
            // query builder
            $data=DB::table('childcategories')
                ->join('categories','childcategories.category_id','categories.id')
                ->join('subcategories','childcategories.subcategory_id','subcategories.id')
                ->select('categories.category_name','subcategories.subcategory_name','childcategories.*')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                        
                        $actionbtn =' <a href="#"id="editcat" class=" btn btn-info btn-sm " data-id=" '.$row->id.' "  data-toggle="modal" data-target="#editmodal" ><i class="fas fa-edit"></i></a>
                            <a href="'.route('childcategory.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                        return $actionbtn;
                    })->rawColumns(['action'])
                      ->make(true);

        }
        // $category=Category::all();
        $category = DB::table('categories')->get();
        
        return view('admin.childcategory.index',compact('category'));
    }

    public function store(Request $request){
        
        $cat = DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        
        $data=array();
        $data['category_id']=$cat->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_slug']=Str::slug($request->childcategory_name,'-');
        $data['childcategory_name']=$request->childcategory_name;
        
        DB::table('childcategories')->insert($data);
        $notification = array('messege'=>" Child-Category Inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function Destroy($id){
        DB::table('childcategories')->where('id',$id)->delete();
        $notification = array('messege'=>" Child-Category Deleted Successfully!",'alert-type'=>'danger');
        return redirect()->back()->with($notification);
    }


    public function edit($id){

        $category = DB::table('categories')->get();
        $data = DB::table('childcategories')->where('id',$id)->first();
        
        return view('admin.childcategory.edit',compact('data','category'));
    }

    public function update(Request $request){

        $cat = DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        
        $data=array();
        $data['category_id']=$cat->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_slug']=Str::slug($request->childcategory_name,'-');
        $data['childcategory_name']=$request->childcategory_name;
        
        DB::table('childcategories')->where('id',$request->id)->update($data);
        $notification = array('messege'=>" Child-Category updated Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
