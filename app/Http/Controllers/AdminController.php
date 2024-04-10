<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function managuser()
    {
        //
        $users=User::paginate(10);
        return view('admin.users',compact('users'));
    }

}
