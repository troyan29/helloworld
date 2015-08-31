<?php

/**
 * Hi - A stupidly easy PHP Micro Framework.
 *
 * @author   Diego Mariani <diego.mariani@mail.com>
 *
 * @version  0.0.2
 *
 * @since    January 2015
 */

/**
 * Requiring autoloader file generated with composer
 */
require_once 'vendor/autoload.php';

/*
 * Instantiating App class that will be used all over the application
 */

$hi = new Hi\Core\App();

/**
 * Requiring routes file that contains all routes definitions.
 */
require_once 'app/routes.php';

/*
 * Running the app
 */

$hi->run();
