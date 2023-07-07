<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {        
        return view('Auth.login');
    }

    public function postLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = User::firstWhere('email', $request->get('email'));

            try {

                $request->session()->put([
                    'user_id'=> $user->id,
                    'user_name'=> $user->name,
                    'role_id'=> $user->role_id,
                    'role_name'=> $user->role->name,
                    'department_id'=> $user->department_id,
                    'is_verified'=> $user->is_verified,
                ]);

            }
            catch (Exception $e) {
                return response()->json(['status' => 0, 'message' => 'Failed to log user']);
            }

            if(!$user->is_verified){
                return view('User.verify');
            }

            return redirect()->intended(route('dashboard'));

        }

        return redirect("/login")->with('error', 'Login details are not valid');

    }

    public function logout() {

        Session::flush();
        Auth::logout();
        return Redirect('/login');
        
    }
}