<?php

namespace App\controllers;

use Hi\Core\Controller\Controller as Controller;

class AuthController extends Controller
{
    public function loginGet()
    {
        $this->view('login', ['title' => 'Inserisci le tue credenziali']);
    }

    public function loginPost()
    {
        echo 'Processing login...';
    }

    public function logout()
    {
        echo 'Logged out';
    }
}
