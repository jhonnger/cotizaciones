<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 23:13
 */

namespace App\Services;


use App\Http\ApiResponse;
use App\Repositories\BaseRepository;

class BaseServicio
{
    protected $repositoryBase;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->repositoryBase = $baseRepository;
    }

    /**
     * @return ApiResponse
     */
    public function listar()
    {
        $data = $this->repositoryBase->all();
        return ApiResponse::respuestaExito($data);
    }

    public function paginate()
    {
        $data = $this->repositoryBase->paginate();
        return ApiResponse::respuestaExito($data);
    }
    public function obtener($id)
    {
        $data = $this->repositoryBase->find($id);
        return ApiResponse::respuestaExito($data);
    }
    public function create($data)
    {
        $res = $this->repositoryBase->create($data);
        return ApiResponse::respuestaExito($res);
    }
    public function update($data)
    {
        $res = $this->repositoryBase->update($data, $data["id"]);
        return ApiResponse::respuestaExito($res);
    }
}