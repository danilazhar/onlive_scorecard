<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Exception;
use Carbon\Carbon;

class RoleController extends Controller
{

    public function index(Request $request)
    {   
        if(!Auth::check()){
            return redirect("/login")->withErrors('You are not allowed to access');
        }

        $roles = Role::orderBy('id', 'desc')->get();     
        return view('Role.index')
            ->with('roles', $roles);
    }

    public function create()
    {

        return view('Role.create');

    }

    public function postCreate(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('role')
                    ->withErrors($validator)
                    ->withInput($request->all());
        }

        try {
            Role::insert([
                'name' =>  $request->get('name'),
                'description' =>  $request->get('description'),
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('role')->with('success', 'Role created.');
        } 
        catch (Exception $e) {
            return redirect()->route('role')->with('error', $e->getMessage());
        }

    }

    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $role = Role::firstWhere('id', $id);

        if($role == null) {
            return redirect()->route('role')->with('error', 'Role not found');
        }
        return view('Role.edit')
            ->with('role', $role);

    }

    public function postUpdate(Request $request, int $id)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('role')
                    ->withErrors($validator)
                    ->withInput($request->all());
        }
        
        try {
            
            $role = Role::find($id);
            $role->update([
                    'name' =>  $request->get('name'),
                    'description' =>  $request->get('description'),
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect()->route('role')->with('success', 'Role updated.');

        }
        catch (Exception $e) {

            return redirect()->route('role')->with('error', $e->getMessage());

        }

    }

}