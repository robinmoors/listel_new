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
        
        $this->component = ($commandar[0]) ? $commandar[0] : null; //eerste stuk gaat het component zijn
        $this->command = ($commandar[1]) ? $commandar[1] : null; //2de stuk gaat de functie/actie zijn voor de controller
        $this->vars = array_slice($commandar, 2); //3de stuk (of meerdere) bestaat uit parameters
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
    
    public function getVars(){
        return $this->vars;
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
     * Returns the userid if given in url!
     * If not, returns null
     * 
     */
    public function getUserId(){
        if($this->vars){
                $id = 0;
            if(is_array($this->vars)){
                $id = $this->vars[count($this->vars)-1];
            }else{
                $id = $this->vars;
            }
            if(intval($id)) return intval($id);
            else return 0;
        }else{
            return 0;
        }
    }

    /**
     * Parse a given URI and populate the class fields.
     * @param   string  $uri  The URI string to parse.
     * @return  boolean  True on success.
     */
    public function parse($uri=null) {
        //TODO alle speciale html-entities in de url moeten omgezet worden (vooral bij parameters noodzakelijk)
        if($this->component === null) $this->component = "home";
        if($this->command === null) $this->command = "std_command";
        $this->parseComponent();
        $this->parseCommand();
        $this->parseVars();
        return true;
    }
    
    public function setURI($uri){
        $this->uri = $uri;
    }
    
    private function parseComponent(){
        //Component-naam mag enkel bestaan uit kleine letters, 
        //eventueel een koppelteken of liggend streepje
        //alle andere tekens zijn ongeldig!
        if($this->command !== "error"){ //error component kan ook extern worden opgeroepen!
            $strval = preg_match('/^[A-Za-z_-]*/', $this->component, $matches, PREG_OFFSET_CAPTURE);
            //Strval zal exact 1 zijn wanneer er een match is, 0 of FALSE indien niet.
            //Maar bij een match kan het zijn dat niet de hele string gematched is, dus even controleren...
            //in $matches staat een array met matches, elke match is een array met 0 de match en 1 de offset
            //Deze moet dus al 0 zijn en de eerste match moet ook de hele string zijn!
            if($strval !== 1 || $matches[0][1]!=0 || $matches[0][0]!==$this->component){
                $this->component = "error";
                $this->command = "unsafe_url";
            }
        }else{
            $this->command = "error_example";
        }
    }
    
    private function parseCommand(){
        if($this->command !== "error"){
            $strval = preg_match('/^[A-Za-z_-]*/', $this->command, $match, PREG_OFFSET_CAPTURE);
            if($strval !== 1 || $match[0][1]!=0 || $match[0][0]!==$this->command){
                $this->component = "error";
                $this->command = "unsafe_command_url";
            }
        }else{
            $this->command = "std_command";
        }
    }
    
    private function parseVars(){
        if($this->command !== "error"){
            if(is_array($this->vars)){
                $this->vars = filter_var_array($this->vars,FILTER_SANITIZE_STRING);
            }else
                @$this->vars = filter_var($this->vars,FILTER_SANITIZE_STRING); 
            //indien door de filtering de parameters wegvallen, dan zal er in de controller intern een errorhandling gebeuren
        }else{
            $this->vars = null; //bij error component geen parameters nodig
        }
    }
}

?>
