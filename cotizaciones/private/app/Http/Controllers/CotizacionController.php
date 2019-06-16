<?php

namespace App\Http\Controllers;

use App\Http\ApiResponse;
use App\Services\CotizacionServicio;
use Illuminate\Http\Request;

class CotizacionController extends BaseController
{

    public function __construct(CotizacionServicio $cotizacionServicio)
    {
        //$this->middleware('jwt.auth');
        parent::__construct($cotizacionServicio);
    }
    public function busquedaPaginada(Request $request,$cantidad,$pagina){

        try{
            return  $this->servicioBase->busquedaPaginada($cantidad, $pagina);
        } catch (\Exception $e){
            return ApiResponse::respuestaError($e->getMessage());
        }
    }
    public function obtenerParaComparar($cotizacionId){
        try{
            return  $this->servicioBase->obtenerParaCuadroComparativo($cotizacionId);
        } catch (\Exception $e){
            return ApiResponse::respuestaError($e->getMessage());
        }
    }
}
