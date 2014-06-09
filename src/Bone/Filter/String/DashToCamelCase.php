<?php

namespace Bone\Filter\String;

class DashToCamelCase extends SeparatorToCamelCase
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct('-');
    }
}