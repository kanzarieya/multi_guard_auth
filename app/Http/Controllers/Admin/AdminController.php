<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Mail\Websitemail;

class AdminController extends Controller
{
    public function dashboard() 
    {
        return view('admin.dashboard');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        // Validation des champs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin_dashboard')->with('success', 'Login Success');
        } else {
            return redirect()->route('admin_login')->with('error', 'Invalid Credentials'); // Correction ici
        }
    }

    public function logout()  
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success', 'Logout Success');
    }
}
