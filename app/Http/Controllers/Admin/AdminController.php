<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use App\Mail\Websitemail;
use Str;

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
            return redirect()->route('admin_login')->with('error', 'Invalid Credentials');
        }
    }

    public function logout()  
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success', 'Logout Success');
    }

    public function forget_password()
    {
        return view('admin.forget-password');
    }
  
    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
        ]);

        $admin_data = Admin::where('email', $request->email)->first();

        if (!$admin_data) {
            return redirect()->back()->with('error', 'Email not found');
        }

        $token = hash('sha256', time());
        $admin_data->token = $token;
        $admin_data->update();

        $reset_link = url('admin/reset-password/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = "Click on the link to reset your password:<br><br>";
        $message .= "<a href='" . $reset_link . "'>Click here</a>";

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'Reset link sent to your email');
    }

    public function reset_password($token, $email)
    {
        $admin_data = Admin::where('email', $email)->where('token', $token)->first();

        if (!$admin_data) {
            return redirect()->route('admin_login')->with('error', 'Invalid reset link');
        }

        return view('admin.reset-password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $admin_data = Admin::where('email', $request->email)->where('token', $request->token)->first();

        if (!$admin_data) {
            return redirect()->route('admin_login')->with('error', 'Invalid reset attempt');
        }

        // Mise à jour du mot de passe
        $admin_data->password = Hash::make($request->password);
        $admin_data->token = null; // Réinitialisation du token après le changement de mot de passe
        $admin_data->update();

        return redirect()->route('admin_login')->with('success', 'Password reset successfully');
    }
}
