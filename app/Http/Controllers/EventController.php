<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests\StoreEventRequest;

use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeList = Event::getEventTypes();
        return view("events.create", compact('typeList'));
    }

    /**
     * Store a newly created resource in storage. StoreEventRequest
     */
    public function store(StoreEventRequest $request)
    {

        $data = $request->validated();

        $user = Auth::user();

        if($data['img']) $data['img'] = "placeholder.jpg";

        $event = Event::create($data);

        $user->events()->attach($event->id);

        if ($request->hasFile('img')) {
            $img = $request->file('img');

            $imgName = $event->id . "." . $img->getClientOriginalExtension();

            $directoryPath = "events/{$event->id}_{$event->title}"; 

            if($img->storeAs($directoryPath, $imgName, 'local')){
                $event->update(['img' => $imgName]);  
            }
        }

        return response()->json(['message' => 'Evento creato con successo!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
