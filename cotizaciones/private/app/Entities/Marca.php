<?php

namespace App\Entities;


class Marca extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marca';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre','estado'];

}
