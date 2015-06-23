<?php

use App\FormGenMast;
use App\FormGenDet;
use App\Http\Controllers\Controller;

class FormGenController extends Controller
{
    /**
     * Create a new  controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // check login here
    }

    public function index()
    {
        return "test";
    }
    /**
     * Create new action for get data form generator
     */
    public function getFormGen($id)
    {
        /*$formGenDet = new App\FormGenDet();

        $returnData = array();

        $formGenMastList = $formGenMast->find($id);

        $formGenDetList = $formGenDet->all()->where('f_form_id', $id);;

        $returnData = $formGenMastList;
        $returnData['formDetList'] = $formGenDetList;

        return Response::json($returnData);*/
    }
}
