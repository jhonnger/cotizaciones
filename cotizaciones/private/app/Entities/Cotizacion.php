<?php

namespace App\Entities;


class Cotizacion extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cotizacion';

    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','fechacotizacion','fechavencimiento','observacion','estado'];

    public function cotizacionProveedores()
    {
        return $this->hasMany('App\Entities\CotizacionProveedor','idcotizacion');
    }

    public function cotizaciondetalle()
    {
        return $this->hasMany('App\Entities\CotizacionDetalle','idcotizacion');
    }

}
