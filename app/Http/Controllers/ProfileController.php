<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile($username)
    {
    	$user = User::whereUsername($username)->first();

    	//dd($user);  //"Dump and Die"
    	
    	return view('user/profile', compact('user'));
    }
}
