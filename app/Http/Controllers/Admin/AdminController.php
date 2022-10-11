<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $admin;
    public function adminLogin()
    {
        return view('admin.login.login');
    }
    public function adminLoginRequest(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $this->admin = Admin::where('email',$request->email)->first();
        if(password_verify($request->password,$this->admin->password))
        {
            if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=> $request->password]))
            {
                return redirect('/dashboard');
            }
            else
            {
                return redirect()->back()->with('error_message','Credential doest not matched');
            }
        }
        else
        {
            return redirect()->back()->with('error_message','Password does not matched');
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin-login');
    }
}
