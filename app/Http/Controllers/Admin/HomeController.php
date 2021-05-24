<?php

namespace App\Http\Controllers\Admin;

use illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Adminhome()
    {
        return view('admin.home');
    }

    public function user() {
        return view("admin.users.user");
    }

    public function generatetoken() {
        $api_token = Str::random(80);
        $user = Auth::user();
        $user->api_token = $api_token;
        $user->save();
        return redirect()->route("user_page");

    }
}
