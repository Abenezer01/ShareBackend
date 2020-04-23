<?php

namespace App\Http\Controllers;

use App\MenuItemGroup;
use App\MenuItems;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MenuItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MenuItems $model)
    {
        $model = [];
        if (!empty(auth()->user()['serviceProvider']['menuItems'])) {
            $model = auth()->user()['serviceProvider']->menuItems()->paginate(15);
        }
        return view('menu.index', ['MenuItems' => $model]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = MenuItemGroup::all();
        // return $model;
        return view('menu.create', ['ItemsGroup' => $model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MenuItems $model)
    {
        // return $request;
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255|min:',
            'itemsGroupId' => 'required|string|max:255',
            'description' => 'required|string',
            'picturePreview' => 'required|image|mimes:jpeg,jpg,png,gif|nullable']);
            if ($request->file('avatarPreview')) {
              $image = $request->file('avatarPreview');
              $fileNameToStore  ='MI-'. time() . '.' . $image->getClientOriginalExtension();
              $path = config('global.AdminUrl'). $fileNameToStore;
              Image::make($image->getRealPath())->resize(300, 300)->save($path);
            }
        $request['picture'] = $fileNameToStore;
        $request['serviceProviderId'] = auth()->user()['serviceProviderId'];
        $model->create($request->merge(['id' => uniqid(auth()->user()['serviceProvider']['name'] . "-" . 'MI-')])->all());
        return redirect()->route('menu.index')->withStatus(__('Menu Item successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItems $menuItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function edit($itemId)
    {
        $model = auth()->user()['serviceProvider']['menuItems']->find($itemId);
        if (empty($model)) {
            return redirect()->back()->withErrors('Not found or System error')->withInput();
        }
        $ItemsGroup = MenuItemGroup::all();
        return view('menu.edit', ['MenuItem' => $model, 'ItemsGroup' => $ItemsGroup]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $itemId)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255|min:',
            'itemsGroupId' => 'required|string|max:255',
            'description' => 'required|string',
            'picturePreview' => 'image|mimes:jpeg,jpg,png,gif|nullable']);
        if ($request->hasFile('picturePreview') && $request->file('picturePreview')->isValid()) {
            //get file name with extension
            $filenameWithExt = $request->file('picturePreview')->getClientOriginalName();
            //get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get image extension
            $extension = $request->file('picturePreview')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = auth()->user()['serviceProvider']['name'] . "_" . preg_replace('/\s+/', '', $request['name']) . "_" . time() . '.' . $extension;
            //upload image
            $path = $request->file('picturePreview')->storeAs('public/Images/MenuItem', $fileNameToStore);
            $request['picture'] = $fileNameToStore;

        } else {
            unset($request['picture']);
        }
        MenuItems::find($itemId)->update($request->all());
        return redirect()->route('menu.index')->withStatus(__('Menu Item successfully Updated.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItems $menuItem)
    {
        return $menuItem;
        $menuItem->delete();
        return redirect()->route('happyHour.index')->withStatus(__('Happy Hour successfully deleted.'));
    }
    public function getPicture($imageName)
    {
        $path = public_path() . '/storage/Images/MenuItem/' . $imageName;
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
    public function availability(Request $request)
    {
        $model = MenuItems::where('itemId', $request['itemId'])->first();
        $model->update(['availability' => $request['availability']]);
        if ($model['availability'] == 1) {
            return redirect()->back()->withsuccess($model['name'] . ' is Avialable now.');
        }
        return redirect()->back()->withwarning($model['name'] . ' is Unavailable now.');

    }
}
