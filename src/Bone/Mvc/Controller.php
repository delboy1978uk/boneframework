<?php

namespace Bone\Mvc;

class Controller
{
    protected $_request;

    public function __construct(Request $request)
    {
        $this->_request = $request;
    }
}