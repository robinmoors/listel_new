<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller for Error component
 * > This component shows 404 and 500 errors
 * @author robindell
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
class ECP_Comp_Error_Controller implements ECP_ComponentController{
    protected $action = null;
    protected $vars = null;
    protected $model = null;
    
    public function __CONSTRUCT(){
        ecpimport("components.error.error.error");
        $this->model = new ECP_Comp_Error_Model();
        $this->action = "std_command";
    }
    
    public function command($command){
        if($command !="command" || !is_callable(array(&$this,$command))){
            $command = "command_error";
        }
        $this->action = $command;
    }

    public function command_error() {
        $this->model->serverError();
    }
    public function std_command(){
        $this->model->example();
    }
    
    public function execute() {
        call_user_func(array(&$this,$this->action));
    }

    public function params($vars) {
        $this->vars = $vars;
    }
    
    public function unsafe_url(){
        //when component-tag was unsafe :(
        $this->model->wrongUrl();
    }
    
    public function unsafe_command_url(){
        //when command-tag was unsafe :(
        $this->model->wrongUrl();
    }
    
    public function error_example(){
        //when error component was called by url :)
        $this->model->example();
    }
    
    public function unknown_component(){
        //when a component was not found :(
        $this->model->wrongUrl();
    }
    
}

?>
