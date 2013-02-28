<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of overleg
 *
 * @author robindell
 */
class ECP_Comp_Overleg_Controller implements ECP_ComponentController {

    protected $action = null;
    protected $vars = null;
    protected $model = null;
    protected $app = null;
    protected $user = null;

    public function __CONSTRUCT() {
        ecpimport("components.overleg.overlegmodel");
        $this->model = null;
        $this->action = "std_command";
    }

    public function command($command) {
        if($command =="command" || !is_callable(array(&$this,$command))){
            $command = "command_error";
        }
        $this->action = $command;
    }

    public function command_error() {
        $this->std_command();
    }

    public function execute() {
        call_user_func(array(&$this,$this->action));
    }

    public function params($vars) {
        $this->vars = $vars;
    }
    
    public function lijst(){
        $this->std_command();
    }

    public function std_command() {
        $this->app = ECPFactory::getApp(); //haal de app op om template te gaan veranderen
        $this->user = $this->app->getUser();
        $this->model = new ECP_Comp_OverlegModel($this->user->getUserId());
        $data = $this->model->get();
        
    }

}

?>
