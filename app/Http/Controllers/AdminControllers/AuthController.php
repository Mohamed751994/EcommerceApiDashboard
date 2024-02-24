<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Traits\HelperTrait;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HelperTrait;

    //login page
    public function login_page()
    {
        if(Auth::check())
        {
            return redirect()->route('admin.dashboard');
        }
        return view('admin_dashboard.login');
    }

    //login
    public function login(AdminLoginRequest $request)
    {
        $data = $request->validated();
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
            'type' => function ($query) {
                $query->where('type', 1);
            }
        ];
        if (Auth::attempt($credentials)) {
            toastr()->success('تم تسجيل الدخول بنجاح', 'حسناً', ['timeOut' => 8000]);
            return redirect()->route('admin.dashboard');
        }
        toastr()->error('البريد الإلكتروني أو كلمة المرور خاطئة', 'خطأ', ['timeOut' => 8000]);
        return redirect()->back();

    }



}


