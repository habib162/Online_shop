<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Model;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // product index page
    public Function index(Request $request){
        if($request->ajax()){
            $imgurl = 'public/Files/product';
            // query builder
            // $data=Product::latest()->get();//latesh() na dilew hobe
            $product="";
            // filtering korar jonne query builder ta use korlam 
            $data = DB::table('products')
                ->leftJoin('categories','products.category_id','categories.id')
                ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
                ->leftJoin('brands','products.brand_id','brands.id');
            if ($request->category_id) {
                $data->where('products.category_id',$request->category_id);
            }
            if ($request->brand_id) {
                $data->where('products.brand_id',$request->brand_id);
            }
            if ($request->warehouse) {
                $data->where('products.warehouse',$request->warehouse);
            }
            // if ($request->status==1) {
            //     $data->where('products.status',1);
            // }
            // if ($request->status==0) {
            //     $data->where('products.status',0);
            // }
            $product=$data->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
                ->get();
                
            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('thumbnail',function($row)use($imgurl){
                        return '<img src=" '.$imgurl.'/'.$row->thumbnail.' " height="100" width="100">';
                    })
                    // model e korle nicher eivabe data show korate hbe
                    // ->editColumn('category_name',function($row){
                    //     return $row->category->category_name;
                    // })
                    // ->editColumn('subcategory_name',function($row){
                    //     return $row->subcategory->subcategory_name;
                    // })
                    // ->editColumn('brand_name',function($row){
                    //     return $row->brand->brand_name;
                    // })

                    ->editColumn('featured',function($row){
                        if($row->featured==1){
                            $downbtn='<a href="#" data-id=" '.$row->id.'"class="deactive_featured"><i class="fas fa-thumbs-down text-danger"></i><span class="badge badge-success">active</span> </a>';
                             return $downbtn;
                        }else{
                            return '<a href="#"data-id=" '.$row->id.'"class="active_featured"><i class="fas fa-thumbs-up text-success"></i><span class="badge badge-danger">deactive</span></a>';
                        }
                    })
                    ->editColumn('flash_deal_id',function($row){
                        if($row->flash_deal_id==1){
                            $downbtn='<a href="#" data-id=" '.$row->id.'"class="deactive_toady_deal"><i class="fas fa-thumbs-down text-danger"></i><span class="badge badge-success">active</span> </a>';
                             return $downbtn;
                        }else{
                            return '<a href="#"data-id=" '.$row->id.'"class="active_toady_deal"><i class="fas fa-thumbs-up text-success"></i><span class="badge badge-danger">deactive</span></a>';
                        }
                    })
                    ->editColumn('status',function($row){
                        if($row->status==1){
                            $downbtn='<a href="#" data-id=" '.$row->id.'"class="deactive_status"><i class="fas fa-thumbs-down text-danger"></i><span class="badge badge-success">active</span> </a>';
                             return $downbtn;
                        }else{
                            return '<a href="#"data-id=" '.$row->id.'"class="active_status"><i class="fas fa-thumbs-up text-success"></i><span class="badge badge-danger">deactive</span></a>';
                        }
                    })
                    ->addColumn('action',function($row){
                        
                        $actionbtn =
                                    '<a href="'.route('product.edit',[$row->id]).'" class=" btn btn-info btn-sm" ><i class="fas fa-edit"></i></a>
                                    <a href="#"id="update_product" class=" btn btn-primary btn-sm " ><i class="fas fa-eye"></i></a>
                            <a href="'.route('product.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                        return $actionbtn;
                    })->rawColumns(['action','category_name','subcategory_name','brand_name','thumbnail','featured','flash_deal_id','status'])
                      ->make(true);

        }
        $category = DB::table('categories')->get();
        $brand = Brand::all();
        $warehouse=DB::table('warehouses')->get();
        return view('admin.product.index',compact('category','brand','warehouse'));
    }
   

    // pruduct create page
    public function create(){
        $category= DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $pickup_point = DB::table('pickuppoints')->get();
        $warehouse = DB::table('warehouses')->get();


        return view('admin.product.create',compact('category','brand','pickup_point','warehouse'));
    }

    public function Store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'color' => 'required',
            'description' => 'required',

        ]);
        $slug= Str::slug($request->name,'-');
        // subcategory id call for category_id
        $subcategory = DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data=array();
        $data['name'] = $request->name;
        $data['slug']= Str::slug($request->name,'-');
        $data['code'] = $request->code;
        $data['category_id'] = $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['pickup_point_id'] = $request->pickup_point_id;
        $data['unit'] = $request->unit;
        $data['tag'] = $request->tag;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['warehouse'] = $request->warehouse;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $data['description'] = $request->description;
        $data['video'] = $request->video;
        $data['featured'] = $request->featured;
        $data['flash_deal_id'] = $request->flash_deal_id;
        $data['status'] = $request->status;
        $data['trendy_product'] = $request->trendy_product;
        $data['product_slider'] = $request->product_slider;
        $data['admin_id'] = Auth::id();
        $data['date'] = date('d-m-Y');
        $data['month'] = date('F');
        
        // single thumbnail
        if($request->thumbnail){
            $thumbnail = $request -> thumbnail;
            $photoname = $slug.'.'.$thumbnail->getClientOriginalExtension();
            $destinationfile = 'public/Files/product/';
            Image::make($thumbnail)->resize(600,600)-> save($destinationfile.$photoname); // image intervention
            $data['thumbnail']=$photoname;

        }
        // multiple images
        $images= array();

        if($request->hasFile('images')){

            foreach ($request->file('images') as $key => $image) {
                # code...
                $imageName =hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                $destinationfile = 'public/Files/product/';
                Image::make($image)->resize(600,600)-> save($destinationfile.$imageName); // image intervention
                array_push($images,$imageName);
            }
            $data['images'] = json_encode($images);
           

        }


      
        DB::table('products')->insert($data);

          
        $notification = array('messege'=>" products inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    // edit method
    public function edit($id){
        $product= DB::table('products')->where('id',$id)->first();
        // Product::findorfail($id);
        $category=Category::all();
        $brand = Brand::all();
        $warehouse=DB::table('warehouses')->get();
        $pickup_point=DB::table('pickuppoints')->get();

        return view('admin.product.edit',compact('product','category','brand','warehouse','pickup_point'));
    }

    // notfeatured 
    public function notfeatured($id){
        DB::table('products')->where('id',$id)->update(['featured'=>0]);
        return response()->json('Product not featured');
    }
    // active featured
    public function featured($id){
        DB::table('products')->where('id',$id)->update(['featured'=>1]);
        return response()->json('product featured');
    }

       // not_today_deal 
    public function not_today_deal($id){
        DB::table('products')->where('id',$id)->update(['flash_deal_id'=>0]);
        return response()->json('deactivate today deal');
    }
    // active today_deal
    public function today_deal($id){
        DB::table('products')->where('id',$id)->update(['flash_deal_id'=>1]);
        return response()->json('active today deal');
    }
       // not_status 
       public function not_status($id){
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        return response()->json('deactive status');
    }
    // active status
    public function status($id){
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        return response()->json('active status');
    }

    // product delete
    public function Destroy($id){
        DB::table('products')->where('id',$id)->delete();
        $notification = array('messege'=>" Product deleted!",'alert-type'=>'danger');
        return redirect()->back()->with($notification);
    }
}
