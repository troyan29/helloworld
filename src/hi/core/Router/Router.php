<?php

namespace hi\core\Router;

use Hi\Core\Router\RouteEntity as Route;
use Hi\Core\Lib\Helper\Uri as Uri;
use Hi\Core\Http\HttpRequest as Request;
use Hi\Core\Http\HttpResponse as Response;
use Hi\Core\Router\ArrayAdapter as ArrayAdapter;

class Router extends ArrayAdapter
{
    protected $allRoutes = array();

    protected $routeGroups = [];

    protected $currentRoute;

    protected $namedRoutes = [];

    protected $basePath = '';

    protected $controller_404 = 'NotFoundController';

    private function push(Route $r)
    {
        array_push($this->allRoutes, $r);
    }

    private function pop()
    {
        return array_pop($this->allRoutes);
    }

    private function currentRoute()
    {
        $this->currentRoute = array_pop($this->allRoutes);

        return $this;
    }

    private function updateRoute()
    {
        $this->push($this->currentRoute);
    }

    public function map()
    {
        return new RouteEntity(func_get_args());
    }

    public function get($pattern_uri, $options)
    {
        if (is_string($options)) {
            $options = ['method' => 'GET', 'controller' => $options];
        } elseif ($this->is_closure($options)) {
            $options = ['method' => 'GET', 'controller' => $options];
        } elseif (is_array($options)) {
            $options = array_push($options, ['method' => 'GET']);
        } else {
            $options = ['method' => 'GET', 'controller' => $options];
        }

        $this->push(new Route($pattern_uri, $options));

        return $this;
    }

    private function setName($name)
    {
        $this->currentRoute->setName($name);

        return $this;
    }

    public function toJson()
    {
        $response = new Response();

        $response->setContentType('json');
        
        return $this;
    }

    private function setMatchingOption($options)
    {
        $this->currentRoute->setMatchingOption($options);

        return $this;
    }

    private function setMiddlewares($middlewares)
    {
        $this->currentRoute->setMiddlewares($middlewares);

        return $this;
    }

    public function is_closure($c)
    {
        return is_object($c) && ($c instanceof \Closure);
    }

    public function post($pattern_uri, $options)
    {
        if (is_string($options)) {
            $options = ['method' => 'POST', 'controller' => $options];
        } elseif ($this->is_closure($options)) {
            $options = ['method' => 'POST', 'controller' => $options];
        } elseif (is_array($options)) {
            $options = array_push($options, ['method' => 'POST']);
        } else {
            $options = ['method' => 'POST', 'controller' => $options];
        }

        $this->push(new Route($pattern_uri, $options));

        return $this;
    }

    public function name($name)
    {
        $this->currentRoute()->setName($name)->updateRoute();

        return $this;
    }

    public function with()
    {
        $this->currentRoute()->setMatchingOption(func_get_args()[0])->updateRoute();

        return $this;
    }

    public function middleware()
    {
        $middlewares = func_get_args();

        if (func_num_args() > 0) {
            $this->currentRoute()->setMiddlewares($middlewares)->updateRoute();
        }

        return $this;
    }

    public function delete()
    {
        $options[] = ['method' => 'DELETE'];
        $this->addNewRoute(new Route($pattern_uri, $options));
    }

    public function addRoutes(array $routes)
    {
        array_merge($this->allRoutes[], $routes);
    }

    public function setBasePath($base_path)
    {
        $this->basePath = $base_path;
    }

    public function dispatch(Request $request, Response $response)
    {
        $uri = $request->requestURI($this->basePath);

        $method = $request->requestMethod();

        foreach ($this->allRoutes as $route) {
            if ($route->dispatch($uri, $method)) {
                //Run middlewares
                foreach ($route->middleware_['name'] as $k => $v) {
                    $middleware_namespace = 'App\\middlewares\\'.$v;
                    $middleware_obj = new $middleware_namespace($request, $response);
                    call_user_func_array([$middleware_obj, $route->middleware_['action'][$k]], $route->params['value']);
                }

                if ($route->is_closure) {
                    //Run closure
                    call_user_func_array($route->closure, $route->params['value']);

                    return true;
                } else {
                    //Run controller code
                    $controller_namespace = 'App\\controllers\\'.$route->controller_name;
                    $controller_obj = new $controller_namespace($request, $response);
                    call_user_func_array([$controller_obj, $route->controller_action], $route->params['value']);

                    return true;
                }
            }
        }

        //No routes found to this URI go to Controller 404
        $controller_namespace = 'App\\controllers\\'.$this->controller_404;
        $controller_obj = new $controller_namespace($request, $response);
        call_user_func_array([$controller_obj, 'index'], array());

        return false;
    }
}
