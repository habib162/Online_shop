<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
class Campaigncontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request ){
        if($request->ajax()){
            // query builder
            $data=DB::table('campaigns')->orderBy('id','DESC')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if($row->status==1){
                            $downbtn='<a href="#"><span class="badge badge-success">active</span> </a>';
                             return $downbtn;
                        }else{
                            return '<a href="#"></i><span class="badge badge-danger">deactive</span></a>';
                        }
                    })
                    ->addColumn('action',function($row){
                        
                        $actionbtn =' <a href="#"id="editcat" class=" btn btn-info btn-sm " data-id=" '.$row->id.' "  data-toggle="modal" data-target="#brandmodal" ><i class="fas fa-edit"></i></a>
                            <a href="'.route('campaign.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                        return $actionbtn;
                    })->rawColumns(['action','status'])
                      ->make(true);

        }
                
        return view('admin.offer.campaign.index');
    }

    // store campaign
    public function Store(Request $request){
        $validated = $request->validate([
            'title' => 'required|unique:campaigns|max:55',
            'start_date' => 'required',
            'image' => 'required',
            'discount' => 'required',
        ]);
        $slug = Str::slug($request->title,'-'); // only for image name
        $data = array();
        $data['title'] = $request->title;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = $request->status;
        $data['discount'] = $request->discount;
        $data['month'] = date('F');
        $data['year'] = date('Y');
        // working with image
        $photo = $request -> image;
        $photoname = $slug.'.'.$photo->getClientOriginalExtension();
        $destinationfile = 'public/Files/campaign/';
        Image::make($photo)->resize(468,90)-> save($destinationfile.$photoname); // image intervention
        $data['image']=$destinationfile.$photoname;
        DB::table('campaigns')->insert($data);

          
        $notification = array('messege'=>" Campaign inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
    // delete campaign
    public function Destroy($id){
        $data = DB::table('campaigns')->where('id',$id)->first();
        $image = $data->image;
        if(File::exists($image)){
            unlink($image);

        }
        DB::table('campaigns')->where('id',$id)->delete();

        $notification = array('messege'=>" Campaign Deleted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
    // edit campaign
    public function edit($id){
        $data=DB::table('campaigns')->where('id',$id)->first();
        return view('admin.offer.campaign.edit',compact('data'));
    }

    // update
    public function update(Request $request){
         
        $slug=Str::slug($request->brand_name, '-');
        $data = array();
        $data['title'] = $request->title;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = $request->status;
        $data['discount'] = $request->discount;

        if($request->image){
            if(File::exists($request->old_image)){
                unlink($request->old_image);
            }
            $photo = $request -> image;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            // $photo->move('public/Files/brand/',$photoname); //without image intervention
            $destinationfile = 'public/Files/campaign/';
            Image::make($photo)->resize(468,90)-> save($destinationfile.$photoname); // image intervention
            $data['image']=$destinationfile.$photoname;
            DB::table('campaigns')->where('id',$request->id)->update($data);
            $notification = array('messege'=>" capaign updated Successfully!",'alert-type'=>'success');
            return redirect()->back()->with($notification);

        }else{
            $data['image']=$request->old_image;
            DB::table('campaigns')->where('id',$request->id)->update($data);
            $notification = array('messege'=>" capaign updated Successfully!",'alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
        
        // working with image
       
        

          
        $notification = array('messege'=>" capaign inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

}
