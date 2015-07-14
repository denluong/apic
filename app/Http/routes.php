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
function getFormElement ($formGenMastList,$formDet,$screenLabel,$formDetTable,$screenLabelTable,$elementId, $type=null) {
//	$arrReturnList = array();
//	foreach ($formGenMastList as $formMast) {
		$formGenDetList = $formDet
        ->leftJoin($screenLabel->getTable(), $formDetTable.'.t_label_code', '=', $screenLabelTable.'.t_lbl_code')
        ->select(
            $formDetTable.'.n_seq',
            $formDetTable.'.t_class',
            $formDetTable.'.t_type',
            $screenLabelTable.'.t_lbl_desc as t_label',
            $formDetTable.'.i_column')
        ->where(
            $formDetTable.'.i_frm_id', '=', $elementId)
        ->where(
            $formDetTable.'.b_show', '=', 1)
        ->where(
            $formDetTable.'.n_seq', '=', 1)
         ->orWhere(
            $formDetTable.'.n_seq', '=', 2)
         ->orWhere(
            $formDetTable.'.n_seq', '=', 3)
        ->orderBy('i_order', 'asc')
        ->get();
//        $arrReturnList[] = $formGenDetList;
//	}
    return $formGenDetList;
}
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

    // get row div 
    $formGenDetList = getFormElement($formGenMastList,$formDet,$screenLabel,$formDetTable,$screenLabelTable,$id);

    $formDetElement = array();
	$childElement = array();
	$templateElement = array();
	$formDetReturn = array();
	$templateElementReturn = array();
    // get elemnet by div
    foreach ($formGenDetList as $key=>$formDet) {
       $formGenDetListElement = $formDet
        ->leftJoin($screenLabel->getTable(), $formDetTable.'.t_label_code', '=', $screenLabelTable.'.t_lbl_code')
        ->select(
            $formDetTable.'.t_class as class',
            $screenLabelTable.'.t_lbl_desc as label',
            $formDetTable.'.i_column as column',
            $formDetTable.'.t_template_name as template_name',
            $formDetTable.'.t_group as group',
            $formDetTable.'.t_type as type',
            $formDetTable.'.t_type_id as type_id',
            $formDetTable.'.t_tag_id as key',
            $formDetTable.'.t_placeholder as placeholder',
            $formDetTable.'.t_default_value as default_value',
            $formDetTable.'.t_choice as choice',
            $formDetTable.'.t_choice_type as choice_type',
            $formDetTable.'.t_validation as validation',
            $formDetTable.'.t_trigger as trigger',
            $formDetTable.'.t_tips as tips',
            $formDetTable.'.t_note as note')
        ->where(
            $formDetTable.'.i_frm_id', '=', $id)
        ->where(
            $formDetTable.'.b_show', '=', 1)
        ->where(
            $formDetTable.'.n_seq', 'like', number_format($formDet['n_seq']).'%')
        ->where(
            $formDetTable.'.n_seq', '<>', $formDet['n_seq'])
        ->orderBy('i_order', 'asc')
        ->get();
        $formDetElement['className'] = $formDet['t_class'];
        foreach ($formGenDetListElement as $ekey=>$element) {
            $childElement['type'] =  $element['type'];
            $childElement['label'] =  $element['label'];
            $childElement['placeholder'] =  $element['placeholder'];
            $childElement['validation'] =  $element['validation'];
            //
            $templateElement['key'] = $element['key'];
            $templateElement['type'] = $element['template_name'];
            $templateElement['className'] = $element['class'];
            if($templateElement['type'] == "select") {
            	$childElement['option'] =  "vm.options.country";
            }
            $templateElement['templateOptions'] = $childElement;
            $templateElementReturn[$ekey] = $templateElement;
        }
        $formDetElement["fieldGroup"] = $templateElementReturn;
        $formDetReturn[$key] = $formDetElement;
    }

    // assign form mast data to return array
    $returnData = $formGenMastList;

    //$formGenDetList['fieldGroup'] = $formDetElement;
    // assign form det data for return array
    $returnData['form_fields'] = $formDetReturn;

    // return data and parse to json
    return Response::json($returnData);;
});
