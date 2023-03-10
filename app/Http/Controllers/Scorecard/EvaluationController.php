<?php

namespace App\Http\Controllers\Scorecard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Evaluation;
use App\Models\Department;
use App\Models\DepartmentCategory;
use App\Models\Passrate;
use Exception;
use Carbon\Carbon;
use Validator;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $evaluations = Evaluation::where('status', '!=', '3')->orderBy('id', 'desc')->get();     
        $departments = Department::where('status', true)->orderBy('id', 'desc')->get();     

        return view('Evaluation.index')
            ->with('departments', $departments)
            ->with('evaluations', $evaluations);

    }

    public function create(Request $request)
    {
        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $users = User::where('department_id', $request->get('department'))->where('status', true)->orderBy('id', 'desc')->get(); 
        $evaluator = User::where('id', request()->session()->get('user_id'))->first();
        $department = Department::where('id', $request->get('department'))->first();
        $department_data = DepartmentCategory::getAllCriterias($request->get('department'));
        $category_listing = DepartmentCategory::getCategoryForAllCriteria($request->get('department'));
        $department_critical_category = DepartmentCategory::getAllCriticalCriterias($request->get('department'));
        $passrate = Passrate::where('department_id', $request->get('department'))->first();
        
        return view('Evaluation.create')
            ->with('department_id', $request->get('department'))
            ->with('users', $users)
            ->with('evaluator', $evaluator)
            ->with('department', $department)
            ->with('department_data', $department_data)
            ->with('category_listing', $category_listing)
            ->with('department_critical_category', $department_critical_category)
            ->with('department_critical_category_tab', $department_critical_category)
            ->with('department_critical_category_content', $department_critical_category)
            ->with('passrate', $passrate->rate);

    }

    public function postCreate(Request $request)
    {
        $data = $request->input('data');

        try {
            Evaluation::create_evaluation($data);
            return response()->json(['status' => 1, 'message' => 'Evaluation Created']);
        } 
        catch (Exception $e) {
            return redirect()->route('evaluation')->with('error', $e->getMessage());
        }
    }

}