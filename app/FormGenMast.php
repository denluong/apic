<?php

namespace App;

use Illuminate\Database\Eloquent\Model;;

class FormGenMast extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_form_gen_mast';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "t_form_id";
    protected $fillable = ['t_fg_name', 't_fg_id', 't_fg_class', 't_fg_method', 't_fg_function', 't_url'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
}
