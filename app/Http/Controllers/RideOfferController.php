<?php

namespace App\Http\Controllers;

use App\RideOffer;
use Illuminate\Http\Request;

class RideOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $breadcrumbs = [
        ['link' => "dashboard-analytics", 'name' => "Home"], ['link' => "dashboard-analytics", 'name' => "Pages"], ['name' => "User List"],
      ];
      return view('/ride/RideOffers/index', [
        'breadcrumbs' => $breadcrumbs,
        'rideOffers' => RideOffer::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RideOffer  $rideOffer
     * @return \Illuminate\Http\Response
     */
    public function show(RideOffer $rideOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RideOffer  $rideOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(RideOffer $rideOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RideOffer  $rideOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RideOffer $rideOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RideOffer  $rideOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $rideOffer=RideOffer::find($id);
      if($rideOffer){
        $rideOffer->delete();
        return redirect()->back()->withSuccess('Ride Offer deleted Successfully');
      }

    }
}
