<?php

namespace App\Http\Controllers;

use App\CHRLServiceProviders;
use App\Location;
use App\ServiceCatagory;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Image;
class CHRLServiceProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $model=CHRLServiceProviders::all();
      $model2=ServiceCatagory::all();
      $breadcrumbs = [
        ['link' => "dashboard-analytics", 'name' => "Home"], ['link' => "dashboard-analytics", 'name' => "Pages"], ['name' => "Service Providers List"],
      ];
      return view('/Menu/CHRLServiceProviers/index', [
        'breadcrumbs' => $breadcrumbs,
        'serviceProviders' => $model,
        'serviceCatagories'=>$model2
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
    public function store(Request $request, CHRLServiceProviders $model)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|min:',
            'email' => 'required|string|max:255',
            'serviceCatagoryId' => 'required',
            'webLink' => 'required|string|max:255',
            'email' => 'required|email|string|email|max:255|unique:c_h_r_l_service_providers',
            'avatarPreview' => 'required|image|mimes:jpeg,jpg,png,gif,tif|nullable']);
            // return $request;
          if ($request->file('avatarPreview')) {
            $image = $request->file('avatarPreview');
            $fileNameToStore  = 'SP-'.$request['name'].'-'.time().'.'.$image->getClientOriginalExtension();
            if (!file_exists(config('global.picturePaths.CHRLServiceProvider'))) {
                mkdir(config('global.picturePaths.CHRLServiceProvider'), 777, true);
            }
            $path = config('global.picturePaths.CHRLServiceProvider') . $fileNameToStore;
            Image::make($image->getRealPath())->save($path);
          }else{
            $fileNameToStore="noImage.png";
          }
        $serviceProvider=$model->create($request->merge(['id' => uniqid("SP-")])->all());
        $serviceProvider->logo()->create(['fileName'=>$fileNameToStore]);
        $serviceProvider->location()->create();
        return redirect()->back()->withSuccess(__('Service Provider successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CHRLServiceProviders  $cHRLServiceProviders
     * @return \Illuminate\Http\Response
     */
    public function show(CHRLServiceProviders $cHRLServiceProviders)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CHRLServiceProviders  $cHRLServiceProviders
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model1 = CHRLServiceProviders::find($id);
        $model2 = ServiceCatagory::all();
        return view('serviceProviders.edit', ['serviceProvider' => $model1, 'ServiceCatagories' => $model2]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CHRLServiceProviders  $cHRLServiceProviders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cHRLServiceProviders)
    {
        $model = CHRLServiceProviders::find($cHRLServiceProviders);
        $model->update($request->all());
        return redirect('serviceProviders')->with('Service Provider Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CHRLServiceProviders  $cHRLServiceProviders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // return $menuItemGroup;
      $check = CHRLServiceProviders::find($id)->delete();
      if (!$check) {
          return redirect()->back()->withErrors("Something went wrong");
      }
        return redirect()->back()->withSuccess('Successfully Deleted');
    }
    public function getLogo($imageName)
    {
        $path = public_path() . '/storage/Images/ServiceProviders/logos/' . $imageName;
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
