<?php

namespace App\Http\Controllers;


use App\Services\CotizacionProveedorServicio;

class CotizacionProveedorController extends BaseController
{

    public function __construct(CotizacionProveedorServicio $cotizacionProveedorServicio)
    {
        $this->middleware('jwt.auth');
        parent::__construct($cotizacionProveedorServicio);
    }


}
