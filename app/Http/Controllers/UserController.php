<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  /**
   * Retrieve the user for the given ID.
   *
   * @param  int  $id
   * @return Response
   */

    public function __construct()
    {
      $this->middleware('CheckUserLogin');
    }


    public function index(Request $request)
    {
      $user = User::find($request['user_id']);
      return response()->json([
        'Token' => $request['token'],
        'Data' => $user
      ]);
    }

    public function store(Request $request)
    {
      $user = User::find($request['user_id']);
      $validator = Validator::make($request->all(), [
        'username' => 'required|unique:user,username',$user->username,
        'f_name' => 'required|min:5',
        'l_name' => 'required|min:5',
        'email' => 'required|email|unique:user',$user->email,
        'password' => 'required|min:5',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()]);
      }

      $user->username = $request->username;
      $user->f_name = $request->f_name;
      $user->l_name = $request->_name ;
      $user->email = $request->email;
      $user->password = $request->password;

      return response()->json([
        'Status' => "Data Edit Successfull",
        'Token' => $request['token'],
        'Data' => $user
      ]);
    }
 
  
}
