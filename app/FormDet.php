<?php

namespace App;

use Illuminate\Database\Eloquent\Model;;

class FormDet extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'scr_frm_det';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "i_frm_det_id";
    protected $fillable = ['i_frm_id','t_wrapper_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
}
