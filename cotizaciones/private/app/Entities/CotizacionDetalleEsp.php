<?php

namespace App\Entities;


class CotizacionDetalleEsp extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cotizaciondetespecif';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','detalle','estado','idcotizaciondetalle'];

    protected $hidden = ['fecha','fechamod','usuario','usuariomod','ip','ipmod','id'];

}
