<?php

namespace App\Http\Controllers;

use App\VehicleCatagory;
use Illuminate\Http\Request;

class VehicleCatagoryController extends Controller
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
      return view('/vehicleCatagory/index', [
        'breadcrumbs' => $breadcrumbs,
        'vehicle_catagories' => VehicleCatagory::all(),
      ]);
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
      $this->validate($request, [
        'name' => 'required',
        'description' => 'required',
      ]);
      $request['VehicleCatagoryID']=uniqid('VC-');
      VehicleCatagory::create($request->all());
      return redirect()->back()->withSuccess("vehicle Catagory Successfully Registered")->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleCatagory  $vehicleCatagory
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleCatagory $vehicleCatagory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VehicleCatagory  $vehicleCatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleCatagory $vehicleCatagory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VehicleCatagory  $vehicleCatagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleCatagory $vehicleCatagory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VehicleCatagory  $vehicleCatagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleCatagory $vehicleCatagory)
    {
        //
    }
}
