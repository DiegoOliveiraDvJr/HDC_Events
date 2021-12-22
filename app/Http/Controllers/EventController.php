<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
   
    
    public function index(Request $request) 
    {
        $search = $request->search;
        if($search){

            $events = Event::where([
                ['title', 'like', '%'.$search]
            ])->get();



        }else{
            $events = Event::all();
        }

        return view('events', ['events' => $events, 'search' => $search]);
        
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request) 
    {
        $event = new Event();

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        

        // Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;

        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        /** @var User */
        $user = auth()->user();
        $event = Event::findOrFail($id);

        $hasUserJoined = false;

        if($user){

            $userEvents = $user->eventsAsParticipant;

            foreach($userEvents as $userEvent){

                if($userEvent->id == $id){
                    $hasUserJoined = true;
                    break;
                }
            }
        }

        $eventUser = User::where('id', $event->user_id)->first();

        return view('events.show', ['event' => $event, 'eventUser' => $eventUser, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard()
    {
        /** @var User */
        $user = auth()->user();
        $events = $user->events;

        $eventsParticipant= $user->eventsAsParticipant;
        return view('events.dashboard', ['events' => $events, 'eventsAsParticipant' => $eventsParticipant]);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);

        if($user->id != $event->user_id){
            return redirect(route('dashboard'));
        }
        $event->delete();

        return redirect(route('dashboard'))->with('msg', 'Evento excluído com sucesso!');
    }

    public function edit($id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);

        if($user->id != $event->user_id){
            return redirect(route('dashboard'));
        }
        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request)
    {   
        $data = $request->all();
        $event = Event::findOrFail($request->id);
        // Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            unlink("img/events/{$event->image}");
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;

        }
        
        $event->update($data);

        return redirect(route('dashboard'))->with('msg', 'Evento atualizado com sucesso!');
    }

    public function joinEvent($id)
    {
         /** @var User */
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);

        return redirect(route('dashboard'))->with('msg', 'Presença confirmada no evento: '.(Event::findOrFail($id))->title);
    }

    public function leaveEvent($id)
    {
        /** @var User */
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);

        return redirect(route('dashboard'))->with('msg', 'Você saiu do evento: '.(Event::findOrFail($id))->title);
    }
    
}
