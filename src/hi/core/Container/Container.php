<?php

namespace Hi\core\Container;

use Exception;

class Container
{
    /**
     * @var
     */
    protected $instances = array();

    protected static $instance;

    public static function setInstance(Container $myInstance)
    {
        static::$instance = $myInstance;
    }

    public static function getInstance()
    {
        return self::$instance;
    }

    /**
     * Add a new resolver to the instances array.
     *
     * @param string $name    The id
     * @param object $resolve Closure that creates instance
     */
    public function bind($name, $resolve)
    {
        $this->instances[$name] = $resolve;
    }

    public function bindAndResolve($name, $obj)
    {
        $this->instances[$name] = $obj;

        return $obj;
    }

    /**
     * Create the instance.
     *
     * @param string $name The id
     *
     * @return mixed
     */
    public function resolve($name)
    {
        if ($this->registered($name)) {
            return $this->instances[$name];
        }

        throw new Exception('Nothing registered with that name, fool.');
    }

    /**
     * Determine whether the id is registered.
     *
     * @param string $name The id
     *
     * @return bool Whether to id exists or not
     */
    public function registered($name)
    {
        return array_key_exists($name, $this->instances);
    }
}
