<?php

namespace Hi\core\Lib\Helper;

use Hi\Core\Lib\Helper\Config as Config;

class Uri
{
    private static $app_path;

    private static $base_path;

    private static $core_path;

    private static $config_path;

    private static $lib_path;

    private static $system_path;

    public static $controller_path;

    public static $model_path;

    public static $view_path;

    public static $project_folder;

    public static function setProjectFolder($project_folder_path)
    {
        self::$project_folder = $project_folder_path;
    }

    public static function ProjectFolder()
    {
        return self::$project_folder;
    }

    public static function app()
    {
        return self::$app_path;
    }

    public static function base()
    {
        return self::$base_path;
    }

    public static function core()
    {
        return self::$core_path;
    }

    public static function config()
    {
        return self::$config_path;
    }

    public static function lib()
    {
        return self::$lib_path;
    }

    public static function system()
    {
        return self::$system_path;
    }

    public static function controller()
    {
        return self::$controller_path;
    }

    public static function model()
    {
        return self::$model_path;
    }

    public static function view()
    {
        return self::$view_path;
    }

    public static function setApp($path)
    {
        self::$app_path = file_exists($path) ? $path : '';
    }

    public static function setBase($path)
    {
        self::$base_path = file_exists($path) ? $path : '';
    }

    public static function setCore($path)
    {
        self::$core_path = file_exists($path) ? $path : '';
    }

    public static function setConfig($path)
    {
        self::$config_path = file_exists($path) ? $path : '';
    }

    public static function setLib($path)
    {
        self::$lib_path = file_exists($path) ? $path : '';
    }

    public static function setSystem($path)
    {
        self::$system_path = file_exists($path) ? $path : '';
    }

    public static function setController($path)
    {
        self::$controller_path = file_exists($path) ? $path : '';
    }

    public static function setModel($path)
    {
        self::$model_path = file_exists($path) ? $path : '';
    }

    public static function setView($path)
    {
        self::$view_path = file_exists($path) ? $path : '';
    }

    public static function base_url()
    {
        return sprintf(
            '%s://%s/%s/',
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            self::$project_folder
          );
    }

    public static function init()
    {
        self::setProjectFolder(Config::getBaseName());

        self::setBase(Config::getBase().'/');

        self::setSystem(self::base().'hi/');
        self::setApp(self::base().'app/');
        self::setCore(self::system().'core/');
        self::setLib(self::system().'lib/');
        self::setController(self::app().'controllers/');
        self::setModel(self::app().'models/');
        self::setView(self::app().'views/');
    }

    public static function redirect($to)
    {
        header("Location: $to");
    }
}
