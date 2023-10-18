<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct product list page
    public function list(){
        $products = Product::select('products.*','categories.name as category_name')
                    ->when(request('key'), function ($query) {
                        $query->where('products.name', 'like', '%' . request('key') . '%');
                    })
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->orderBy('products.id','desc')
                    ->paginate(3);

        return view('admin.products.pizzaList',compact('products'));
    }

    //direct product create page
    public function createPage(){
        $categories = Category::select(['id','name'])->get();
        return view('admin.products.create',compact('categories'));
    }

    //direct product delete
    public function delete($id){
        Product::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Product deleted!']);
    }

    //direct product view page
    public function view($id){
        $product = Product::select('products.*','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->where('products.id', $id)
                    ->first();
        return view('admin.products.view',compact('product'));
    }

    //direct product edit page
    public function edit($id){
        $product = Product::where('id', $id)->first();
        $categories = Category::get();
        return view('admin.products.edit',compact(['product','categories']));
    }

    //direct product update
    public function update(Request $request){
        $this->productUpdateValidationCheck($request);
        $data = $this->getUpdateProductData($request);


        if($request->hasFile('image')){
            $oldImageName = Product::where('id', $request->productId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/' . $oldImageName);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        Product::where('id', $request->productId)->update($data);
        return redirect()->route('products#list')->with(['updateSuccess' => 'Product Updated!']);
    }

    //product update validation
    private function productUpdateValidationCheck($request){
        Validator::make($request->all(), [
            'name'=>'required | min:5 | unique:products,name,'. $request->productId,
            'category'=>['required'],
            'description'=>'required',
            'image'=>'mimes:jpg,png,jpeg|file',
            'price'=>'required',
            'waitingTime'=>'required',
            'updated_at'=>Carbon::now()
        ])->validate();
    }

    //
    private function getUpdateProductData($request){
        return [
            'name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'price'=>$request->price,
            'waiting_time'=>$request->waitingTime
        ];
    }


    //direct product create
    public function create(Request $request){
        $this->productCreateValidationCheck($request);
        $data = $this->getProductData($request);

        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('products#list')->with(['createSuccess' => 'Product Creatd!']);
    }
    //product create validation
    private function productCreateValidationCheck($request){
        Validator::make($request->all(), [
            'name'=>'required | min:5 | unique:products,name',
            'category'=>'required',
            'description'=>'required',
            'image'=>'required | mimes:jpg,png,jpeg|file',
            'price'=>'required',
            'waitingTime'=>'required'
        ])->validate();
    }
    //get user data function
    private function getProductData($request){
        return [
            'name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'image'=>$request->image,
            'price'=>$request->price,
            'waiting_time'=>$request->waitingTime
        ];
    }
}
