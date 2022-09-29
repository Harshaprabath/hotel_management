<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\CustomerRoom;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Room::all();
        $availablerooms = DB::table('rooms')
        ->where(['rooms.isbook'=>false,'rooms.isuse'=>false])
        ->select('rooms.*')  
        ->get();

        $bookedrooms = DB::table('bookings')
        ->join('rooms','bookings.roomId','=','rooms.id')
        ->join('customers','bookings.customerId','=','customers.id')
        ->where('rooms.isbook',true)
        ->select('rooms.*','bookings.created_at as createddate','customers.name as customer') 
        ->get();

        return Inertia::render('Dashboard/Partials/Booking', ['bookedrooms' => $bookedrooms,'availablerooms' => $availablerooms]);
        //customers
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            DB::beginTransaction();

            $booking = new Booking();
            $customer = new Customer();

            $customer->name =$request->name;
            $customer->noOfMembers =$request->noOfMembers;
            $customer->mobile =$request->mobile;
            $customer->nic =$request->nic;
            $customer->isuse =false;
            $customer->save();

            $room = Room::find($request->roomid);
            $room->isbook = true;
            $room->save();

            $booking->customerId= $customer->id;
            $booking->roomId = $request->roomid;
            $booking->save();

            DB::commit();

            return redirect()->route('booking.index');
            
        } catch (Exception $ex) {
            //dd($ex);
            DB::rollback();
            return abort(500);//redirect()->route('rooms.index');
        }
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        
        try {
            DB::beginTransaction();

            $room = Room::find($id);
            $room->isbook = false;
            $room->save();

            
            $booking = DB::table('bookings')
            ->where('bookings.roomId',$id)
            ->select('bookings.*') 
            ->distinct() 
            ->get();

            Customer::destroy($booking[0]->customerId);
           

            Booking::destroy($booking[0]->id);

            DB::commit();

            return redirect()->route('booking.index');

            
        } catch (Exception $ex) {
            //dd($ex);
            DB::rollback();
            return abort(500);//redirect()->route('rooms.index');
        }
    }

    public function moveToUse($id)
    {
        //
             
        try {
            DB::beginTransaction();

            $room = Room::find($id);
            $room->isbook = false;
            $room->isuse = true;
            $room->save();

            
            $booking = DB::table('bookings')
            ->where('bookings.roomId',$id)
            ->select('bookings.*') 
            ->distinct() 
            ->get();

            $customer = Customer::find($booking[0]->customerId);
            $customer->isuse = false;
            $customer->save;

            $custermer_room =new CustomerRoom();
            $custermer_room->customerId= $customer->id;
            $custermer_room->roomId = $room->id;
            $custermer_room->save();

            Booking::destroy($booking[0]->id);

            DB::commit();

            return redirect()->route('booking.index');

            
        } catch (Exception $ex) {
            //dd($ex);
            DB::rollback();
            return abort(500);//redirect()->route('rooms.index');
        }
    }
}
