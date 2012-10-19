<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Router klasse voor EcarePlan App
 * @version 1.0
 * @package core
 * @subpackage template
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
class ECP_Router extends ECP_Object{
    private $commands = array();
//put your code here
    public function __construct() {
        $requestURI = explode('/', $_SERVER['REQUEST_URI']);
        $scriptName = explode('/',$_SERVER['SCRIPT_NAME']);

        for ($i = 0; $i < sizeof($scriptName); $i++) {
            if ($requestURI[$i] == $scriptName[$i]) {
                unset($requestURI[$i]);
            }
        }
        $this->commands = array_values($requestURI);
    }
    
    public function getCommands(){
        return $this->commands;
    }
    
    public function getDocType(){
        return $this->commands[0];
    }
    
    public function getEvent(){
        return $this->commands[1];
    }
    
    public function getParameter(){
        return $this->commands[2];
    }
    
    public function isNormalUrl(){
        if(count($this->commands) == 3){
            return true;
        }else return false;
    }
    

}

?>
