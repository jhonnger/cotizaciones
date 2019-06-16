<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 23:18
 */

namespace App\Services;

use App\Entities\CotizacionProveedor;
use App\Repositories\CotizacionProveedorDetalleRepository;
use App\Repositories\CotizacionProveedorDetEspRepository;
use App\Repositories\CotizacionProveedorRepository;
use Illuminate\Support\Facades\Auth;


class CotizacionProveedorServicio extends BaseServicio
{
    private $proveedorServicio;
    private $proveedorDetEspRepository;
    private $cotizacionProveedorDetalleRepository;

    public function __construct(CotizacionProveedorRepository $cotizacionProveedorRepository,
                                CotizacionProveedorDetEspRepository  $proveedorDetEspRepository,
                                CotizacionProveedorDetalleRepository $cotizacionProveedorDetalleRepository,

                                ProveedorServicio $proveedorServicio)
    {
        $this->proveedorServicio = $proveedorServicio;
        $this->proveedorDetEspRepository = $proveedorDetEspRepository;
        $this->cotizacionProveedorDetalleRepository = $cotizacionProveedorDetalleRepository;
        parent::__construct($cotizacionProveedorRepository);
    }

    function obtener($id)
    {
        $data = $this->repositoryBase->find($id);
        $currentUser = Auth::user();
        $data = CotizacionProveedor::with('cotizacionProveedorDetalle.producto','cotizacionProveedorDetalle.unidad',
                                                    'cotizacionProveedorDetalle.especificaciones',
                                                    'cotizacion.cotizaciondetalle.producto','cotizacion.cotizaciondetalle.unidad',
                                                'cotizacion.cotizaciondetalle.especificaciones')
            ->whereHas('cotizacion',function ($q) use ($id) {
                $q->where("id",$id)
                  ->where("fechavencimiento",'>=', date("Y-m-d"));
            })
            ->where('estado',true)
            ->where('idproveedor',$currentUser->id)
            ->first();

        if (is_null($data->cotizacionProveedorDetalle) || count($data->cotizacionProveedorDetalle) == 0){

            $data["cotizaciondetalle"] = $data->cotizacion->cotizaciondetalle;

            unset($data->cotizacion->cotizaciondetalle);
        } else{
            $data["cotizaciondetalle"] = $data->cotizacionProveedorDetalle;
            unset($data->cotizacionProveedorDetalle);
        }


        $respuesta = [ "cotizacionProveedor" => $data, "ok"=> "true"];


        return response()->json($respuesta);
    }



    public function create($data)
    {

        $data = $this->validarData($data);

        $this->guardarCotizacionProveedoresDetalles($data);

        return parent::create($data);
    }

    public function update($data)
    {
        $resp = null;
        $data = $this->validarData($data);
        $resp = parent::update($data);

        $this->guardarCotizacionProveedoresDetalles($data);

        return $resp;
    }

    private function validarData($data){

        if(isset($data["proveedor"])){
            $dataProveedor =  $data["proveedor"];

            $this->proveedorServicio->update($dataProveedor);

            $data["idproveedor"] = $dataProveedor["id"];
        }

        return $data;
    }
    private function guardarCotizacionProveedoresDetalles($data){

        if(isset($data["cotizaciondetalle"])){

            $detalles = $data["cotizaciondetalle"];


            foreach ($detalles as  $detalle){

                $detalle["idcotizacionproveedorcab"] = $data["id"];

                if(isset($detalle["id"])){
                    $this->cotizacionProveedorDetalleRepository->update($detalle, $detalle["id"]);
                } else{
                    $detalleNuevo = $this->cotizacionProveedorDetalleRepository->create($detalle);

                    $detalle["id"] = $detalleNuevo->id;
                }
                $this->guardarEspecificacion($detalle);
            }
        }
    }

    private function guardarEspecificacion($detalle = []){
        if(isset($detalle["especificaciones"])){
            $especificaciones = $detalle["especificaciones"];
            foreach ($especificaciones as $especificacion){
                $especificacion["idcotizacionproveedordet"] = $detalle["id"];
                if(isset($especificacion["id"])){
                    $this->proveedorDetEspRepository->update($especificacion, $especificacion["id"]);
                } else{
                    $this->proveedorDetEspRepository->create($especificacion);
                }
            }
        }
    }
}