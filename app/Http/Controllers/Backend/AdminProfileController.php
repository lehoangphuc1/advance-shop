<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function AdminProfile(){
    	$adminData = Admin::find(1);
    	/*echo "<pre>";
    	print_r($adminData);
    	echo "</pre>";die;*/
    	return view('admin.admin_profile_view',compact('adminData'));
    }
    public function AdminProfileEdit(){
    	$editData = Admin::find(1);
    	return view('admin.admin_profile_edit',compact('editData'));
    }
    public function AdminProfileStore(Request $rq){
    	$data = Admin::find(1);
    	$data->name = $rq->name;
    	$data->email = $rq->email;

    	if($rq->file('profile_photo_path')){
    		$file = $rq->file('profile_photo_path');
    		@unlink(public_path('upload/admin_images/'.$data->profile_photo_path));// xoa anh co san
    		$filename = date('YmdHi').$file->getClientOriginalName();//mã hóa ên file
    		$file->move(public_path('upload/admin_images'),$filename); // chuyển đến thư mục lưu
    		$data['profile_photo_path'] = $filename;
    	}
    	$data->save();
        $notification = array(
            'message' =>'Admin Profile Updated Successfully',
            'alert-type'=> 'success'
        );
    	return redirect()->route('admin.profile')->with($notification);

    }

    public function AdminChangePassword(){

        return view('admin.admin_change_password');
    }
    public function AdminUpdateChangePassword(Request $rq){
        $validateData = $rq->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Admin::find(1)->password;
        if(Hash::check($rq->oldpassword,$hashedPassword)){
            $admin = Admin::find(1);
            $admin->password = Hash::make($rq->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
             return redirect()->back(); 
        };
    }
}
