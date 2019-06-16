<?php

namespace App\Entities;


class CotizacionProveedorDetalleEsp extends ModelBase
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cotizacionproveedordetesp';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','detalle','idcotizacionproveedordet','estado'];

}
