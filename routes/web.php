<?php

use Illuminate\Support\Facades\Route;

use App\Models\CommunityNight;

use Illuminate\Http\Request;

Route::get('/CreateCommunityNight', function(){
  return view("CommunityNight.CreateCommunityNight");
});


Route::get('/ReadCommunityNight', function(){

  $communities = CommunityNight::all();
     
  return view('CommunityNight.ReadCommunityNight', ['communityNights' => $communities]);
});

Route::Post('/ReadCommunityNight', function(Request $request){

  $request->validate([

    'title' => 'required',

  ]);

  $imagePath = null;

  if($request->hasFile('image')){

    $imagePath = $request->file('image')->store('community_images','public');
  }

  CommunityNight::Create([

    'title' => request('title'),
    'image' => $imagePath,
    'description' => request('description'),
    'start_time' => request('start_time'),
    'end_time' => request('end_time'),
    'location' => request('location'),
    'link' => request('link'),
    'capacity' => request('capacity')
  ]);
  
  return redirect('/ReadCommunityNight');
});

