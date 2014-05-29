<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Derek.mclean
 * Date: 29/05/14
 * Time: 13:53
 * To change this template use File | Settings | File Templates.
 */

namespace Bone\Mvc;
class Application
{
    private $config;

    public function __construct()
    {
        // no construction, this is a singleton object!
    }
    public function __clone()
    {
        // no cloning mofo, this is a singleton!
    }

    public static function init(array $config)
    {
        static $inst = null;
        if($inst === null)
        {
            $inst = new Application();
            $inst->config = $config;
        }
        return $inst;
    }

    public function run()
    {
        die('<div style="text-align: center;"><br />&nbsp;<br /><img src="/img/skull_and_crossbones.gif" /><br />&nbsp;<br /><h1>Bone MVC</h1></h1></div>');
    }
}