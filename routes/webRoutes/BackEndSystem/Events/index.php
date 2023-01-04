<?php

use App\Http\Requests\postEvent;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/Events/Create', function () {
    return Inertia::render('AppPages/Events/CreateEvent');
})->name('Events');

Route::post('/Events/Create', function (postEvent $request) {
    $data = [
        'title' => $request['name'],
        'description' => $request['description'],
        'event_start_date' => $request['start_date'],
        'event_end_date' => date('Y-m-d')
    ];

    (new \App\Http\Controllers\EventController())->store($data);

    return redirect()->route('Events');

})->name('postEvent');


Route::get('/Events', function () {
    $events = \App\Models\Event::all();

    $events = $events->transform(function($item,$index){
        $date =  \Carbon\Carbon::parse($item->created_at)->diffForHumans();
        $item->date_created = $date;
        return $item;
    });

    return Inertia::render('AppPages/Events/index',[
        'events' => $events
    ]);
})->name('Events');

Route::get('Event/Update/{id}',function ( \App\Models\Event $id){
    $event = $id;

    $invites = \App\Models\Invite::where('event_id', $event->id)->get();

    $invites= $invites->map(function ($item, $index){

        $user = \App\Models\User::where('id',$item->tenant_id)->first();
        $item->username = $user->username;
        $item->email = $user->email;

        $active_tenant = DB::table('active_tenants')->where('user_id',$user->id)->first();

        $house = $block = null;

        if($active_tenant){
            $house = \App\Models\House::where('id',$active_tenant->house_id)->first();
            $block = \App\Models\Block::where('id',$house->block_id)->first();
        }

        $item->house = $house;
        $item->block = $block;

        return $item;
    });

    return Inertia::render('AppPages/Events/UpdateEvent',[
        'event'=> $event,
        'invites' => $invites
    ]);

})->name('updateEvent');

Route::put('Event/Update/{id}',function (postEvent $request,\App\Models\Event $id){
    $event = $id;

    $data = [
        'title' => $request['name'],
        'description' => $request['description'],
        'event_start_date' => $request['start_date'],
        'event_end_date' => date('Y-m-d')
    ];

    (new \App\Http\Controllers\EventController())->update($data, $event);

    return \Illuminate\Support\Facades\Redirect::route('Events');

})->name('putEvent');

Route::post('Invite',function (\Illuminate\Http\Request $request){
    $invite = new \App\Models\Invite();

    $invite->tenant_id = $request['user_id'];
    $invite->agent_id = \Illuminate\Support\Facades\Auth::user()->id;
    $invite->event_id = $request['event_id'];
    $invite->status = "Pending";

    $invite->save();
})->name('addToEvent');
