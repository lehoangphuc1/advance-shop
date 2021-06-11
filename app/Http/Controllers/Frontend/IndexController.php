<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class IndexController extends Controller
{
    public function index(){
    	return view('frontend.index');
    }
    public function UserLogout(){
    	Auth::logout();
    	return Redirect()->route('login');
    }
    public function UserProfile(){
    	$id = Auth::user()->id;
    	$user = User::find($id);
    	return view('frontend.profile.user_profile',compact('user'));
    }
    public function UserProfileStore(Request $rq){
    	$data = User::find(Auth::user()->id); //lam dua theo AdminProfileController
    	$data->name = $rq->name;
    	$data->email = $rq->email;
    	$data->phone = $rq->phone;

    	if($rq->file('profile_photo_path')){
    		$file = $rq->file('profile_photo_path');
    		@unlink(public_path('upload/user_images/'.$data->profile_photo_path));
    		$filename = date('YmdHi').$file->getClientOriginalName();//mã hóa ên file
    		$file->move(public_path('upload/user_images'),$filename); // chuyển đến thư mục lưu
    		$data['profile_photo_path'] = $filename;
    	}
    	$data->save();
        $notification = array(
            'message' =>'User Profile Updated Successfully',
            'alert-type'=> 'success'
        );
    	return redirect()->route('dashboard')->with($notification);
    }// end method

    public function UserChangePassword(){
    	$id = Auth::user()->id;
    	$user = User::find($id);
    	return view('frontend.profile.change_password',compact('user'));
    }

     public function UserPasswordUpdate(Request $rq){
        $validateData = $rq->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($rq->oldpassword,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($rq->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
             return redirect()->back(); 
        };
    }
}
