<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Models\Admin;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;
    public function getLogin()
    {
      
        return view('admin.auth.login');
    }
    public function login(loginRequest $request)
    {
        $remember_me =$request->has('remember_me') ? true : false;
        if(auth()->guard('admin')->attempt(['email' =>$request->input('email'), 'password' => $request->input('password')])){
           return redirect()->route('admin.dashboard'); 
        }

        return redirect()->back()->with(['error'=> 'هناك خطأ فى البيانات ']);

       
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.maincategories.create');
    }

}
