<?php

namespace App\controllers;

use Hi\Core\Controller\Controller;
use Hi\Core\Http\HttpResponse as Response;

class HomeController extends Controller
{
    public function index()
    {
        echo 'Benvenuto in Hi Framework !';
    }

    public function home()
    {   
        $response = $this->getInstance()->resolve('response');

        $response->setContentType('json');

        $response->body(['name' => 'diego', 'title' => 'Home page']);
    }

    public function login()
    {
    	$this->view('login',[]);
    }
}
