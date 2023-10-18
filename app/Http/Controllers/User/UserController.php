<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct home page
    public function home(){
        $products = Product::orderBy('created_at','desc')->get();
        $categories = Category::paginate(5);
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home',compact('products','categories','carts'));
    }

    //direct filter home page
    public function filter($categoryId){
        $products = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $categories = Category::paginate(5);
        return view('user.main.home',compact('products','categories','carts'));
    }


    //direct pizza details
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id', $pizzaId)->first();
        $products = Product::get();
        return view('user.main.details',compact('pizza','products'));
    }

    //direct cart list page
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image')
                    ->leftJoin('products','carts.product_id','products.id')
                    ->where('carts.user_id', Auth::user()->id)->get();
        // dd($carts->toArray());

        $totalPrice = 0;
        foreach ($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->quantity;

        }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //account profile
    public function changeAccountPage(){
        return view('user.profile.account');
    }

    //direct account change
    public function changeAccount($id,Request $request){
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
        return redirect()->route('user#home')->with(['updateSuccess' => 'Profile Updated!']);
    }

    //account validation
    private function accountValidationCheck($request){
        Validator::make($request->all(), [
            'name'=>['required'],
            'email'=>['required'],
            'gender'=>['required'],
            'phone'=>['required'],
            'address'=>['required'],
            'image'=>['mimes:jpg,png,jpeg|file']
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
            'updated_at'=>Carbon::now()
        ];
    }
    //direct change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //direct change password
    public function changePassword(Request $request){
         $this->passwordValidationCheck($request);

        $user = User::where('id', Auth::user()->id)->first();
        $dbPassword = $user->password;

        if (Hash::check($request->oldPassword,$dbPassword)){
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return redirect()->route('user#home')->with(['changePasswordSuccess'=>'Password Changed!']);
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
