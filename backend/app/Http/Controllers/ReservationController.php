<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Response;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index() {
        $list_reservations = Reservation::all();
        return $list_reservations;
    }

    public function store(Request $request) {
        $start_time = Carbon::parse($request->checkin);
        $end_time = Carbon::parse($request->checkout);
        $interval = $end_time->diffForHumans($start_time);
        $includeDaysAfter = str_contains($interval, 'days after');
        $includeString = str_split($interval);
        $find_reservation = Reservation::where('book_name', '=', $request->book_name)->first();
        $find_user = Reservation::where('user_name', '=', $request->user_name)->get();
        if(count($find_user) < 2){
            if(((int)$includeString) <= 5 && $includeDaysAfter) {
                if($find_reservation) {
                    if($request->checkin > $find_reservation->checkout || $request->checkout < $find_reservation->checkin) {
                        Reservation::create($request->all());
                        return Response::json($request->all(), 200);
                    } else {
                        return Response::json('This reserve cant overwrride',  400);
                    }
                } else {
                    Reservation::create($request->all());
                    return Response::json($request->all(), 200);
                }
                
            } else {
                return Response::json("You CheckOut not in date limit", 400 );
            };
        } else {
            return Response::json("You cant more reserve ", 400);
        };
    }

    
}
