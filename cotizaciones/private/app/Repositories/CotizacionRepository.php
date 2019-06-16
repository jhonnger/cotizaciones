<?php
/**
 * Created by PhpStorm.
 * User: Jhongger
 * Date: 14/06/2018
 * Time: 22:51
 */

namespace App\Repositories;


class CotizacionRepository extends BaseRepositoryImpl
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Entities\Cotizacion';
    }
}