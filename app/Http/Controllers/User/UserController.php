<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use Exception;
use Carbon\Carbon;

class UserController extends Controller
{

    public function index(Request $request)
    {   

        if(!Auth::check()){

            return redirect("/login")->with('error', 'You are not allowed to access.');
        
        }

        $users = User::where('status', '!=', '2')->orderBy('id', 'desc')->get();
         
        return view('User.index')
            ->with('users', $users); 

    }

    public function create()
    {
        $departments = Department::where('status', true)->get();     
        $roles = Role::where('status', true)->get();     

        return view('User.create')
            ->with('departments', $departments)
            ->with('roles', $roles);

    }

    public function postCreate(Request $request)
    {

        $validator = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'department' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('user')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $email = $request->get('email');
        $name = $request->get('name');

        $checkUserExist = User::where('status', true)
                ->where(function($query) use ($email, $name) {
                    return $query
                    ->where('email', $email)
                    ->orwhere('name', $name);
                   })
                ->get();

        if(count($checkUserExist) > 0) {
            return redirect()->route('user')->with('error', 'User already exists!');
        }

        try {
            User::insert([
                'name' =>  $request->get('name'),
                'email' =>  $request->get('email'),
                'role_id' => $request->get('role'),
                'department_id' => $request->get('department'),
                'password' => Hash::make('Qwerty!234'),
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('user')->with('success', 'User created.');
        } catch (Exception $e) {
            return redirect()->route('user')->with('error', $e->getMessage());
        }

    }
    
    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $roles = Role::where('status', true)->get();  
        $departments = Department::where('status', true)->get();  
        $user = User::firstWhere('id', $id);

        if($user == null) {
            return redirect()->route('user')->with('error', 'User not found');
        }
        return view('User.edit')
            ->with('roles', $roles)
            ->with('departments', $departments)
            ->with('user', $user);

    }

    public function postUpdate(Request $request, int $id)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if($validator->fails()) {
            return redirect()->route('user')
                    ->withErrors($validator)
                    ->withInput($request->all());
        }
        
        try {
            
            $user = User::find($id);
            $user->update([
                    'name' =>  $request->get('name'),
                    'email' =>  $request->get('email'),
                    'role_id' => $request->get('role'),
                    'department_id' => $request->get('department'),
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect()->route('user')->with('success', 'User updated.');

        }
        catch (Exception $e) {

            return redirect()->route('user')->with('error', $e->getMessage());

        }

    }

    public function verify(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'new_password' => 'required',
            'repeat_password' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('user.verify')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        if($request->get('new_password') !== $request->get('repeat_password')){
            return redirect()->route('user.verify')->with('error', 'Please re-enter the same password.');
        }

        try {
            $user = User::find(request()->session()->get('user_id'));
            $user->update([
                    'password' => Hash::make($request->get('new_password')),
                    'is_verified' => 1,
                    'status' => 1,
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect("/login")->with('success', 'You are verified.');
        }
        catch (Exception $e) {
            return redirect()->route('user.verify')->with('error', 'Failed to verify User.');
        }

    }

}