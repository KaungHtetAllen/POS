<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //direct category list page
    public function list(){
        $categories = Category::when(request('key'), function ($query) {
                      $query->where('name', 'like', '%'.request('key').'%');
                                })
                            ->orderBy('id', 'asc')
                            ->paginate(3);
        return view('admin.category.list',compact('categories'));
    }

    //direct category create page
    public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = ['name' => $request->categoryName];
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess'=>'Category Created!']);
    }


    //delete category
    public function delete($id){
        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted!']);
    }

    //direct edit page
    public function edit($id){
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    //direct update
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data = ['name' => $request->categoryName];
        Category::where('id', $request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess'=>'Category Updated!']);
    }


    //category validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(), [
            'categoryName' => 'required|min:7|unique:categories,name,' . $request->categoryId
        ])->validate();
    }
}
