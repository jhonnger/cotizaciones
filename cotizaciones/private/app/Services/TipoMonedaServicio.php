<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 23:18
 */

namespace App\Services;

use App\Repositories\TipoMonedaRepository;


class TipoMonedaServicio extends BaseServicio
{

    public function __construct(TipoMonedaRepository $tipoMonedaRepository)
    {

        parent::__construct($tipoMonedaRepository);
    }

}