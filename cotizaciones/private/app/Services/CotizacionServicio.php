<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 23:18
 */

namespace App\Services;

use App\Entities\Cotizacion;
use App\Http\ApiResponse;
use App\Repositories\CotizacionRepository;
use Illuminate\Support\Facades\Auth;


class CotizacionServicio extends BaseServicio
{

    private $cotizacionDetalleServicio;
    private $cotizacionProveedorServicio;

    public function __construct(CotizacionRepository $cotizacionRepository,
                                CotizacionProveedorServicio $cotizacionProveedorServicio,
                                CotizacionDetalleServicio $cotizacionDetalleServicio)
    {
        $this->cotizacionDetalleServicio = $cotizacionDetalleServicio;
        $this->cotizacionProveedorServicio = $cotizacionProveedorServicio;

        parent::__construct($cotizacionRepository);
    }

    public function create($data)
    {
        $cotizacion = null;

        var_dump($data);
        $cotizacion =  $this->repositoryBase->create($data);
        $data["id"] = $cotizacion->id;

        $this->guardarDetalles($data);
        $this->guardarCotizacionProveedores($data);

        return ApiResponse::respuestaExito($cotizacion->id);

    }
    public function busquedaPaginada($cantidad,$pagina){


        $currentUser = Auth::user();

        $data = Cotizacion::whereHas("cotizacionProveedores", function($query) use ($currentUser) {
            $query->where('idproveedor',$currentUser->id );

        })->where("estado",true)
          ->where("fechavencimiento",'>=', date("Y-m-d"))
          ->paginate($cantidad,['*'],'page',$pagina)->toArray();

        $data["rows"] = $data["data"];
        $data["count"] = $data["total"];


        return ApiResponse::respuestaExito($data);
    }
    private function guardarDetalles($data){

        if(isset($data["cotizaciondetalle"])){

            $detalles = $data["cotizaciondetalle"];

            foreach ($detalles as  $detalle){

                $detalle["idcotizacion"] = $data["id"];

                if(isset($detalle["id"])){
                    $this->cotizacionDetalleServicio->update($detalle);
                }
            }
        }
    }
    private function guardarCotizacionProveedores($data){

        if(isset($data["cotizacionproveedores"])){

            $proveedores = $data["cotizacionproveedores"];


            foreach ($proveedores as  $cotizacionProveedor){

                $cotizacionProveedor["idcotizacion"] = $data["id"];

                if(isset($cotizacionProveedor["id"])){
                    $this->cotizacionProveedorServicio->update($cotizacionProveedor);
                }
            }
        }
    }

    public function update($data)
    {
        var_dump($data);
        $respuesta = parent::update($data);;
        $this->guardarDetalles($data);
        $this->guardarCotizacionProveedores($data);

        return $respuesta;
    }

    function obtenerParaCuadroComparativo($id)
    {
        $respuesta = [];

        $data = Cotizacion::with('cotizacionProveedores.cotizacion','cotizacionProveedores.proveedor',
                                          'cotizacionProveedores.cotizacionProveedorDetalle.unidad',
                                          'cotizacionProveedores.moneda','cotizacionProveedores.cotizacionProveedorDetalle.especificaciones',
            'cotizacionProveedores.cotizacionProveedorDetalle.producto' , 'cotizaciondetalle.unidad','cotizaciondetalle.producto')

            ->where('estado',true)
            ->where('id',$id)
            ->first();

       // var_dump($data->cotizacionProveedores);

        $respuesta["cotizacionproveedor"] = $data->cotizacionProveedores;
        $cotizacion = $data;

        unset($cotizacion->cotizacionProveedores);
        $respuesta["cotizacion"] = $cotizacion;



        return ApiResponse::respuestaExito($respuesta);
    }

}