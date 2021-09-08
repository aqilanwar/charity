<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventPic;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    
    public function AllEvent(){
        $events = Event::latest()->paginate(10);
        return view('admin.event.index', compact ('events'));    
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
        $events = Event::query()->first();
        $eventpic = EventPic::where('event_id',$id)->paginate(3);
        return view('admin.event.edit' , compact('events' , 'eventpic')); 
    }
    
    public function Update(Request $request,$id){
        $update = Event::find($id)->update([
            'event_title' => $request->event_title,
            'event_description' => $request->event_description,
            'event_place' => $request->event_place,
            'event_date' => $request->event_date
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
        return Redirect()->back()->with('deletepic' , 'Picture deleted successfully!');
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
}
