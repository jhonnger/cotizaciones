<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 23:08
 */

namespace App\Http\Controllers;


use App\Http\ApiResponse;
use Illuminate\Http\Request;
use App\Services\BaseServicio;

class BaseController extends Controller
{
    protected $servicioBase;

    public function __construct(BaseServicio  $baseServicio)
    {
        $this->servicioBase = $baseServicio;
    }

    public function listar()
    {
        try{
            return  $this->servicioBase->listar();
        } catch (\Exception $e){
            return ApiResponse::respuestaError("Hubo un error al listar");
        }
    }
    public function paginar()
    {
        try{
            return  $this->servicioBase->paginate();
        } catch (\Exception $e){
            return ApiResponse::respuestaError("Hubo un error al listar");
        }
    }
    public function leer($id)
    {
        try{
            return  $this->servicioBase->obtener($id);
        } catch (\Exception $e){
            return ApiResponse::respuestaError("Hubo un error al buscar");
        }
    }
    public function create(Request $request)
    {
        try{
            $inputs = $request->all();
            return  $this->servicioBase->create($inputs);
        } catch (\Exception $e){
            return ApiResponse::respuestaError($e->getMessage());
        }
    }
    public function update(Request $request)
    {
        try{
            $inputs = $request->all();
            return  $this->servicioBase->update($inputs);
        } catch (\Exception $e){
            return ApiResponse::respuestaError($e->getMessage());
        }
    }
}