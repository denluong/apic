<?php

namespace App;

use Illuminate\Database\Eloquent\Model;;

class Api extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_api_mast';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "t_id";
    protected $fillable = ['t_title', 't_type', 't_body'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
}
