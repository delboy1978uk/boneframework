<?php

namespace Bone\Filter\String;

class SeparatorToCamelCase extends AbstractSeparator
{
    public function filter($value)
    {
        // garr! convert to \x00\x00 notation
        $quote = preg_quote($this->separator, '#');

        // create some feckin' voodoo black magic regex
        $patterns = array(
            '#(' . $quote.')([A-Za-z]{1})#',
            '#(^[A-Za-z]{1})#',
        );

        $replace = array(
            function ($matches)
            {
                return $matches[2];
            },
            function ($matches)
            {
                return $matches[1];
            },
        );

        $filtered = $value;
        foreach ($patterns as $index => $pattern)
        {
            $filtered = preg_replace_callback($pattern, $replace[$index], $filtered);
        }
        return $filtered;
    }
}