<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 23:18
 */

namespace App\Services;

use App\Repositories\CotizacionDetalleEspRepository;
use App\Repositories\CotizacionDetalleRepository;
use App\Repositories\UnidadRepository;


class CotizacionDetalleServicio extends BaseServicio
{
    private $unidadRepository;
    private $productoServicio;
    private $cotizacionDetalleEspRepository;

    public function __construct(CotizacionDetalleRepository $cotizacionDetalleRepository,
                                ProductoServicio $productoServicio,
                                CotizacionDetalleEspRepository $cotizacionDetalleEspRepository,
                                UnidadRepository $unidadRepository)
    {
        $this->unidadRepository = $unidadRepository;
        $this->productoServicio = $productoServicio;
        $this->cotizacionDetalleEspRepository = $cotizacionDetalleEspRepository;
        parent::__construct($cotizacionDetalleRepository);
    }

    public function create($data)
    {

        $data = $this->validarData($data);

        return parent::create($data);
    }

    public function update($data)
    {
        $resp = null;
        $data = $this->validarData($data);

        $resp =  parent::update($data);

        $this->guardarEspecificaciones($data);

        return $resp;
    }

    private function validarData($data){

        if(isset($data["producto"])){
            $dataProducto =  $data["producto"];

            $this->productoServicio->update($dataProducto);

            $data["idproducto"] = $dataProducto["id"];
        }

        if(isset($data["unidad"])){
            $dataUnidad =  $data["unidad"];

            $this->unidadRepository->firstOrCreate(
                ['id' => $dataUnidad["id"],'nombre'=> $dataUnidad["nombre"]]
            );

            $data["idunidad"] = $dataUnidad["id"];
        }

        return $data;
    }
    private function guardarEspecificaciones($data){

        if(isset($data["especificaciones"])){

            $especificaciones = $data["especificaciones"];

            foreach ($especificaciones as  $especificacion){

                $especificacion["idcotizaciondetalle"] = $data["id"];

                if(isset($especificacion["id"])){
                    $this->cotizacionDetalleEspRepository->update($especificacion,$especificacion["id"]);
                }
            }
        }
    }
}