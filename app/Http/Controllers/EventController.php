<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventPic;
use App\Models\Join;
use App\Models\Donation;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    
    public function AllEvent(){

        if(auth()->user()->role_id == 2){
            $events = Event::latest()->paginate(20);
            return view('admin.user.event', compact ('events'));    
        }
        elseif(auth()->user()->role_id == 1){
            $events = Event::where('user_id',auth()->user()->id)->paginate(20);
            return view('admin.user.event', compact ('events'));   
        }else{
            abort(403);
        }

    }

    public function AddEvent(Request $request){
        $validatedData = $request->validate([
            'event_title' => 'required',
            'event_description' => 'required',
            'event_date' => 'required',
            'event_place' => 'required',
            'event_picture.*' => 'required|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'event_title.required' => 'Please enter event title',
            'event_description.required' => 'Please enter event description',
            'event_date.required' => 'Please enter event date',
            'event_place.required' => 'Please enter event place',
            'event_picture.*' => 'Only JPEG, PNG are allowed.'

        ]);

        Event::insert([
            'event_title' => $request->event_title,
            'event_description' => $request->event_description,
            'event_place' => $request->event_place,
            'event_date' => $request->event_date,
            'event_max' => $request->event_max,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        
        $image = $request->file('event_picture');
        $id = Event::query()->orderByDesc('id')->first();
        $dir_location = 'image/event/';

 
        if($request->hasfile('event_picture')) {
            foreach($image as $img){
    
                $rename_image = hexdec(uniqid());
                $img_ext = $img->extension();     
                $img_name = $rename_image.'.'.$img_ext;
                $db_img = $dir_location.$img_name;
                $img -> move($dir_location,$img_name);
    
                EventPic::insert([
                    'event_id' => $id['id'],
                    'photo_path' => $db_img,
                    'created_at' => Carbon::now(),
                ]);
            }    
        }
        
        return Redirect()->back()->with('success' , 'Event created successfully!');
    }

   
    public function Edit($id){
        $events = Event::find($id);
        $eventpic = EventPic::where('event_id',$id)->paginate(3);
       
        $joined = Join::join('users', 'join.user_id', '=', 'users.id')
        ->where('join.event_id', $id)
        ->get(['users.name' , 'users.matric_id' , 'users.email' ,'users.profile_photo_path', 'join.created_at',  'join.id AS join_id']);

        // echo json_encode($joined);
        // SELECT `join`.id , `users`.name ,`users`.id
        // FROM `join` 
        // INNER JOIN `users` ON `join`.user_id = `users`.id 
        // WHERE `join`.event_id = '1' 
        return view('admin.user.event-manage' , compact('events' , 'eventpic' , 'joined')); 
    }
    
    public function Update(Request $request,$id){
        $update = Event::find($id)->update([
            'event_title' => $request->event_title,
            'event_description' => $request->event_description,
            'event_place' => $request->event_place,
            'event_date' => $request->event_date,
            'event_max' => $request->event_max
        ]);
        return Redirect()->back()->with('success' , 'Event updated successfully!');
    }

    public function Delete(Request $request,$id){
        $image = EventPic::query()->where("event_id",$id)->get();
        foreach($image as $img){
            $picid = $img->id ;
            unlink($img->photo_path);
            EventPic::find($picid)->forceDelete();
        }
        $delete = Event::find($id)->forceDelete();

        return Redirect()->route('all.event')->with('success' , 'Event deleted successfully!');
    }

 
    public function DeletePic(Request $request,$id){
        $image = EventPic::query()->where('id',$id)->get();
        foreach($image as $img){
            unlink($img->photo_path);
            EventPic::find($id)->forceDelete();
        }
        return Redirect()->back()->with('successpic' , 'Picture deleted successfully!');
    }

    public function JoinEvent(Request $request){
        $validatedData = $request->validate([
            'event_id' => 'required',
        ],
        [
            'event_id.required' => 'Please select event',
        ]);

        Join::insert([
            'event_id' => $request->event_id,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
                
        return Redirect()->back()->with('success' , 'You have successfully register as participant!');
    }

    public function JoinCancel(Request $request){
        $validatedData = $request->validate([
            'event_id' => 'required',
        ],
        [
            'event_id.required' => 'Please select event',
        ]);

        $delete = Join::where('event_id' , $request->event_id)->where('user_id', Auth::user()->id)->forceDelete();

        return Redirect()->back()->with('success' , 'You have successfully cancel your participation!');
    }
    
    
    public function AddPic(Request $request){
        $validatedData = $request->validate([
            'event_picture.*' => 'required|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'event_picture.*' => 'Only JPEG, PNG are allowed.'
        ]);

        $image = $request->file('event_picture');
        $dir_location = 'image/event/';


        if($request->hasfile('event_picture')) {
            foreach($image as $img){
    
                $rename_image = hexdec(uniqid());
                $img_ext = $img->extension();     
                $img_name = $rename_image.'.'.$img_ext;
                $db_img = $dir_location.$img_name;
                $img -> move($dir_location,$img_name);
    
                EventPic::insert([
                    'event_id' =>  $request->event_id,
                    'photo_path' => $db_img,
                    'created_at' => Carbon::now(),
                ]);
            }    
        }
        return Redirect()->back()->with('successpic' , 'Picture uploaded successfully!');
    }  

    public function EventJoined(){
        if(Auth::user()->role_id == 2){
            $launched = Event::whereDate('event_date', '<' , Carbon::today())->count();
            $upcoming = Event::whereDate('event_date', '>' , Carbon::today())->count();
            $totaluser = User::count();
            $totaldonation = Donation::sum('amount');
            $donator = Donation::latest()->paginate(20);
            return view('admin.user.dashboard' , compact('launched' , 'upcoming' , 'totaldonation' , 'donator' ,'totaluser' ));
        }else{
            $joined = Join::join('events', 'join.event_id', '=', 'events.id')
            ->where('join.user_id', Auth::user()->id)
            ->get(['events.*']);

        // SELECT `join`.id , `events`.event_title
        // FROM `join` 
        // INNER JOIN `events` ON `join`.event_id = `events`.id 
        // WHERE `join`.user_id = '1' 
        // echo json_encode($joined);
        return view('admin.user.dashboard', compact ('joined'));  
        }
 
    }

    public function KickUser(Request $request,$id){
        $kick = Join::find($id)->forceDelete();
        return Redirect()->back()->with('remove' , 'User successfully kicked from event.');

    }

    public function SearchEvent(Request $request){
        $search = $request->search_event ;
        
            if(Auth::user()->role_id == '0'){
                $events = Event::where('event_title' , 'like', '%' . $search . '%')->get();
            }else{
                $events = Event::where('event_title' , 'like', '%' . $search . '%')
                ->where('user_id' , Auth::user()->id )->get();
            }
            return view('admin.user.searchevent', compact ('events'));    
        }   
}
