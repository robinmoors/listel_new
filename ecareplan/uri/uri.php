<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Url Interpreter for EcarePlan Framework
 * @version 1.0
 * @package Framework
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_URI extends ECP_Object{

    protected $command = null;
    
    protected $component = null;

    protected $uri;
    
    protected $vars;
    /**
     * @var    array  An array of JURI instances.
     * @since  11.1
     */
    protected static $instances = array();

    public function __CONSTRUCT() {
        $this->uri = $_SERVER['REQUEST_URI'];
        $requestURI = explode('/', $_SERVER['REQUEST_URI']); //echte url
        $scriptname = explode('/', $_SERVER['SCRIPT_NAME']); //server url (dus de herschreven waarde)
        $commandaras = array_diff_assoc($requestURI, $scriptname); //haalt gelijke indexen eruit en voegt samen tot 1.
        $commandar = array_values($commandaras); //index met 0 laten beginnen
        
        $this->component = $commandar[0];
        $this->command = $commandar[1];
        $this->vars = array_slice($commandar, 2);
    }

    /**
     * Returns the command
     * @return string   commandname
     */
    public function getCommand() {
        return $this->command;
    }
    
    /**
     * Returns the component name
     * @return string   component name
     */
    public function getComponent(){
        return $this->component;
    }
    
    /**
     * Returns the complete URI
     * @return string   URI
     */
    public function getURI(){
        return $this->uri;
    }

    /**
     * Returns the global JURI object, only creating it
     * if it doesn't already exist.
     * @param   string  $uri  The URI to parse.  [optional: if null uses script URI]
     * @return  JURI  The URI object.
     */
    public static function getInstance($uri = 'SERVER') {
        if (empty(self::$instances[$uri])) {
            self::$instances[$uri] = new ECP_URI();
        }
        return self::$instances[$uri];
    }

    /**
     * Parse a given URI and populate the class fields.
     * @param   string  $uri  The URI string to parse.
     * @return  boolean  True on success.
     */
    public function parse($uri) {
        //TODO alle speciale html-entities in de url moeten omgezet worden (vooral bij parameters noodzakelijk)
        
        return true;
    }
    
    public function setURI($uri){
        $this->uri = $uri;
    }
}

?>
