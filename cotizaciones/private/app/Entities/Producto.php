<?php

namespace App\Entities;


class Producto extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'producto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre','idunidad','idmarca','codbarras', 'idpresentacion'];

}
