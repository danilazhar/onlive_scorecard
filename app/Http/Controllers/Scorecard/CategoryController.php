<?php

namespace App\Http\Controllers\Scorecard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Exception;
use Carbon\Carbon;
use Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {   

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $categories = Category::orderBy('id', 'desc')->get();     
        return view('Category.index')
            ->with('categories', $categories);

    }

    public function create()
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }
        
        return view('Category.create');

    }

    public function postCreate(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('category.create')
                    ->withErrors($validator)
                    ->withInput();
        }

        try {

            Category::insert([
                'name' =>  $request->get('name'),
                'description' =>  $request->get('description'),
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('category')->with('success', 'Category created.');
            
        } 
        catch (Exception $e) {

            return redirect()->route('category')->with('error', $e->getMessage());

        }

    }

    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $category = Category::firstWhere('id', $id);

        if($category == null) {

            return redirect()->route('category')->with('error', 'Category not found');

        }

        return view('Category.edit')
            ->with('category', $category);

    }

    public function postUpdate(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('category.update', ['id' => $id])
                    ->withErrors($validator)
                    ->withInput();
        }
        
        try {
            
            $category = Category::find($id);
            $category->update([
                    'name' =>  $request->get('name'),
                    'description' =>  $request->get('description'),
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect()->route('category')->with('success', 'Category updated.');

        }
        catch (Exception $e) {

            return redirect()->route('category')->with('error', $e->getMessage());

        }

    }

}