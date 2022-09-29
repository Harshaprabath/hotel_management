<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
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
        return Inertia::render('Dashboard/Partials/Rooms', ['rooms' => $data]);
        
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
        { {
                $request->validate([
                    'number' => ['required'],
                    'price' => ['required']
                ]);
                try {
                    DB::beginTransaction();

                    $room = new Room();
                    $room->number = $request->number;
                    $room->price = $request->price;
                    $room->isuse = false;
                    $room->isbook = false;
                    $room->save();

                    DB::commit();

                    return redirect()->route('rooms.index');
                } catch (Exception $ex) {
                    //dd($ex);
                    DB::rollback();
                    return abort(500);//redirect()->route('rooms.index');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $rm = Room::find($id);
        $data = Room::all();
        return Inertia::render('Dashboard/Partials/Rooms', ['rm' => $rm, 'rooms' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $room = Room::find($request->id);
            $room->number = $request->number;
            $room->price = $request->price;
            $room->save();

            DB::commit();

            return redirect()->route('rooms.index');
        } catch (Exception $ex) {
            dd($ex);
            DB::rollback();
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Room::destroy($id);
        return redirect()->route('rooms.index');
    }
}
