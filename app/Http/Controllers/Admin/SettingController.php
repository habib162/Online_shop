<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //  seo page show mettod
    public function seo(){
        $data = DB::table('seos')->first();
        return view('admin.setting.seo', compact('data'));
    }
    public function seoupdate(Request $request,$id){

        $data = array();
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_description']=$request->meta_description;
        $data['google_verification']=$request->google_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;
        $data['alexa_verification']=$request->alexa_verification;

        DB::table('seos')->where('id',$id)->update($data);
        $notification = array('messege'=>" SEO Updated Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    // smtp setting page
    public function smtp(){
        $smtp = DB::table('smtps')->first();
        return view('admin.setting.smtp',compact('smtp'));
    }

    // smtp update
    public function smtpupdate(Request $request,$id){

        $data = array();
        $data['mailer']=$request->mailer;
        $data['host']=$request->host;
        $data['port']=$request->port;
        $data['user_name']=$request->user_name;
        $data['password']=$request->password;

        DB::table('smtps')->where('id',$id)->update($data);
        $notification = array('messege'=>" SMTP Updated Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    // website setting
    public function website(){
        $setting = DB::table('settings')->first();
        return view('admin.setting.website',compact('setting'));
    }

    public function websiteupdate(Request $request,$id){

        $data = array();
        $data['currency'] = $request->currency;
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['mail_email'] = $request->mail_email;
        $data['support_email'] = $request->support_email;
        $data['address'] = $request->address;
        $data['facebook'] = $request->facebook;
        $data['tweeter'] = $request->tweeter;
        $data['instagram'] = $request->instagram;
        $data['linkedin'] = $request->linkedin;
        $data['youtube'] = $request->youtube;
        
        if ($request->logo) {
            if(File::exists($request->old_logo)){
                unlink($request->old_logo);
            }
            $logo = $request -> logo;
        $logoname = uniqid().'.'.$logo->getClientOriginalExtension();
        $destinationfile = 'public/Files/setting/';
        Image::make($logo)->resize(320,120)-> save($destinationfile.$logoname); // image intervention
        $data['logo']=$destinationfile.$logoname;
        }
        else{
            $data['logo']->$request->old_logo;
        }

        if ($request->favicon) {
            if(File::exists($request->old_favicon)){
                unlink($request->old_favicon);
            }
            $favicon = $request -> favicon;
        $favicon_name = uniqid().'.'.$favicon->getClientOriginalExtension();
        $destinationfile = 'public/Files/setting/';
        Image::make($favicon)->resize(32,32)-> save($destinationfile.$favicon_name); // image intervention
        $data['favicon']=$destinationfile.$favicon_name;
        }
        else{
            $data['favicon']->$request->old_favicon;
        }

        
        DB::table('settings')->where('id',$id)->update($data);
        $notification = array('messege'=>" Setting updated Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
}
