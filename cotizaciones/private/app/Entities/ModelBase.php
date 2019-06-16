<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ModelBase extends Model
{

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['fecha','fechamod','usuario','usuariomod','ip','ipmod','clave'];
    const CREATED_AT = 'fecha';
    const UPDATED_AT = 'fechamod';
}
