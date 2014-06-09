<?php

namespace Bone;
use Bone\Filter\String;
use Bone\Filter\Exception;

abstract class Filter
{
    public static function filterString($string, $filter_type)
    {
        if(class_exists('Bone\Filter\String\\'.$filter_type))
        {
            $filter_name = 'Bone\Filter\String\\'.$filter_type;
            $filter = new $filter_name();
            return $filter->filter($string);
        }
        throw new Exception(Exception::NO_FILTER);
    }
}