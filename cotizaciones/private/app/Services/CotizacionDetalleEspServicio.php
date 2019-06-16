<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 23:18
 */

namespace App\Services;

use App\Repositories\CotizacionDetalleEspRepository;


class CotizacionDetalleEspServicio extends BaseServicio
{

    public function __construct(CotizacionDetalleEspRepository  $cotizacionDetalleEspRepository)
    {

        parent::__construct($cotizacionDetalleEspRepository);
    }
}