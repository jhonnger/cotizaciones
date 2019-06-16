<?php

namespace App\Entities;


class TipoMoneda extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipomoneda';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre','estado'];

}
