<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::latest()->get();

    	return view('users.index',[
    		'users' => $users
    	]);
    }
   	public function store(Request $request)
    {
        dd($request);
    	$request -> validate([
    		'name' => 'required',
    		'email' => ['required', 'email', 'unique:users'],
    		'password'=>['required','min:8'],

    	]);
    	User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password), //bcrypt funciona para encriptar lo que se agrega en este campo
    	]);
    	return back();
    }
    public function destroy(User $user)
    {
    	$user->delete();
    	return back();
    	//dd($user);
    }
}
