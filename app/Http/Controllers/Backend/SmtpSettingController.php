<?php

namespace App\Http\Controllers\Backend;
use Carbon\Carbon;
use App\Models\Smtp;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SmtpSettingController extends Controller
{
    public function AllSmtp(){
        $smtps = Smtp::find(1);
        return view('admin.backend.setting.smtp_setting',compact('smtps'));

    }//end section

    public function AdminUpdateSmtp(Request $request){
        $smtp_id = $request->id;

        Smtp::find($smtp_id)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);
        $notification= array(
            'message' => 'SMTP Setting Updated Successfully',
            'alert-type' =>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function FrontPageSettings(){
        $frontpage = SiteSetting::find(1);
        return view('admin.backend.setting.front_page_setting',compact('frontpage'));
    }

    public function AdminUpdateSiteSettings(Request $request){
        ini_set('memory_limit', '512M');
        $site_id = $request->id;
        $frontpage = SiteSetting::find($site_id);

        if($request->file('logo')){
            // If a new image is uploaded, delete the old image
            if (file_exists($frontpage->logo)) {
                unlink($frontpage->logo);
            }

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('logo')->getClientOriginalExtension();
            $img = $manager->read($request->file('logo'));
            $img->resize(194, 110);

            $save_url = 'upload/site_logo/' . $name_gen;
            $img->save(public_path($save_url));

            // Update the category with the new image URL
            $frontpage->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'watch_preview' => $request->watch_preview,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
                'copyright' => $request->copyright,
                'currency' => $request->currency,
                'logo' => $save_url,
            ]);

            $notification= array(
                'message' => 'Site Updated with image Successfully',
                'alert-type' =>'success'
            );

            return redirect()->back()->with($notification);
        } else {
            // If no new image is uploaded, update the category without changing the image
            $frontpage->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'watch_preview' => $request->watch_preview,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
                'copyright' => $request->copyright,
                'currency' => $request->currency,
            ]);

            $notification= array(
                'message' => 'Site updated without image Successfully',
                'alert-type' =>'success'
            );

            return redirect()->back()->with($notification);
        }
    }




}
