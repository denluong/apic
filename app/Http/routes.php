<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return View('welcome');
});
Route::get('/apilist', function ( App\Api $api) {

    return Response::json($api->all());
});

Route::get('/api/{id}', function ( App\Api $api , $id) {

    return Response::json($api->find($id));
});
Route::get('/formgen/{id}', function ( App\FormGenMast $formGenMast , $id) {

    $formGenDet = new App\FormGenDet();

    $returnData = array();

    $formGenMastList = $formGenMast->find($id);

    $formGenDetList = $formGenDet->all()->where('f_form_id', $id);;

    $returnData = $formGenMastList;
    $returnData['formDetList'] = $formGenDetList;

    return Response::json($returnData);
});
//Route::get('formgen', 'FormGenController@getFormGen{id}');