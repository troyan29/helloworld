<?php

namespace hi\core;

use Hi\Core\Lib\Helper\Uri as UriHelper;
use Hi\Core\Lib\Helper\Config as Config;
use Hi\Core\Container\Container as Container;
use Hi\Core\Factory\ComponentFactory as Factory;

class App extends Container
{
    public function __construct()
    {
        $this->applicationSetup();

        static::setInstance($this);

        $this->initialBindings();
    }

    public function applicationSetup()
    {
        Config::init();

        UriHelper::init();
    }

    public function initialBindings()
    {
        $this->bind('app', $this);

        $factory = new Factory();

        $this->bind('router', $factory->getComponent('router'));

        $this->bind('request', $factory->getComponent('request'));

        $this->bind('response', $factory->getComponent('response'));
    }

    public function run()
    {
        $this->resolve('router')->setBasePath(UriHelper::ProjectFolder());

        $this->resolve('router')->dispatch($this->resolve('request'), $this->resolve('response'));
    }

    public function get($uri, $options)
    {
        return $this->resolve('router')->get($uri, $options);
    }

    public function post($uri, $options)
    {
        return $this->resolve('router')->post($uri, $options);
    }

    public function getConfig($key)
    {
        //Decouple in Facade class
        if($key == 'database')
            return Config::getDatabase();
        elseif($key == 'app')
            return Config::getApp();
        else
            return [];
    }

}
