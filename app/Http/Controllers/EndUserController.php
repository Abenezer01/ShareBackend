<?php

namespace App\Http\Controllers;

use App\Avatar;
use App\EndUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use App\UserType;
use File, Hash;
use Image;
use Response;

class EndUserController extends Controller
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
    return view('/endUsers/index', [
      'breadcrumbs' => $breadcrumbs,
      'Users' => EndUser::all()
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
        'firstName' => 'required',
        'lastName'=>'required',
        'email' => 'required|email|unique:end_users,email',
        'password' => 'required|same:confirm-password',
        'phone' => 'required',
        'avatarPreview' => 'required|image|mimes:jpeg,jpg,png,gif,tif|nullable'
    ]);

    $fileNameToStore = "";
    if ($request->file('avatarPreview')) {
      $image = $request->file('avatarPreview');
      $fileNameToStore  = $request['firstName'] . time() . '.' . $image->getClientOriginalExtension();
      $path = config('global.picturePaths.avatar') . $fileNameToStore;
      Image::make($image->getRealPath())->resize(300, 300)->save($path);
    }

    $input = $request->all();
    $input['password'] = Hash::make($input['password']);
    $fileNameToStore;
    $input['id']='EU-'.time();
    $user = EndUser::create($input);
    $avatarId=uniqid('Avatar-'.$input['firstName']);
    $avatarCr=[
      'avatarName'=>$fileNameToStore,
    ];
    $user->avatar()->create($avatarCr);
    return redirect()->back()->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EndUser  $endUser
     * @return \Illuminate\Http\Response
     */
    public function show(EndUser $endUser)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EndUser  $endUser
     * @return \Illuminate\Http\Response
     */
    public function edit(EndUser $endUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EndUser  $endUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EndUser $endUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EndUser  $endUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user=EndUser::find($id);
      if($user){
        $user->delete();
        return redirect()->back()->withSuccess('User deleted Successfully');
      }
      return redirect()->back()->withErrors('Something went wrong');
    }
    public function filter(Request $request,$key){
      $user=EndUser::where('id',$key)->get();
      if($user->count()==0){
        $user=EndUser::where('firstName',$key)->get();
      }
      return Response::json($user);
    }
}
