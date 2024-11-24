<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
 public function getUsers() {
    $users = User::all();

    if(count($users) !== 0) {
        return response()->json([
            'code' => 200, 
            'data' => $users
        ], 200);
    }

    return response()->json([
        'code' => 200,
        'message' => 'There are no users in the system yet'
    ], 200);
 }   
}
