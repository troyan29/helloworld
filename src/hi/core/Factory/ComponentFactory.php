<?php

namespace Hi\core\Factory;

use Hi\Core\Http\HttpRequest as Request;
use Hi\Core\Http\HttpResponse as Response;
use Hi\Core\Router\Router as Router;

class ComponentFactory extends AbstractFactory
{
    public function getComponent($name)
    {
        switch ($name) {
            case 'router':
                return new Router();
            break;
            case 'request':
                return new Request();
            break;
            case 'response':
                return new Response();
            break;
            default:
                return;
            break;
        }
    }
}
