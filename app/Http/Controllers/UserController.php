<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function AllUser(){
        $users = User::latest()->paginate(10);
        return view('admin.event.manageuser', compact ('users'));    
    }

    public function EditRole(){
        $users = User::latest()->paginate(10);
        return view('admin.event.manageuser', compact ('users'));    
    }

    public function DeleteUser(){
        $users = User::latest()->paginate(10);
        return view('admin.event.manageuser', compact ('users'));    
    }
}
