<?php

namespace Hi\core\Lib\Helper;

class Config
{
    private static $base;

    private static $basename;

    private static $db_cfg;

    private static $app_config;

    public static function init()
    {
        static::$base = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
        static::$basename = basename(dirname(dirname(dirname(dirname(dirname(__FILE__))))));

        static::$db_cfg = parse_ini_file(static::$base.'/config/.database');
        static::$app_config = parse_ini_file(static::$base.'/config/.app');
        if(static::$app_config['DEBUG'] == true) ini_set('display_errors', 'on');

        //static::setupDatabase();
    }

    public static function setupDatabase()
    {
        return \R::setup( 'mysql:host='.static::$db_cfg['DB_HOST'].';dbname='.static::$db_cfg['DB_NAME'],
        static::$db_cfg['DB_USER'], static::$db_cfg['DB_PASS'] );
    }

    public static function getDatabase()
    {
        return static::$database_config;
    }

    public static function getApp()
    {
        return static::$app_config;
    }

    public static function getBase()
    {
        return static::$base;
    }

    public static function getBaseName()
    {
        return static::$basename;
    }
}
