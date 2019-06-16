<?php

namespace App\Entities;


class TipoProducto extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipoproducto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre','estado'];

}
