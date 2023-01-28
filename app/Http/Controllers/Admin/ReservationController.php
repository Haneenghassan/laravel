<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\category;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::get();
        // dd($reservations );
        $tables= Table::with('reservations')->get();
        // dd( $tables);
        return view('admin.reservations.index',compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables=Table::get();
        $resturants=category::get();
        return view('admin.reservations.create',compact('tables'),compact('resturants')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input('user_id'));
        // dd($request->guest_number);
        $newreservation= New Reservation();
        $newreservation->first_name= $request->input('first_name');
        $newreservation->last_name= $request->input('last_name');
        $newreservation->email= $request->input('email');
        $newreservation->tel_number= $request->input('tel_number');
        $newreservation->res_date= $request->input('res_date');
        $newreservation->guest_number= $request->input('guest_number');
        $newreservation->table_id= $request->input('table_id');
        $newreservation->user_id = request()->user()->id;
        $newreservation->category_id= request()->category()->id;

        
        $newreservation->save();

        // $newresturant= New Category();
        // $newresturant->name= $request->input('name');
        // // $newresturant->id =$newreservation->category_id;
        // $newresturant->save();

        $newtable= New Table();
        $newtable->id =$newreservation->table_id;
        $newtable->name= $request->input('name');
        $newtable->save();
  
      





          

            return redirect('admin/reservations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Reservation::findorfail($id);
        // $tables=Table::findorfail($id);
        // $resturants=category::findorfail($id);
       return view('admin.reservations.edite',compact('reservation')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findorfail($id);
        $reservation->first_name =$request->first_name;
           $reservation->last_name =$request->last_name;
           $reservation->email =$request->email;
           $reservation->tel_number =$request->tel_number;
           $reservation->res_date=$request->res_date;
           $reservation->guest_number =$request->guest_number;
           $reservation->table_id =$request->table_id;
           $reservation->save();

        //    $tables = Table::findorfail($id);
        //    $tables->name =$request->name;

           return redirect('admin/reservations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reservation::findorfail($id)->delete();
        return redirect('admin/reservations');
    }
}
