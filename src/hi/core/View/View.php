<?php

namespace hi\core\View;

use Hi\Core\Lib\Helper\Uri as UriHelper;

class View
{
    private $data;
    private $name;
    private $app_path;

    public function __construct($view, array $data)
    {
        $this->load($view, $data);
    }

    public function load($name, array $data)
    {
        $this->app_path = UriHelper::app();
        $this->name = $name;
        $this->data = $data;

        if (!file_exists($this->app_path.'views/'.$name.'.php')) {
            echo 'View not found : '.$name;
        } else {
            $this->render();
        }
    }

    public function render()
    {
        extract($this->data);
        $baseUrl = UriHelper::base_url();
        require_once $this->app_path.'views/'.$this->name.'.php';
    }
}
