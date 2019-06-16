<?php

namespace App\Http\Controllers;


use App\Services\TipoMonedaServicio;

class TipoMonedaController extends BaseController
{

    public function __construct(TipoMonedaServicio $tipoMonedaServicio)
    {
        parent::__construct($tipoMonedaServicio);
    }


}
