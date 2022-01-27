<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // inde method for read data
    public function index(){
        // query builder with one to one join
        $data =DB::table('subcategories')->leftjoin('categories','subcategories.category_id','categories.id')
            ->select('subcategories.*','categories.category_name')->get();

        // Eloquent ORM
        // $data = Subcategory::all();
        // $category=Category::all(); 7-no video te baki onsho ase

         $category=DB::table('categories')->get();
        return view('admin.subcategory.index',compact('data','category'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'subcategory_name' => 'required|max:25',
        ]);

        // $data = array();
        // $data['category_id']=$request->category_id;
        // $data['subcategory_name']=$request->subcategory_name;
        // $data['subcat_slug']=Str::slug($request->subcategory_name,'-');
        // DB::table('subcategories')->insert($data);

        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcat_slug' => Str::slug($request->subcategory_name,'-')
            
        ]);

        $notification = array('messege'=>" Sub-Category Inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
        

    }

    // delete category
    public function Destroy($id){
        // DB::table('subcategories')->where('id',$id)->delete();//query builder
        // elequent ORM
        $Subcategory=Subcategory::find($id);
        $Subcategory->delete();
        $notification = array('messege'=>" Sub-Category Deleted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    // edit subcategory

    public function edit($id){
        // elequent orm
        // $data=Subcategory::find($id);
        // $category = Category::all();

        $data = Subcategory::find($id);
        $category=DB::table('categories')->get();

        return view('admin.subcategory.edit',compact('data','category'));

    }

    public function update(Request $request){
          // Eloquent ORM
        // $subCategory = SubCategory::where('id', $request->id)->first();

        // $subCategory->update([
        //     'category_id' => $request->category_id,
        //     'subcategory_name' => $request->subcategory_name,
        //     'subcat_slug' => Str::slug($request->subcategory_name,'-')
        // ]);

        // query builder
        $data = array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        $data['subcat_slug']=Str::slug($request->subcategory_name,'-');
        DB::table('subcategories')->where('id',$request->id)->update($data);
        
        $notification = array('messege'=>" SubCategory Updated Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
