<?php

namespace App\Http\Controllers;

use App\Events\TripAccepted;
use App\Events\TripCreated;
use App\Events\TripEnded;
use App\Events\TripLocationUpdated;
use App\Events\TripStart;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    function store(Request $request){

        $data = $request->validate([
            'origin'=>'required',
            'destination'=>'required',
            'destination_name'=>'required',
        ]);

        $trip = $request->user()->trips()->create($data);
        
        TripCreated::dispatch($trip,$request->user());

        return $trip;
    }

    function show(Request $request,Trip $trip){

        if($trip->user->id === $request->user()->id){
            return $trip;
        }

        if($trip->driver && $request->user()->driver){
            if($trip->driver->id === $request->user()->driver->id){
                return $trip;
            }
        }

        return response()->json(['message'=>'Can not find this trip'],404);
    }

    function accept(Request $request,Trip $trip){

        $request->validate([
            'driver_location'=>'required'
        ]);

        $trip->update([
            'driver_id'=>$request->user()->id,
            'driver_location'=> $request->driver_location
        ]);

        $trip->load('driver.user');

        TripAccepted::dispatch($trip,$request->user());

        return $trip;
       
    }

    function start(Request $request,Trip $trip){
       
        $trip->update([
            'is_started'=>true,
        ]);

        $trip->load('driver.user');

        TripStart::dispatch($trip,$request->user());


        return $trip;
       
    }

    function end(Request $request,Trip $trip){

        $trip->update([
            'is_completed'=>true,
        ]);

        $trip->load('driver.user');

        TripEnded::dispatch($trip,$request->user());


        return $trip;

    }

    function location(Request $request,Trip $trip){

        $request->validate([
            'driver_location'=>'required'
        ]);

        $trip->update([
            'driver_location' => $request->driver_location,
        ]);

        $trip->load('driver.user');

        TripLocationUpdated::dispatch($trip,$request->user());


        return $trip;
       
    }
        
    
}
