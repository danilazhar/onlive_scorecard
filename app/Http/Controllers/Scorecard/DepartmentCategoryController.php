<?php

namespace App\Http\Controllers\Scorecard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Department;
use App\Models\DepartmentCategory;
use Exception;
use Carbon\Carbon;
Use Validator;

class DepartmentCategoryController extends Controller
{

    public function index(Request $request)
    {   

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $categories = DepartmentCategory::orderBy('id', 'desc')->get();     
        return view('DepartmentCategory.index')
            ->with('categories', $categories);

    }

    public function create()
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $departments = Department::where('status', true)->get();
        $categories = Category::where('status', true)->get();
        
        return view('DepartmentCategory.create')
            ->with('departments', $departments)
            ->with('categories', $categories);

    }

    public function postCreate(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
            'department' => 'required',
            'category' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('department_category.create')
                    ->withErrors($validator)
                    ->withInput();
        }

        try {

            DepartmentCategory::insert([
                'department_id' =>  $request->get('department'),
                'category_id' =>  $request->get('category'),
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('department_category')->with('success', 'Category created.');
            
        } 
        catch (Exception $e) {

            return redirect()->route('department_category')->with('error', $e->getMessage());

        }

    }

    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $category = DepartmentCategory::firstWhere('id', $id);
        $departments = Department::where('status', true)->get();
        $categories = Category::where('status', true)->get();

        if($category == null) {

            return redirect()->route('department_category')->with('error', 'Category not found');

        }

        return view('DepartmentCategory.edit')
            ->with('category', $category)
            ->with('departments', $departments)
            ->with('categories', $categories);

    }

    public function postUpdate(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [ 
            'department' => 'required',
            'category' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('department_category.update', ['id' => $id])
                    ->withErrors($validator)
                    ->withInput();
        }
        
        try {
            
            $category = DepartmentCategory::find($id);
            $category->update([
                    'department_id' =>  $request->get('department'),
                    'category_id' =>  $request->get('category'),
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect()->route('department_category')->with('success', 'Category updated.');

        }
        catch (Exception $e) {

            return redirect()->route('department_category')->with('error', $e->getMessage());

        }

    }

    public function getCategoryByDepartment($id){
        
        $categories = DepartmentCategory::getCategoryByDepartment($id);
        return response()->json(['categories' => $categories]);
        
    }

}