<?php

namespace App\Http\Controllers;

use App\Services\ProveedorServicio;


class ProveedorController extends BaseController
{

    public function __construct(ProveedorServicio $proveedorServicio)
    {
        parent::__construct($proveedorServicio);
    }
}
