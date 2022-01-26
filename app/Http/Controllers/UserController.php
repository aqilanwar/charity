<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Join;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function AllUser(){
        if(Auth::user()->role_id == '2'){
            $users = User::latest()->paginate(10);
            return view('admin.user.user', compact ('users'));    
        }else{
            abort(403);
        }
    }

    public function EditRole(){
        $users = User::latest()->paginate(10);
        return view('admin.event.manageuser', compact ('users'));    
    }

    public function DeleteUser(Request $request , $id){
        $joins = Join::query()->where('user_id',$id)->get();
        $events = Event::query()->where('user_id',$id)->get();
      
        foreach($events as $event){
            $event_id = $event->id;
            Event::find($event_id)->forceDelete();
        }

        foreach($joins as $join){
            $join_id = $join->id;
            Join::find($join_id)->forceDelete();
        }
        User::find($id)->forceDelete();
        return Redirect()->back()->with('success' , 'User succesfully removed.'); 
    }

    public function ManageRole(Request $request){
        $update = User::find($request->user_id)->update([
            'role_id' => $request->role,
        ]);
        return Redirect()->back()->with('success' , 'User role updated successfully!');
    }   

    public function SearchUser(Request $request){
        $search = $request->search_user ;
        $users = User::where('name' , 'like', '%' . $search . '%')
                ->orWhere('matric_id' , 'like', '%' . $search . '%')
                ->orWhere('email' , 'like', '%' . $search . '%')
                ->get();

            return view('admin.user.search', compact ('users'));    
        }   

}
