<?php

namespace App\Entities;


class CotizacionProveedorDetalle extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cotizacionproveedordet';

    protected $casts = [
        'cantidad' => 'float',
        'preciounitario' => 'float',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','cantidad','preciounitario','idproducto','idcotizacionproveedorcab','idunidad','estado','observacion'];

    public function producto()
    {
        return $this->belongsTo('App\Entities\Producto','idproducto');
    }
    public function unidad()
    {
        return $this->belongsTo('App\Entities\Unidad','idunidad');
    }

    public function especificaciones()
    {
        return $this->hasMany('App\Entities\CotizacionProveedorDetalleEsp','idcotizacionproveedordet');
    }

}
