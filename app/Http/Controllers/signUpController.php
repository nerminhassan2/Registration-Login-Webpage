<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\saveImageController;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class signUpController extends Controller
{
    function register(Request $request)
    {
        $output = "";
        $fullName = $request["Full_Name"];
        $username = $request["User_Name"];
        $phoneNum = $request["phoneNum"];
        $BDate = date('Y-m-d', strtotime($request["BDate"]));
        $address = $request["address"];
        $password = $request["pass"];
        $email = $request["e-mail"];
        $model = new User;
        $query = User::select("*")->where("user_name", $username)->get();
        if ($query->isEmpty()) {
            $model->user_name = $username;
            $model->full_name = $fullName;
            $model->birthdate = $BDate;
            $model->phone = $phoneNum;
            $model->address = $address;
            $model->password = $password;
            $model->user_image = $username;
            $model->email = $email;
            $model->save();
            $tempName = $request->file('image');
            $uploadImage = new saveImageController;
            $uploadImage->saveImage($username, $tempName);
            //Mail::to($email)->send(new WelcomeMail($username));
            Mail::to($email)->send(new WelcomeMail($username));
        } else {
            $output = "User name already exist";
        }
        return response()->json(['output' => $output], 200);
    }
    function getData()
    {
        return User::all();
    }
}
