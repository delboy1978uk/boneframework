<?php


namespace Bone\Mvc;

/**
 * Ahoy there! This here class will store all o' t' configuration
 * variables we have for our app'ication
 * Class Registry
 * @package Bone\Mvc
 */
class Registry
{
    /**
     * @var array
     * @access private
     */
    private $vars = array();


    /**
     *  There be nay feckin wi' constructors on board this ship
     *  There be nay copyin' o' th'ship either
     *  This ship is a singleton!
     */
    public function __construct(){}
    public function __clone(){}


    /**
     *  Ahoy! There nay be boardin' without yer configuration

     * @return Registry
     */
    public static function ahoy()
    {
        static $inst = null;
        if($inst === null)
        {
            $inst = new Registry();
        }
        return $inst;
    }

    /**
     * What would you like us t' remember for you?
     * @param $index
     * @param $value
     */
    public function set($index, $value)
    {
        $this->vars[$index] = $value;
    }

    /**
     * You would like t' remember somethin'?
     * @param $index
     * @return mixed
     */
    public function get($index)
    {
        return isset($this->vars[$index]) ? $this->vars[$index] : null;
    }
}