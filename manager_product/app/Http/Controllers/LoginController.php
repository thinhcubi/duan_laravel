<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin(){
        return view('admin/login');
    }
    public function login(Request $request){
        // Lấy thông tin đang nhập từ request gửi lên từ trình duyệt
        $username = $request->inputUsername;
        $password = $request->inputPassword;
        $admins = Admin::all();
        foreach ($admins as $value){
           if ($username == $value->name && $password == $value->password){
               $request->session()->push('login',true);
               return redirect()->route('admin.home');
           }
           $message = 'Đăng nhập không thành công. Tên người dùng hoặc mật khẩu không đúng.';
           $request->session()->flash('login-fail',$message);
           return view('admin.login');
        }
    }
}
