<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Router klasse voor EcarePlan App
 * @version 1.0
 * @package application
 * @subpackage router
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
class ECP_Router extends ECP_Object{
    
    protected $uri;
    
    protected $component;
    /***
     * The state of the router
     * @see getState()
     */
    protected $state;
    
    protected static $instances = array();
//put your code here
    public function __construct() {
        $this->uri = ECPFactory::getURI();
        $this->state = "inactive";
    } 
    
    public static function getInstance($client="default"){
        if(empty(self::$instances[$client])){
            $classname = "ECP_Router";
           if($client!=="default"){
               ecpimport("application.router.{$client}");
               $classname .= $client;
           } 
           self::$instances[$client] = new $classname();
        }
        return self::$instances[$client];
    }
    
    /**
     * Returns the router state
     * @return string the state "inactive, parsed, dispatched, changed, error"
     */
    public function getState(){
        return $this->state;
    }
    
    /**
     * Parse the URI
     * @return boolean true on succes
     */
    public function parse(){
        $retval = $this->uri->parse();
        $this->state = ($retval) ? "parsed" : "error";
        return $retval;
    }
    
    /**
     * Dispatch from URI (load the components)
     * @return boolean true on succes
     */
    public function dispatch(){
        //do dispatching
        if($this->state==="parsed"){ 
            $component = $this->uri->getComponent();
            $command = $this->uri->getCommand();
            if(!ecplocate("components.".$component.".".$component)){
                $component = "error"; $command = "unknown_component";
            }
            ecpimport("components.componentcontroller");//load the component interface!
            ecpimport("components.".$component.".".$component);
            $componentname = "ECP_Comp_".ucwords($component)."_Controller";
            if(class_exists($componentname)){
                $this->controller = new $componentname();
                $this->controller->command($command);
                $varr = $this->uri->getVars();
                array_pop($varr);
                $this->controller->params($varr);
                $this->controller->execute();
            }else{
                parent::addError("ECP_ROUTER::dispatch() - Couldn't open component because classname didn't exist. Component classnames wrong?");
                return false;
            }
            return true;
        }else{
            parent::addError("ECP_ROUTER::dispatch() - Can't dispatch because uri isn't parsed yet!");
            return false;
        }
    }
    
    public function setURI($uri){
        if($this->state==="parsed"){
            $this->uri->setURI($uri);
            $this->state = "changed";
            return true;
        }else{
            parent::addError("ECP_Router::setURI() - Can't set a new uri because the old one isn't parsed yet!");
        }
    }
    
    public function getUserId(){
        if($_SERVER['REQUEST_METHOD']==="POST"){ //in elke post method zit de uid erbij! (normaal)
            if(array_key_exists("uid", $_POST)){ //dus hier ligt de voorwaarde via post ook vast!
                return $_POST['uid'];
            }else{
                return null;
            }
        }
        if($this->state === "parsed"){
            return $this->uri->getUserId();
        }else{
            parent::addError("ECP_ROUTER::getUser() - couldn't return UserId because URI isn't parsed yet!");
            return 0;
        }
    }

}

?>
