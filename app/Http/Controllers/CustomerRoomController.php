<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerRoom;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CustomerRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { //
        $data = Room::all();
        $availablerooms = DB::table('rooms')
        ->where(['rooms.isbook'=>false,'rooms.isuse'=>false])
        ->select('rooms.*')  
        ->get();

        $usingrooms = DB::table('customer_rooms')
        ->join('rooms','customer_rooms.roomId','=','rooms.id')
        ->join('customers','customer_rooms.customerId','=','customers.id')
        ->where('rooms.isuse',true)
        ->select('rooms.*','customer_rooms.created_at as createddate','customers.name as customer') 
        ->get();

        return Inertia::render('Dashboard/Partials/AssignRooms', ['usingrooms' => $usingrooms,'availablerooms' => $availablerooms]);
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

            $customerRoom = new CustomerRoom();
            $customer = new Customer();

            $customer->name =$request->name;
            $customer->noOfMembers =$request->noOfMembers;
            $customer->mobile =$request->mobile;
            $customer->nic =$request->nic;
            $customer->isuse =true;
            $customer->save();

            $room = Room::find($request->roomid);
            $room->isuse = true;
            $room->save();

            $customerRoom->customerId= $customer->id;
            $customerRoom->roomId = $request->roomid;
            $customerRoom->save();

            DB::commit();

            return redirect()->route('assingroom.index');
            
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
     * @param  \App\Models\CustomerRoom  $customerRoom
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerRoom $customerRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerRoom  $customerRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerRoom $customerRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerRoom  $customerRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerRoom $customerRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerRoom  $customerRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        
        try {
            DB::beginTransaction();

            $room = Room::find($id);
            $room->isuse = false;
            $room->save();

            
            $customerRoom = DB::table('customer_rooms')
            ->where('customer_rooms.roomId',$id)
            ->select('customer_rooms.*') 
            ->distinct() 
            ->get();

            Customer::destroy($customerRoom[0]->customerId);
           

            CustomerRoom::destroy($customerRoom[0]->id);

            DB::commit();

            return redirect()->route('assingroom.index');

            
        } catch (Exception $ex) {
            //dd($ex);
            DB::rollback();
            return abort(500);//redirect()->route('rooms.index');
        }
    }
}
