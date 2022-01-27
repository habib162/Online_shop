<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // all category showing method
    public function index(Request $request){
        if($request->ajax()){
            // query builder
            $data=DB::table('categories')->get();
                

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('home_page',function($row){
                        if($row->home_page==1){
                            $downbtn='<a href="#"><span class="badge badge-success">home page</span> </a>';
                             return $downbtn;
                        }else{
                            return null;
                        }
                    })
                    ->addColumn('action',function($row){
                        
                        $actionbtn =' <a href="#"id="editcat" class=" btn btn-info btn-sm " data-id=" '.$row->id.' "  data-toggle="modal" data-target="#catmodal" ><i class="fas fa-edit"></i></a>
                            <a href="'.route('category.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                        return $actionbtn;
                    })->rawColumns(['action','home_page'])
                      ->make(true);

        }
                
        return view('admin.category.index');
    }
    public function Store(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:25'
        ]);
        // Sql query
        $slug=Str::slug($request->category_name, '-');
        $data =array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name,'-');
        $data['home_page']=$request->home_page;

        $icon = $request->icon;
        $icon_name = $slug.'.'.$icon->getClientOriginalExtension();
        $destinationfile = 'public/Files/icon/';
        Image::make($icon)->resize(64,64)->save($destinationfile.$icon_name); // image intervention
        $data['icon']=$destinationfile.$icon_name;

        DB::table('categories')->insert($data);

        // Eloquent ORM
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'category_slug' => Str::slug($request->category_name,'-'),
        //     'home_page' => $request->home_page,
            
        // ]);

        $notification = array('messege'=>" Category Inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    // delete category
    public function Destroy($id){
        $data = DB::table('categories')->where('id',$id)->first();
        $icon = $data->icon;
        if(File::exists($icon)){
            unlink($icon);

        }
        DB::table('categories')->where('id',$id)->delete();

        $notification = array('messege'=>" Category Deleted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    // edit method

    public function edit($id){
        $data=DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('data'));
    }

    // update method
    public function update(Request $request){
        $id =request()->id;
        $data=array();

        $slug=Str::slug($request->category_name, '-');
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name,'-');
        $data['home_page']=$request->home_page;
        if($request->icon){
            if(File::exists($request->old_icon)){
                unlink($request->old_icon);
            }
            $icon = $request ->icon;
            $photoname = $slug.'.'.$icon->getClientOriginalExtension();
            // $photo->move('public/Files/brand/',$photoname); //without image intervention
            $destinationfile = 'public/Files/icon/';
            Image::make($icon)->resize(64,64)-> save($destinationfile.$photoname); // image intervention
            $data['icon']=$destinationfile.$photoname;
            DB::table('categories')->where('id',$request->id)->update($data);

            $notification = array('messege'=>" Category updated Successfully!",'alert-type'=>'success');
            return redirect()->back()->with($notification);

        }else{
            $data['icon']=$request->old_icon;
            DB::table('categories')->where('id',$request->id)->update($data);
            $notification = array('messege'=>" Category updated Successfully!",'alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
    }

// get child category
    public function GetChildcategory($id) //subcategory_id
    {
        $data = DB::table('childcategories')->where('subcategory_id',$id)->get();
        
        return response()->json($data) ;
    }
}
