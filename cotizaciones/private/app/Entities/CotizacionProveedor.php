<?php

namespace App\Entities;


class CotizacionProveedor extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cotizacionproveedorcab';

    public static $snakeAttributes = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','formapago','tiempoentrega','observacion','idcotizacion','idtipomoneda','idproveedor','estado'];

    public function cotizacion()
    {
        return $this->belongsTo('App\Entities\Cotizacion','idcotizacion');
    }
    public function proveedor()
    {
        return $this->belongsTo('App\Entities\Proveedor','idproveedor');
    }
    public function moneda()
    {
        return $this->belongsTo('App\Entities\TipoMoneda','idtipomoneda');
    }
    public function cotizacionProveedorDetalle()
    {
        return $this->hasMany('App\Entities\CotizacionProveedorDetalle','idcotizacionproveedorcab');
    }

}
