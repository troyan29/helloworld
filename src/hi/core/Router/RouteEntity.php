<?php

namespace hi\core\Router;

use Exception;
use Hi\Core\Lib\UriParser as UriParser;

class RouteEntity
{
    public $pattern_uri;

    public $params = ['key' => [], 'value' => []];

    public $options = [];

    public $middleware = [];

    public $middleware_ = ['name' => [], 'action' => []];

    public $is_closure = false;

    public $closure = null;

    public $method;

    public $handler;

    public $controller_name;

    public $controller_action;

    private $parser;

    public function __construct($pattern_uri, $options)
    {
        $this->pattern_uri = $pattern_uri;

        $this->init($options);

        $this->parser = new UriParser();
    }

    public function init($options)
    {
        if (is_array($options) && empty($options)) {
            throw new Exception('Route misconfiguration !');
        }

        $this->options = $options;

        $this->parseMethod($options);

        if ($this->is_closure($options['controller']) === false) {
            $this->parseController($options);
        } else {
            $this->parseClosure($options);
        }

        $this->parseName($options);
    }

    public function preDispatch()
    {
        $this->parseMiddleware();
    }

    public function parseClosure($options)
    {
        $this->is_closure = true;
        $this->closure = $options['controller'];
    }

    public function parseController($options)
    {
        $controller_raw = isset($options['controller']) ? $options['controller'] : '/';
        $controller_name = substr($controller_raw, 0, strpos($controller_raw, ':'));
        $controller_action = substr($controller_raw, strpos($controller_raw, ':') + 1);

        $this->controller_name = $controller_name;
        $this->controller_action = $controller_action;
    }

    public function parseMiddleware()
    {
        foreach ($this->middleware as $k => $raw_middleware) {
            $name = substr($raw_middleware, 0, strpos($raw_middleware, ':'));
            $action = substr($raw_middleware, strpos($raw_middleware, ':') + 1);

            $this->middleware_['name'][] = $name;
            $this->middleware_['action'][] = $action;
        }
    }

    public function parseMethod($options)
    {
        $this->method = isset($options['method']) ? $options['method'] : 'GET';
    }

    public function parseName($options)
    {
        $this->name = isset($options['name']) ? $options['name'] : null;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        return $this->name;
    }

    public function setMatchingOption($options)
    {
        foreach ($options as $key => $type) {
            $this->parser->addMatchingOption($key, $type);
        }
    }

    public function setMiddlewares(array $middlewares)
    {
        $this->middleware = array_merge($this->middleware, $middlewares);
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getURI()
    {
        return $this->pattern_uri;
    }

    public function dispatch($request_uri, $method)
    {
        $this->preDispatch();

        if (strpos($this->pattern_uri, $this->parser->getMatchFlag()) !== false) {
            if ($this->parser->parseURI($request_uri, $this->pattern_uri)) {
                $this->params['key'] += $this->parser->getKeys();
                $this->params['value'] += $this->parser->getValues();

                if ($this->method === $method) {
                    return true;
                }
            }
        } else {
            if ($this->method == $method && $this->pattern_uri == $request_uri) {
                return true;
            }
        }

        return false;
    }

    public function is_closure($c)
    {
        return is_object($c) && ($c instanceof \Closure);
    }
}
