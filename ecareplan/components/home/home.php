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
class ECP_Comp_Home_Controller implements ECP_ComponentController{
    protected $model = null;
    protected $action = null;
    protected $vars = null;
    
    public function __CONSTRUCT(){
        ecpimport("components.home.home.model");
        $this->model = new ECP_Comp_Home_Model();
    }
    
    public function command($command) {
        $this->action = "std_command";
    }

    public function command_error() {
        $this->std_command();
    }

    public function execute() {
        $this->std_command();
    }

    public function params($vars) {
        $this->vars = $vars;
    }

    public function std_command() {
        $this->model->showWelcome();
    }
    
    public function welkom(){
        $this->model->showWelcome();
    }
}
?>
