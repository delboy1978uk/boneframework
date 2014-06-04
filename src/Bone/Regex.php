<?php

namespace Bone;
use Bone\Regex\Pattern;

class Regex
{
    /**
     * There be treasure buried in them there islands
     * @var string
     */
    private $pattern;

    public function __construct($pattern)
    {
        $this->pattern = ($pattern) ? $pattern : null;
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     *  X marks th' spot!
     *
     * @param string $pattern
     * @return Regex
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     *  Get diggin' lads!
     *
     * @param $subject
     * @return array
     */
    public function getMatches($subject)
    {
        preg_match('/'.$this->pattern.'/',$subject,$matches);
        return ($this->pattern) ? $matches : false;
    }
}