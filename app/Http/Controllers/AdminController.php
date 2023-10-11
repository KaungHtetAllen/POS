<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //direct account profile page
    public function account(){
        return view('admin.account.profile');
    }

    //direct account profile edit page
    public function edit(){
        return view('admin.account.edit');
    }

    //direct update profile
    public function update(Request $request, $id){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //image
        if($request->hasFile('image')){
            $dbImage = User::where('id', $id)->first()->image;

            if($dbImage != null){
                Storage::delete('public/' . $dbImage);
            }

            //store image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);

            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return redirect()->route('admin#account')->with(['updateSuccess' => 'Profile Updated!']);
    }


    //account validation
    private function accountValidationCheck($request){
        Validator::make($request->all(), [
            'name'=>['required'],
            'email'=>['required'],
            'gender'=>['required'],
            'phone'=>['required'],
            'address'=>['required'],
        ])->validate();
    }
    //get user data function
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'image'=>$request->image,
            'updated_at'=>Carbon::now()
        ];
    }


     //direct admin password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //direct admin change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $user = User::where('id', Auth::user()->id)->first();
        $dbPassword = $user->password;

        if (Hash::check($request->oldPassword,$dbPassword)){
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return redirect()->route('category#list')->with(['changePasswordSuccess'=>'Password Changed!']);
        }
        return back()->with(['notMatch' => "Your old password is wrong! Please check again!"]);

    }





    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(), [
            'oldPassword' => 'required | min:6',
            'newPassword' => 'required | min:6',
            'confirmPassword' => 'required | min:6 | same:newPassword'
        ])->validate();
    }

}
