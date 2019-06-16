<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 23:18
 */

namespace App\Services;

use App\Repositories\ProveedorRepository;
use App\Repositories\TipoDocumentoRepository;


class ProveedorServicio extends BaseServicio
{
    private $documentoRepository;
    public function __construct(ProveedorRepository $proveedorRepository,
                                TipoDocumentoRepository $documentoRepository)
    {
        $this->documentoRepository = $documentoRepository;
        parent::__construct($proveedorRepository);
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

        if(isset($data["clave"])){
            $data["clave"] = password_hash($data["clave"],PASSWORD_DEFAULT);
        }

        if(isset($data["tipodocumento"])){
            $dataTipoDoc =  $data["tipodocumento"];

            $tipoDocumento = $this->documentoRepository->firstOrCreate(
                ['id' => $dataTipoDoc["id"],'nombre'=> $dataTipoDoc["nombre"]]
            );

            $data["idtipodocumento"] = $tipoDocumento->id;
        }

        return $data;
    }
}