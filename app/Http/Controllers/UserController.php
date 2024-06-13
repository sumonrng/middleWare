<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        return view('register');
    }
    public function update(int $id)
    {
        Gate::authorize('update-user',$id);
        // if(Gate::allows('update-user',$id)){
        //     $user = User::findOrFail($id);
        // }else{
        //     abort(403);
        // }
        $user = User::findOrFail($id);
        return $user;
    }
    public function store(UserRequest $request)
    {
        
        $users = User::updateOrCreate(
            ['email'=>$request->email],
            [
            'name' => $request->f_name,
            'email' => $request->email,
            'age' => $request->age,
            'role' => $request->role,
            'password'=>$request->password
        ]);
        if($users){
            return redirect()->route('index')->with('status','Successfully Registered.');
        }else{
            return redirect()->route('index')->with('status','Successfully Not Registered.');
        }
    }
    public function login(Request $request)
    {
        //if(Auth::check()){
            //return redirect()->route('dashboard');
        //}else{
            return view('login');
        //}

    }
    public function loginCheck(Request $request)
    {
        // dd($request->all());
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::attempt($credential)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->with('status','Login Unsuccessfully.');
      }

    }
    public function dashboardPage()
    {
        Gate::authorize('isAdmin');
        return view('dashboard');
        // if(Gate::allows('isAdmin')){
        //     return view('dashboard');
        // }else{
        //     return "Access Denied";
        // }
        
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('logout');
    }
}
