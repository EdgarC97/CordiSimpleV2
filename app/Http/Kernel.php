<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Los middleware específicos de las rutas, con nombre corto para su uso.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // Aquí es donde registras tu middleware 'checkIfAdmin'
        'checkIfAdmin' => \App\Http\Middleware\CheckIfAdmin::class,
    ];
}
