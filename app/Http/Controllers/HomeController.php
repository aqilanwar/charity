<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\EventPic;
use Illuminate\Support\Carbon;



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
        return view('frontview.home');   
    }

    public function ListEvent(){
        $result = Event::latest()->paginate(2);
        return view('frontview.event.event-list', compact ('result'));   
    }

    public function ViewEvent($id){
        $events = Event::find($id);
        return view('frontview.event.event-view', compact ('events'));   
    }
}
