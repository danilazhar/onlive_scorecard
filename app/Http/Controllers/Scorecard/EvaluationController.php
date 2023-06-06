<?php

namespace App\Http\Controllers\Scorecard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Evaluation;
use App\Models\EvaluationPoint;
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
            return response()->json(['status' => 1, 'message' => 'Evaluation created']);
        } 
        catch (Exception $e) {
            return redirect()->route('evaluation')->with('error', $e->getMessage());
        }
    }

    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $evaluation = Evaluation::where('id', $id)->first();
        $evaluation_critical = EvaluationPoint::where('evaluation_id', $evaluation->id)->where('critical', 'yes')->get();
        $department = Department::where('id', $evaluation->department_id)->first();
        $users = User::where('department_id', $evaluation->department_id)->where('status', true)->orderBy('id', 'desc')->get(); 
        $evaluator = User::where('id', request()->session()->get('user_id'))->first();
        $department = Department::where('id', $evaluation->department_id)->first();

        $eval_data = [];

        $categories = [];
        $subcategories = [];
        $criterias = [];

        foreach ($evaluation->evaluation_points as $eval) {
            if($eval->critical !== "yes"){
                $criteria = $eval->department_criteria;
                $subcategory = $criteria->department_subcategory;
                $category = $subcategory->department_category;
                if (!key_exists($category->id, $categories)) {
                    $categories[$category->id] = $category;
                }
                if (!key_exists($subcategory->id, $subcategories)) {
                    $subcategories[$subcategory->id] = $subcategory;
                }
                if (!key_exists($criteria->id, $criterias)) {
                    $criterias[$criteria->id] = $criteria;
                }
            }
        }
        $eval_data = [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'criterias' => $criterias
        ];

        $department_data = $eval_data;

        $category_listing = DepartmentCategory::getCategoryForAllCriteria($evaluation->department_id);
        $department_critical_category = DepartmentCategory::getAllCriticalCriterias($evaluation->department_id);
        $passrate = Passrate::where('department_id', $evaluation->department_id)->first();

        return view('Evaluation.edit')
            ->with('users', $users)
            ->with('evaluation', $evaluation)
            ->with('evaluation_points', $evaluation->evaluation_points)
            ->with('evaluation_points_critical', $evaluation_critical)
            ->with('evaluator', $evaluator)
            ->with('department', $department)
            ->with('department_data', $department_data)
            ->with('category_listing', $category_listing)
            ->with('department_critical_category', $department_critical_category)
            ->with('department_critical_category_tab', $department_critical_category)
            ->with('department_critical_category_content', $department_critical_category)
            ->with('passrate', $passrate->rate);

    }

    public function postUpdate(Request $request, int $id)
    {
        $data = $request->input('data');

        try {
            Evaluation::update_evaluation($id, $data, 2);
            return redirect()->route('evaluation')->with('success', 'Evaluation updated.');
        }
        catch (Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()]);
        }
    }

}