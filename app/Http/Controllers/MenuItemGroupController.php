<?php

namespace App\Http\Controllers;

use App\MenuItemGroup;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Image;
class MenuItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MenuItemGroup $model)
    {
      $breadcrumbs = [
        ['link' => "dashboard-analytics", 'name' => "Home"], ['link' => "dashboard-analytics", 'name' => "Pages"], ['name' => "User List"],
      ];
      return view('/Menu/MenuItemsGroup/index', [
        'breadcrumbs' => $breadcrumbs,
        'menuItemsGroup'=>MenuItemGroup::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MenuItemGroup $model)
    {
        return view('itemGroup.create', ['ItemsGroup' => $model->paginate(15)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MenuItemGroup $model)
    {
      return $request;
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'picturePreview' => 'required|image|mimes:jpeg,jpg,png,gif|nullable',
            'description' => 'required|string|max:2000|min:']);
                $fileNameToStore = "";
                if ($request->file('picturePreview')) {
                  $image = $request->file('picturePreview');
                  $fileNameToStore  = 'Image-IG-'.time().'.'.$image->getClientOriginalExtension();
                  if (!file_exists(config('global.picturePaths.menuItemsGroup'))) {
                      mkdir(config('global.picturePaths.menuItemsGroup'), 777, true);
                  }
                  $path = config('global.picturePaths.menuItemsGroup') . $fileNameToStore;
                  Image::make($image->getRealPath())->save($path);
                }else{
                  $fileNameToStore="noImage.png";
                }

        $menuItemGroup=$model->create($request->merge(['id' => uniqid("IG-")])->all());
        $menuItemGroup->images()->create(['fileName'=>$fileNameToStore]);

        return redirect()->back()->withSuccess(__('ItemsGroup successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItemGroup  $menuItemGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItemGroup  $menuItemGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = MenuItemGroup::findOrFail($id);
        return view('itemGroup.edit', ['ItemsGroup' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItemGroup  $menuItemGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItemGroup $menuItemGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItemGroup  $menuItemGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($menuItemGroup)
    {
        // return $menuItemGroup;
        $check = MenuItemGroup::where('id', $menuItemGroup)->delete();
        if (!$check) {
            return redirect()->back()->withErrors("Something went wrong");
        }
          return redirect()->back()->withSuccess(__('Item group successfully deleted.'));
    }
    public function getPicture($imageName)
    {
        $path = public_path() . config('') . $imageName;
        // return $path;
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
