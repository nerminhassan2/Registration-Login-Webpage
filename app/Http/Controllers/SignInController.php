<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignInController extends Controller
{
    public function signIn(Request $request)
    {
        $output = "";
        $username = $request['un'];
        $query = User::select("*")->where("user_name", $username)->get();

        if ($query->isEmpty())
            $output = "*Username does not exist!";
        else {
            $pass = $request['pass'];
            $password = $query[0]->password;
            if ($pass == $password) {
                $request->session()->put('img', $username . '.png');
                $request->session()->put('username', $username);
                $request->session()->put('email', $query[0]->email);
                $output = "success";
            } else $output = "*Password is incorrect!";
        }
        return response()->json(['output' => $output], 200);
    }
}
