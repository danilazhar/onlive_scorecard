<?php

namespace App\Http\Controllers\Scorecard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Carbon\Carbon;
use Validator;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {   

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $sub_categories = SubCategory::orderBy('id', 'desc')->get();     
        return view('SubCategory.index')
            ->with('sub_categories', $sub_categories);

    }

    public function create()
    {
        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $categories = Category::where('status', true)->get(); 
        return view('SubCategory.create')->with('categories', $categories);

    }

    public function postCreate(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'category' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('sub_category.create')
                    ->withErrors($validator)
                    ->withInput();
        }

        try {

            SubCategory::insert([
                'category_id' =>  $request->get('category'),
                'name' =>  $request->get('name'),
                'description' =>  $request->get('description'),
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('sub_category')->with('success', 'Sub Category created.');
            
        } 
        catch (Exception $e) {

            return redirect()->route('sub_category')->with('error', $e->getMessage());

        }

    }

    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $sub_category = SubCategory::firstWhere('id', $id);
        $categories = Category::where('status', true)->get();

        if($sub_category == null) {

            return redirect()->route('sub_category')->with('error', 'Sub Category not found');

        }

        return view('SubCategory.edit')
            ->with('sub_category', $sub_category)->with('categories', $categories);

    }

    public function postUpdate(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'category' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('sub_category.update', ['id' => $id])
                    ->withErrors($validator)
                    ->withInput();
        }
        
        try {
            
            $sub_category = SubCategory::find($id);
            $sub_category->update([
                    'category_id' =>  $request->get('category'),
                    'name' =>  $request->get('name'),
                    'description' =>  $request->get('description'),
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect()->route('sub_category')->with('success', 'Sub Category updated.');

        }
        catch (Exception $e) {

            return redirect()->route('sub_category')->with('error', $e->getMessage());

        }

    }

    public function getSubCategoryByCategory($id){

        $subcategories = SubCategory::getSubCategoryByCategory($id);
        return response()->json(['subcategories' => $subcategories]);
        
    }

}