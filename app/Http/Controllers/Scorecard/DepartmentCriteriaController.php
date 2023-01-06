<?php

namespace App\Http\Controllers\Scorecard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\DepartmentCategory;
use App\Models\DepartmentSubCategory;
use App\Models\DepartmentCriteria;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Criteria;
use Exception;
use Carbon\Carbon;
use Validator;

class DepartmentCriteriaController extends Controller
{
    public function index(Request $request)
    {   

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $criterias = DepartmentCriteria::orderBy('id', 'desc')->get();     
        return view('DepartmentCriteria.index')
            ->with('criterias', $criterias);

    }

    public function create()
    {
        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $departments = Department::where('status', true)->get(); 
        $department_subcategories = DepartmentSubCategory::where('status', true)->get();
        $criterias = Criteria::where('status', true)->get(); 

        return view('DepartmentCriteria.create')
            ->with('departments', $departments)
            ->with('department_subcategories', $department_subcategories)
            ->with('criterias', $criterias);

    }

    public function postCreate(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
            'subcategory' => 'required',
            'criteria' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('department_criteria.create')
                    ->withErrors($validator)
                    ->withInput();
        }

        try {

            DepartmentCriteria::insert([
                'department_subcategory_id' =>  $request->get('subcategory'),
                'criteria_id' =>  $request->get('criteria'),
                'points' =>  $request->get('points'),
                'guidelines' =>  $request->get('guidelines'),
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('department_criteria')->with('success', 'Criteria created.');
            
        } 
        catch (Exception $e) {

            return redirect()->route('department_criteria')->with('error', $e->getMessage());

        }

    }

    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $departments = Department::where('status', true)->get(); 
        $department_subcategories = DepartmentSubCategory::where('status', true)->get();
        $criterias = Criteria::where('status', true)->get(); 
        $criteria = DepartmentCriteria::firstWhere('id', $id);

        if($criteria == null) {

            return redirect()->route('department_criteria')->with('error', 'Criteria not found');

        }

        return view('DepartmentCriteria.edit')
            ->with('criteria', $criteria)
            ->with('departments', $departments)
            ->with('department_subcategories', $department_subcategories)
            ->with('criterias', $criterias);

    }

    public function postUpdate(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [ 
            'subcategory' => 'required',
            'criteria' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('department_criteria.update', ['id' => $id])
                    ->withErrors($validator)
                    ->withInput();
        }
        
        try {
            
            $criteria = DepartmentCriteria::find($id);
            $criteria->update([
                    'department_subcategory_id' =>  $request->get('subcategory'),
                    'criteria_id' =>  $request->get('criteria'),
                    'points' =>  $request->get('points'),
                    'guidelines' =>  $request->get('guidelines'),
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect()->route('department_criteria')->with('success', 'Sub Category updated.');

        }
        catch (Exception $e) {

            return redirect()->route('department_subcategory')->with('error', $e->getMessage());

        }

    }

}