<?php

namespace Hi\core\Factory;

abstract class AbstractFactory
{
    abstract public function getComponent($name);
}
