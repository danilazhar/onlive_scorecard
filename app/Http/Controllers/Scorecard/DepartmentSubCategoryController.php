<?php

namespace App\Http\Controllers\Scorecard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\DepartmentCategory;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\DepartmentSubCategory;
use Exception;
use Carbon\Carbon;
use Validator;

class DepartmentSubCategoryController extends Controller
{
    public function index(Request $request)
    {   

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $sub_categories = DepartmentSubCategory::orderBy('id', 'desc')->get();   
        return view('DepartmentSubCategory.index')
            ->with('sub_categories', $sub_categories);

    }

    public function create()
    {
        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $user_role = request()->session()->get('role_id');
        $user_department = request()->session()->get('department_id');

        $departments = Department::where('status', true)->get(); 
        $department_categories = ($user_role == 2) ? DepartmentCategory::where('department_id', $user_department)->where('status', true)->get() : DepartmentCategory::where('status', true)->get(); 
        $sub_categories = SubCategory::where('status', true)->get(); 

        return view('DepartmentSubCategory.create')
            ->with('departments', $departments)
            ->with('department_categories', $department_categories)
            ->with('sub_categories', $sub_categories);

    }

    public function postCreate(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
            'category' => 'required',
            'sub_category' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('sub_category.create')
                    ->withErrors($validator)
                    ->withInput();
        }

        try {

            DepartmentSubCategory::insert([
                'department_category_id' =>  $request->get('category'),
                'subcategory_id' =>  $request->get('sub_category'),
                'critical' =>  $request->get('critical'),
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('department_subcategory')->with('success', 'Sub Category created.');
            
        } 
        catch (Exception $e) {

            return redirect()->route('department_subcategory')->with('error', $e->getMessage());

        }

    }

    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $user_role = request()->session()->get('role_id');
        $user_department = request()->session()->get('department_id');

        $departments = Department::where('status', true)->get(); 
        $department_categories = ($user_role == 2) ? DepartmentCategory::where('department_id', $user_department)->where('status', true)->get() : DepartmentCategory::where('status', true)->get(); 
        $sub_category = DepartmentSubCategory::firstWhere('id', $id);
        $sub_categories = SubCategory::where('category_id', $sub_category->department_category->category_id)->where('status', true)->get(); 


        if($sub_category == null) {

            return redirect()->route('department_subcategory')->with('error', 'Sub Category not found');

        }

        return view('DepartmentSubCategory.edit')
            ->with('subcategory', $sub_category)
            ->with('departments', $departments)
            ->with('department_categories', $department_categories)
            ->with('sub_categories', $sub_categories);

    }

    public function postUpdate(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [ 
            'category' => 'required',
            'sub_category' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('department_sub_category.update', ['id' => $id])
                    ->withErrors($validator)
                    ->withInput();
        }
        
        try {
            
            $sub_category = DepartmentSubCategory::find($id);
            $sub_category->update([
                    'department_category_id' =>  $request->get('category'),
                    'subcategory_id' =>  $request->get('sub_category'),
                    'critical' =>  $request->get('critical'),
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect()->route('department_subcategory')->with('success', 'Sub Category updated.');

        }
        catch (Exception $e) {

            return redirect()->route('department_subcategory')->with('error', $e->getMessage());

        }

    }

    public function getSubCategoryByDepartment($id){
        
        $subcategories = DepartmentSubCategory::with('department_category')
            ->whereHas('department_category', function($q) use($id){
                $q->where('department_id','=', $id);
            })
            ->with('subcategory:id,name')
            ->orderBy('id', 'DESC')
            ->get();
            
        return response()->json(['subcategories' => $subcategories]);
        
    }

}