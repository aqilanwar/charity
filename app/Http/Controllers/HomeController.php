<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\EventPic;



class HomeController extends Controller
{
    public function index()
    {
        $role=Auth::user()->role_id;
        if($role=='1'){
            return view('organizer');
        }else if($role=='2'){
            $users = User::all();
            return view('admin',compact('users'));
        }else{
            return view('dashboard');
        }

    }

    public function Home(){
        $result = Event::query()->get()->paginate(10);
        return view('frontview.event.event-list', compact ('result'));   
    }

    public function ListEvent(){
        return view('frontview.event-list', compact ('events'));   
    }
}
