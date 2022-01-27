<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request ){
        if($request->ajax()){
            // query builder
            $data=DB::table('brands')->get();
                

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                        
                        $actionbtn =' <a href="#"id="editcat" class=" btn btn-info btn-sm " data-id=" '.$row->id.' "  data-toggle="modal" data-target="#brandmodal" ><i class="fas fa-edit"></i></a>
                            <a href="'.route('brand.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                        return $actionbtn;
                    })->rawColumns(['action'])
                      ->make(true);

        }
                
        return view('admin.brand.index');
    }

    public function Store(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|max:55',
        ]);
        
        $slug=Str::slug($request->brand_name, '-');
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        // working with image
        $photo = $request -> brand_logo;
        $photoname = $slug.'.'.$photo->getClientOriginalExtension();
        // $photo->move('public/Files/brand/',$photoname); //without image intervention
        $destinationfile = 'public/Files/brand/';
        Image::make($photo)->resize(240,120)-> save($destinationfile.$photoname); // image intervention
        $data['brand_logo']=$destinationfile.$photoname;
        DB::table('brands')->insert($data);

          
        $notification = array('messege'=>" Brand inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function Destroy($id){
        $data = DB::table('brands')->where('id',$id)->first();
        $image = $data->brand_logo;
        if(File::exists($image)){
            unlink($image);

        }
        DB::table('brands')->where('id',$id)->delete();

        $notification = array('messege'=>" Brand Deleted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function edit($id){
        $data=DB::table('brands')->where('id',$id)->first();
        return view('admin.brand.edit',compact('data'));
    }

    public function update(Request $request){
         
        $slug=Str::slug($request->brand_name, '-');
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        if($request->brand_logo){
            if(File::exists($request->old_logo)){
                unlink($request->old_logo);
            }
            $photo = $request -> brand_logo;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            // $photo->move('public/Files/brand/',$photoname); //without image intervention
            $destinationfile = 'public/Files/brand/';
            Image::make($photo)->resize(240,120)-> save($destinationfile.$photoname); // image intervention
            $data['brand_logo']=$destinationfile.$photoname;
            DB::table('brands')->where('id',$request->id)->update($data);
            $notification = array('messege'=>" Brand updated Successfully!",'alert-type'=>'success');
            return redirect()->back()->with($notification);

        }else{
            $data['brand_logo']=$request->old_logo;
            DB::table('brands')->where('id',$request->id)->update($data);
            $notification = array('messege'=>" Brand updated Successfully!",'alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
        
        // working with image
       
        

          
        $notification = array('messege'=>" Brand inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

}
