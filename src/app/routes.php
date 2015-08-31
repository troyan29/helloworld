<?php

$hi->get('/', 'HomeController:index');

$hi->get('/home', 'HomeController:home');

$hi->get('/contact', 'HomeController:index')
    ->middleware('AuthMiddleware:index');

$hi->get('/welcome/:name', function ($name) {
    echo "Hi $name, welcome to HiFramework !";
})->with(['name' => 'string']);

$hi->get('/login', 'HomeController:login');

$hi->post('/login', function(){
	echo 'Login process...';
});

