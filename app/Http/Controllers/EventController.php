<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // only for test
        $image = $request->file('file');
        
        // \Log::debug(json_encode(Auth::user()->events()->first(),JSON_PRETTY_PRINT));
        $event = Auth::user()->events()->select("events.id","title")->first();
        
        $directoryPath = "events/" . $event->id . "_" . $event->title; 
        
        
        $imageName = $image->getClientOriginalName();
        $path = $image->storeAs($directoryPath, $imageName, 'local');

        \Log::debug($path);

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
