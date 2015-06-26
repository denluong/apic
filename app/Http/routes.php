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
Route::get('/formgen/{id}', function ( $id) {
    // use the model table form det and table label
    $formMast = new App\FormMast();
    $formDet = new App\FormDet();
    $screenLabel = new App\ScreenLabel();

    // define var for table name get
    $formDetTable = $formDet->getTable();
    $screenLabelTable = $screenLabel->getTable();

    // define array data for json return
    $returnData = array();

    // get data from table form mast
    $formGenMastList = $formMast->find($id);

    //$formGenDetList = $formDet->all()->where('i_frm_id', $id);

    // get data from form det inner join with table label
    $formGenDetList = $formDet
        ->join($screenLabel->getTable(), $formDetTable.'.t_label_code', '=', $screenLabelTable.'.t_lbl_code')
        ->select(
            $formDetTable.'.i_frm_id',
            $formDetTable.'.t_wrapper_id',
            $screenLabelTable.'.t_lbl_desc')
        ->where(
            $formDetTable.'.i_frm_id', '=', $id)
        ->get();

    // assign form mast data to return array
    $returnData = $formGenMastList;

    // assign form det data for return array
    $returnData['form_fields'] = $formGenDetList;

    // return data and parse to json
    return Response::json($returnData);
});
