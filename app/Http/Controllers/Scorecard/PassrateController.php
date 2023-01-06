<?php

namespace App\Http\Controllers\Scorecard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Passrate;
use App\Models\Department;
use Exception;
use Carbon\Carbon;
use Validator;

class PassrateController extends Controller
{

    public function index(Request $request)
    {   

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $passrates = Passrate::orderBy('id', 'desc')->get();     
        return view('Passrate.index')
            ->with('passrates', $passrates);

    }

    public function create()
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }
        
        $departments = Department::where('status', true)->get(); 
        return view('Passrate.create')->with('departments', $departments);

    }

    public function postCreate(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
            'department' => 'required',
            'rate' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('passrate.create')
                    ->withErrors($validator)
                    ->withInput();
        }

        try {
            Passrate::insert([
                'department_id' =>  $request->get('department'),
                'rate' =>  $request->get('rate'),
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('passrate')->with('success', 'Passrate created.');
        } 
        catch (Exception $e) {
            return redirect()->route('passrate')->with('error', $e->getMessage());
        }

    }

    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $passrate = Passrate::firstWhere('id', $id);
        $departments = Department::where('status', true)->get();

        if($passrate == null) {
            return redirect()->route('passrate')->with('error', 'Passrate not found');
        }
        return view('Passrate.edit')
            ->with('departments', $departments)
            ->with('passrate', $passrate);

    }

    public function postUpdate(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [ 
            'department' => 'required',
            'rate' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('passrate.update', ['id' => $id])
                    ->withErrors($validator)
                    ->withInput($request->all());
        }
        
        try {
            
            $passrate = Passrate::find($id);
            $passrate->update([
                    'rate' =>  $request->get('rate'),
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect()->route('passrate')->with('success', 'Passrate updated.');

        }
        catch (Exception $e) {

            return redirect()->route('passrate')->with('error', $e->getMessage());

        }

    }


}