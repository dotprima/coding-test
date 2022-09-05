<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Login;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  /**
   * Retrieve the user for the given ID.
   *
   * @param  int  $id
   * @return Response
   */


  public function Register(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'username' => 'required|unique:user|',
      'f_name' => 'required|min:5',
      'l_name' => 'required|min:5',
      'email' => 'required|unique:user|email|',
      'password' => 'required|min:5',
    ]);


    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()]);
    }

    if ($validator->passes()) {

      $status = User::create([
        'username' => $request->username,
        'f_name' => $request->f_name,
        'l_name' => $request->l_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
      ]);

      $statuss = Login::create([
        'id_user' => $status->id,
      ]);

      if ($status) {
        return response()->json([
          'Status' => "Data Saved",
          'Data' => $status
        ], 201);
      } else {
        return response()->json([
          'Status' => "Data Not Saved",
          'Code' => 501
        ]);
      }
    }
  }

  public function Login(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'username' => 'required|min:5',
      'password' => 'required|min:5',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()]);
    }

    if ($validator->passes()) {
      $username = $request->username;
      $password = $request->password;
      $status = User::where('username', $username)->first();


      if ($status) {
        if (Hash::check($password, $status->password)) {
          $token = base64_encode(Str::random(40));
          $login = Login::find($status->id);
          $login->token = $token;

          $login->save();

          return response()->json([
            'Status' => "login Berhasil",
            'Token' => $token,
            'Data' => $status
          ], 201);
        } else {
          return response()->json([
            'Status' => "Wrong Password",
            'Code' => 201
          ]);
        }
      } else {
        return response()->json([
          'Status' => "Data Not Found",
          'Code' => 501
        ]);
      }
    }
  }

  public function Logout(Request $request)
  {
    $token = $request->header('Token');
    if (isset($token)) {
      $login = Login::where('token', $token)->first();
      if ($login) {
        $login->token = Null;
        $login->save();
        return response("Logout Successful", 201);
      } else {
        return response("Token Unauthorized", 401);
      }
    } else {
      return response("Unauthorized", 401);
    }
  }
}
