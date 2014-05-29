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

    /**
     *  There be nay feckin wi' constructors on board this ship
     *  There be nay copyin' o' th'ship either
     *  This ship is a singleton!
     */
    public function __construct(){}
    public function __clone(){}


    /**
     *  Ahoy! There nay be boardin without yer configuration
     *
     * @param array $config
     * @return Application
     */
    public static function ahoy(array $config)
    {
        static $inst = null;
        if($inst === null)
        {
            $inst = new Application();
            $inst->config = $config;
        }
        return $inst;
    }

    /**
     *  T' the high seas! Garrr!
     */
    public function setSail()
    {
        die('<div style="text-align: center;"><br />&nbsp;<br /><img src="/img/skull_and_crossbones.gif" /><br />&nbsp;<br /><h1>Bone MVC</h1></h1></div>');
    }
}