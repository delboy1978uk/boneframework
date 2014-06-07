<?php

namespace Bone\Mvc;

class Response
{
    protected $body;

    /**
     *  Load the cannons darn ye!
     *
     * @param $response_body
     */
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
        return $this->body;
    }
}