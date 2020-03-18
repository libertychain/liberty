<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Slider;
use App\Series;
use App\Movies;
use App\HomeSection;
use App\SubscriptionPlan; 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Str; 
use Session;


class UserController extends Controller
{
      
    public function dashboard()
    {
        if(!Auth::check())
        {

            \Session::flash('error_flash_message', trans('words.access_denied'));

            return redirect('login');
            
        }

        if(Auth::user()->usertype=='Admin' OR Auth::user()->usertype=='Sub_Admin')
        {
            return redirect('admin/dashboard'); 
        }

        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id); 

        return view('pages.dashboard',compact('user'));
    }

    public function profile()
    { 
       
        if(!Auth::check())
       {

            \Session::flash('error_flash_message', trans('words.access_denied'));

            return redirect('login');
            
        }

        if(Auth::User()->usertype=="Admin" OR Auth::User()->usertype=="Sub_Admin")
        { 
            return redirect('admin');            
        } 

        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id); 

        return view('pages.profile',compact('user'));
    } 
    

    public function editprofile(Request $request)
    { 
        
        $id=Auth::user()->id;    
        $user = User::findOrFail($id);

        $data =  \Request::except(array('_token'));
        
        $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:255|unique:users,email,'.$id,
                'user_image' => 'mimes:jpg,jpeg,gif,png'
                 );
        
         $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
        

        $inputs = $request->all();
        
        $icon = $request->file('user_image');
        
                 
        if($icon){

            \File::delete(public_path('/upload/').$user->user_image);            

            //$tmpFilePath = public_path().'/upload/';
            $tmpFilePath = public_path('/upload/');

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            //$img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $user->user_image = $hardPath.'-b.jpg';
        }
        
        
        $user->name = $inputs['name'];          
        $user->email = $inputs['email']; 
        $user->phone = $inputs['phone'];
        $user->user_address = $inputs['user_address'];
        
        if($inputs['password'])
        {
            $user->password = bcrypt($inputs['password']);
        }         
       
        $user->save();

        Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
         
         
    }

    public function membership_plan()
    { 
       
        if(!Auth::check())
       {

            \Session::flash('error_flash_message', trans('words.access_denied'));

            return redirect('login');
            
        }

        if(Auth::User()->usertype=="Admin" OR Auth::User()->usertype=="Sub_Admin")
        { 
            return redirect('admin');            
        } 

         
        $plan_list = SubscriptionPlan::where('status','1')->orderby('id')->get(); 

        return view('pages.membership_plan',compact('plan_list'));
    }

    public function payment_method($plan_id)
    { 
       
        if(!Auth::check())
        {
            \Session::flash('error_flash_message', trans('words.access_denied'));
            return redirect('login');            
        }
        if(Auth::User()->usertype=="Admin" OR Auth::User()->usertype=="Sub_Admin")
        { 
            return redirect('admin');            
        } 

        $plan_info = SubscriptionPlan::where('id',$plan_id)->where('status','1')->first();

        if(!$plan_info)
        {
            \Session::flash('flash_message', 'Select plan!');
            return redirect('membership_plan'); 
        }  
 
        return view('pages.payment_method',compact('plan_info'));
    }
 
}
