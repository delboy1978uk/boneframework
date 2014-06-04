<?php

namespace Bone\Mvc\Router;
use Bone\Regex;
use Bone\Regex\Url;

class Route
{
    /**
     *  This be th' route from th' configgerashun
     * @var string
     */
    private $name;

    /**
     * Th' settin's for th' route. garr!
     * @var array
     */
    private $config;

    /**
     *  This be the exploded path of th' array
     * @var array
     */
    private $parts;

    /**
     *  th' optional [/:var] part of th' uri as a regex
     * @var string;
     */
    private $optional;

    /**
     *  a bunch of voodoo regex strings
     * @var array
     */
    private $strings;

    /**
     *  fer matchin' patterns
     * @var \Bone\Regex
     */
    private $regex;


    /**
     *  th' exploded uri
     * @var array
     */
    private $matched_uri_parts;









    /**
     * The key an' value from th' configgerashun
     *
     * @param $name
     * @param array $config
     */
    public function __construct($name, array $config)
    {
        $this->name = $name;
        $this->config = $config;
        $this->strings = array(
            0 => '',
        );

        /**
         *  Check fer an optional var [/:var] in the configgered route
         */
        $this->regex = new Regex(Url::SQUARE_BRACKETS);
        if($matches = $this->regex->getMatches($name))
        {
            /**
             *  th' route has an optional field [/:var] at th' end garr
             *  we'll add it after we've done the rest
             */
            $this->optional = str_replace('/','',$matches[1]);
            $name = str_replace('[/'.$this->optional.']','', $name);
        }

        /**
         *  blow the feckin' route to smithereens
         */
        $this->parts = explode('/',$name);


        /**
         * Sift through the wreckage
         */
        foreach($this->parts as $part)
        {
            /**
             *  look fer a colon
             */
            if($part && strstr($part,':'))
            {
                /**
                 * Make it look fer /something
                 */
                $this->strings[0] .= Url::SLASH_WORD;
            }
            elseif($part)
            {
                /**
                 * make it look fer /part
                 */
                $this->strings[0] .= '\/'.$part;
            }
        }
        /**
         *  if there's nuthin', we must be on the feckin' home page
         */
        $this->strings[0] = ($this->strings[0] == '') ? '\/' : $this->strings[0];

        /**
         *  Make another string t' check fer
         */
        if($this->optional)
        {
            $this->strings[1] = $this->strings[0].Url::SLASH_WORD;
            //reverse the fecker, if the longer one matches first, good!
            $this->strings = array_reverse($this->strings);
        }
    }








    /**
     * checks t' see if th' uri matches the regex routes
     *
     * @param $uri
     * @return bool
     */
    public function checkRoute($uri)
    {
        // is the uri the same?
        if($uri == $this->strings[0])
        {
            $this->matched_uri_parts = explode('/',$uri);
            return true;
        }
        foreach($this->strings as $expression)
        {
            // check if it matches the pattern
            $this->regex->setPattern($expression);
            if($matches = $this->regex->getMatches($uri))
            {
                $this->matched_uri_parts = explode('/',$uri);
                return true;
            }
        }
        return false;
    }












    /**
     * th' patterns the route wants t' match
     *
     * @return array
     */
    public function getRegexStrings()
    {
        return $this->strings;
    }









    public function getControllerName()
    {
        return $this->config['controller'];
    }







    public function getActionName()
    {
        return $this->config['action'];
    }








    public function getParams()
    {
        $x = 0;
        foreach($this->parts as $part)
        {
            if(strstr($part,':'))
            {
                $this->config['params'][str_replace(':','',$part)] = $this->matched_uri_parts[$x];
            }
            $x ++;
        }
        if($this->optional)
        {
            $this->config['params'][str_replace(':','',$this->optional)] = isset($this->matched_uri_parts[$x]) ? $this->matched_uri_parts[$x] : null;
        }
        return $this->config['params'];
    }
}