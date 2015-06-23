<?php

namespace App;

use Illuminate\Database\Eloquent\Model;;

class FormGenDet extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_form_gen_det';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "t_form_det_id";
    protected $fillable = ['f_form_id', 't_type', 't_label', 't_id', 't_name', 't_class', 't_placeholder',
        't_validation', 't_disabled', 't_seq', 't_tooltip', 't_notes', 't_position', 't_choice', 't_choice_type'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
}
