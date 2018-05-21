<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::name('add')->get('add', function(){
	return view('add');
	Route::resource( [
        
        'parameters' => ['profile' => 'user']
    ]);
	
});

Route::name('locations')->get('locations', function(){
	$data = [
		'points'=>App\Point::all()
	];
	return view('locations', $data);
});

Route::post('add', function(){
	$rules = [
		'address'=>'required'
	];

	$validation = Validator::make(Request::all(), $rules);
	if($validation->fails()){
		return back()->withErrors($validation)->withInput();
	}

	$param = array('address'=>Request::input('address'));
	$response = \Geocoder::geocode('json', $param);
	$location = json_decode($response);

	//dd($location);

	if($location->status == 'OK'){
		$name = $location->results[0]->address_components[0]->long_name;
		$address = $location->results[0]->formatted_address;
		$lat = $location->results[0]->geometry->location->lat;
		$lng = $location->results[0]->geometry->location->lng;

		if($lat && $lng){
			$point = new App\Point;
			$point->name = $name;
			$point->address = $address;
			$point->lat = $lat;
			$point->lng = $lng;
			$point->user_id = \Auth::user()->id;

			if($point->save()){
				return back()->withSuccess('Adresse ajoutée');
			}
		}
	}
	else{
		dd($location);
	}
});

Route::middleware('admin')->group(function () {
    Route::resource ('category', 'CategoryController', [
        'except' => 'show'
    ]);
    Route::name('maintenance.index')->get('maintenance', 'AdminController@index');
    Route::name('maintenance.destroy')->delete('maintenance', 'AdminController@destroy');
});

Route::middleware('auth')->group(function () {
	
    Route::resource('image', 'ImageController', [
		'only' => ['create', 'store', 'destroy','update']
		
		
    ]);
    Route::resource('profile', 'UserController', [
        'only' => ['edit', 'update'],
        'parameters' => ['profile' => 'user']
    ]);
});

Route::name('category')->get('category/{slug}', 'ImageController@category');

Route::name('user')->get('user/{user}', 'ImageController@user');



