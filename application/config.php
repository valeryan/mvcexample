<?php
class Config
{
    static $conf_array;

    public static function read($name)
    {
        return self::$conf_array[$name];
    }

    public static function write($name, $value)
    {
        self::$conf_array[$name] = $value;
    }
}
// db config
Config::write('db.host', '127.0.0.1');
Config::write('db.port', '3306');
Config::write('db.basename', 'testdatabase');
Config::write('db.user', 'root');
Config::write('db.password', '');

//Set Site Configuration
Config::write('base_url', 'http://mvcexample.lo');
Config::write('base_uri', '/');
Config::write('site', Config::read('base_url') . Config::read('base_uri'));
Config::write('app_dir', '../application'); // releative to public
Config::write('theme', 'default');
Config::write('base_controller', 'home');
// end of file Config.php