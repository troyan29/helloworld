<?php

namespace App\middlewares;

use Hi\Core\Middleware\Middleware as Middleware;

class AuthMiddleware extends Middleware
{
    public function index()
    {
        echo 'This is a Middleware for <br />';
    }
}
