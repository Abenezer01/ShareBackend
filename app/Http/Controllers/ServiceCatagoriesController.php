<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceCatagory;
use App\Images;
use Image;
class ServiceCatagoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $breadcrumbs = [
        ['link' => "dashboard-analytics", 'name' => "Home"], ['link' => "dashboard-analytics", 'name' => "Pages"], ['name' => "Service Catagory List"],
      ];
      return view('Menu/ServiceCatagories/index', [
        'breadcrumbs' => $breadcrumbs,
        'serviceCatagories' => ServiceCatagory::all()
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
    public function store(Request $request,ServiceCatagory $model)
    {
      $this->validate($request, [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:2000|min:']);
        $fileNameToStore = "";
          // return $request;
        if ($request->file('picturePreview')) {
          $image = $request->file('picturePreview');
          $fileNameToStore  = $request['name'].'-SC-'.time().'.'.$image->getClientOriginalExtension();
          if (!file_exists(config('global.picturePaths.serviceCatagories'))) {
              mkdir(config('global.picturePaths.serviceCatagories'), 777, true);
          }
          $path = config('global.picturePaths.serviceCatagories') . $fileNameToStore;
          Image::make($image->getRealPath())->save($path);
        }else{
          $fileNameToStore="noImage.png";
        }
      $serviceCatagory=$model->create($request->merge(['id' => uniqid("IG-")])->all());
      $serviceCatagory->logo()->create(['fileName'=>$fileNameToStore]);
      return redirect()->back()->withSuccess(__('ItemsGroup successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // return $menuItemGroup;
      $check = ServiceCatagory::find($id)->delete();
      if (!$check) {
          return redirect()->back()->withErrors("Something went wrong");
      }
        return redirect()->back()->withSuccess('Successfully Deleted');

    }
}
