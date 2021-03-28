<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPassword;
use App\Mail\VerificationEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|required_with:repeat_password|same:repeat_password',
            'repeat_password' => 'required',
            'mobile_number' => 'required|unique:users,mobile|min:11|max:11',
        ]);

        // if validator fails
        if ($validator->fails()) {
            $notification = array('message' => 'Something Wents Wrong. Please Check Again', 'alert-type' => 'success');
            return redirect()->back()->WithErrors($validator)->withInput()->with($notification);
        }

        $name = $request->input('full_name');
        $email = $request->input('email');
        $mobile = $request->input('mobile_number');
        $password = $request->input('password');

        User::insert([
            'full_name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'password' => Hash::make($password),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        session()->flash('message', 'Please Login');
        session()->flash('alert_tag', 'alert-danger');
        return redirect('login');
    }
}
