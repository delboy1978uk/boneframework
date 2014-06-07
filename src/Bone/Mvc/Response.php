<?php

namespace Bone\Mvc;

class Response
{
    protected $body;

    public function __construct($response_body)
    {
        $this->body = $response_body;
    }


    /**
     *  Fire th' Cannons!!
     *
     * @return string
     */
    public function send()
    {
        return $this->body.'<div style="text-align: center;"><br />&nbsp;<br /><img src="/img/skull_and_crossbones.gif" /><br />&nbsp;<br /><h1>Bone MVC</h1></h1></div>';
    }
}