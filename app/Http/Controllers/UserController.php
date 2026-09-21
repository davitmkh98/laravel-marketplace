<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //


public function show(User $user)
{
    $products = $user->products()
        ->latest()
        ->paginate(6);

    return view('users.show', compact('user', 'products'));
}


}
