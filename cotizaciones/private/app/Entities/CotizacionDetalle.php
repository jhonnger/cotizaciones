<?php

namespace App\Entities;


class CotizacionDetalle extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cotizaciondetalle';

    protected $hidden = ['fecha','fechamod','usuario','usuariomod','ip','ipmod','id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','cantidad','idproducto','idcotizacion','idunidad','estado'];

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
        return $this->hasMany('App\Entities\CotizacionDetalleEsp','idcotizaciondetalle');
    }

}
