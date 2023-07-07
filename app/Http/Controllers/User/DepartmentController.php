<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use Exception;
use Carbon\Carbon;

class DepartmentController extends Controller
{

    public function index(Request $request)
    {   
        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $departments = Department::orderBy('id', 'desc')->get();     
        return view('Department.index')
            ->with('departments', $departments);
    }

    public function create()
    {

        return view('Department.create');

    }

    public function postCreate(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('department')
                    ->withErrors($validator)
                    ->withInput($request->all());
        }

        try {
            Department::insert([
                'name' =>  $request->get('name'),
                'description' =>  $request->get('description'),
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('department')->with('success', 'Department created.');
        } 
        catch (Exception $e) {
            return redirect()->route('department')->with('error', $e->getMessage());
        }

    }

    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $department = Department::firstWhere('id', $id);

        if($department == null) {
            return redirect()->route('department')->with('error', 'Department not found');
        }
        return view('Department.edit')
            ->with('department', $department);

    }

    public function postUpdate(Request $request, int $id)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('department')
                    ->withErrors($validator)
                    ->withInput($request->all());
        }
        
        try {
            
            $department = Department::find($id);
            $department->update([
                    'name' =>  $request->get('name'),
                    'description' =>  $request->get('description'),
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect()->route('department')->with('success', 'Department updated.');

        }
        catch (Exception $e) {

            return redirect()->route('department')->with('error', $e->getMessage());

        }

    }


}