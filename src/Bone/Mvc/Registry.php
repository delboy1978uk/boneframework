<?php


namespace Bone\Mvc;

/**
 * Ahoy there! This here class will store all o' t' configuration
 * variables we have for our appication
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
     * What would you like us t' remember for you?
     * @param $index
     * @param $value
     */
    public function __set($index, $value)
    {
        $this->vars[$index] = $value;
    }

    /**
     * You would like t' remember somethin'?
     * @param $index
     * @return mixed
     */
    public function __get($index)
    {
        return $this->vars[$index];
    }
}