<?php

namespace App;

use Illuminate\Database\Eloquent\Model;;

class ScreenDet extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'scr_det';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "i_scr_det_id";
    protected $fillable = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
}
