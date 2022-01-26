<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\EventPic;
use App\Models\Donation;
use Illuminate\Support\Facades\DB;
use App\Models\Join;
use Illuminate\Support\Carbon;



class HomeController extends Controller
{
    public function Home(){
        $result = Event::latest()->limit(4)->get();
        return view('frontview.home' , compact('result'));   
    }

    public function Donation(){
        return view('frontview.donation');   
    }

    public function ListEvent(){
        // $result = Event::latest()->paginate(5);

        $result = DB::select("SELECT a.id, a.created_at, a.event_max, a.event_place,a.event_title,a.event_date,
        (SELECT i.photo_path
         FROM event_pics i 
         WHERE i.event_id = a.id 
         LIMIT 1
        ) as image ,
        (SELECT u.name 
         FROM users u
         WHERE a.user_id = u.id
           ) as name ,
        (SELECT u.profile_photo_path 
         FROM users u
         WHERE a.user_id = u.id
           ) as profile_pic
        FROM events a
        ORDER BY a.created_at DESC
 
        ");

        // echo(json_encode($result));
        return view('frontview.event.event-list', compact ('result'));   
    }

    public function ViewEvent($id){
        $events = Event::find($id);
        $join = Join::where('event_id' , $id)->count();
        if (Auth::check()) {
            $user = Join::where('user_id' , Auth::user()->id)->where('event_id' ,$id)->first();
            $organizer = Event::where('user_id' , Auth::user()->id)->where('id' ,$id)->first();
            return view('frontview.event.event-view', compact ('events','join','user','organizer'));   
        }else{
            return view('frontview.event.event-view', compact ('events','join'));   
        }
    }

    public function Logout(){
        Auth::logout();
        return redirect('/login')->with('success' , 'You have successfully logged out.'); 
    }

    public function SearchEventFront(Request $request){
        $search = $request->search_event ;

        $result = DB::select("SELECT a.id, a.created_at, a.event_max, a.event_place,a.event_title,a.event_date,
        (SELECT i.photo_path
         FROM event_pics i 
         WHERE i.event_id = a.id 
         LIMIT 1
        ) as image ,
        (SELECT u.name 
         FROM users u
         WHERE a.user_id = u.id
           ) as name ,
        (SELECT u.profile_photo_path 
         FROM users u
         WHERE a.user_id = u.id
           ) as profile_pic
        FROM events a 
        WHERE a.event_title LIKE '%$search%'
        ORDER BY a.created_at DESC
 
        ");

        return view('frontview.event.event-search', compact ('result'));   

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

    public function SubmitDonation(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'amount' => 'required',
        ]);

        Donation::insert([
            'name' => $request->name,
            'email' => $request->email,
            'amount' => $request->amount,
            'created_at' => Carbon::now(),
        ]);
        
        return Redirect()->back()->with('success' , 'Thank you for your donation ! Your card has successfully charged.');
    }
}
