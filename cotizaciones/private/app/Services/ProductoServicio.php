<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 23:18
 */

namespace App\Services;

use App\Repositories\ProductoRepository;
use App\Repositories\ProveedorRepository;
use App\Repositories\TipoDocumentoRepository;
use App\Repositories\TipoProductoRepository;


class ProductoServicio extends BaseServicio
{
    private $tipoProductoRepository;
    public function __construct(ProductoRepository $productoRepository,
                                TipoProductoRepository $tipoProductoRepository)
    {
        $this->tipoProductoRepository = $tipoProductoRepository;
        parent::__construct($productoRepository);
    }

    public function create($data)
    {

        $data = $this->validarData($data);

        return parent::create($data);
    }

    public function update($data)
    {
        $data = $this->validarData($data);

        return parent::update($data);
    }

    private function validarData($data){

        if(isset($data["tipoproducto"])){
            $dataTipoProd =  $data["tipoproducto"];

            $tipoDocumento = $this->tipoProductoRepository->firstOrCreate(
                ['id' => $dataTipoProd["id"],'nombre'=> $dataTipoProd["nombre"]]
            );

            $data["idtipoproducto"] = $tipoDocumento->id;
        }

        return $data;
    }
}