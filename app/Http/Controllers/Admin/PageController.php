<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $page = DB::table('pages')->get();
        return view('admin.setting.pages.index',compact('page'));
    }

    // page create form
    public function create(){
        return view('admin.setting.pages.create');
    }

    public function store(Request $request){
        $data = array();
        $data['page_position'] = $request->page_position;
        $data['page_name'] = $request->page_name;
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;
        $data['page_slug'] = Str::slug($request->page_name,'-');

        DB::table('pages')->insert($data);
        $notification = array('messege'=>" Page created Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id){
        DB::table('pages')->where('id',$id)->delete();
        $notification = array('messege'=>" Page deleted Successfully!",'alert-type'=>'danger');
        return redirect()->back()->with($notification);
    }

    public function edit($id){
        $page = DB::table('pages')->where('id',$id)->first();
        return view('admin.setting.pages.edit',compact('page'));
    }

    public function update(Request $request,$id){
        $data = array();
        $data['page_position'] = $request->page_position;
        $data['page_name'] = $request->page_name;
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;
        $data['page_slug'] = Str::slug($request->page_name,'-');

        DB::table('pages')->where('id',$id)->update($data);
        $notification = array('messege'=>" Page update Successfully!",'alert-type'=>'success');
        return redirect()->route('page.index')->with($notification);

    }

}
