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
    protected $view = null;
    protected $app = null;
    protected $user = null;

    public function __CONSTRUCT() {
        ecpimport("components.overleg.overlegmodel");
        ecpimport("components.overleg.overlegview");
        $this->action = "std_command";
        $this->app = ECPFactory::getApp(); //haal de app op om template te gaan veranderen
        $this->user = $this->app->getUser(); //via de app de user ophalen zodat we zeker de huidige user hebben :)
        $this->model = new ECP_Comp_OverlegModel($this->user->getUserId());
        $this->view = new ECP_Comp_OverlegView($this->app);
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
        $patienten = $this->model->getPatients();
        $this->view->viewList($patienten);
    }
    
    public function bewerk(){
        if(!is_null($this->vars[1])){
            $patient = $this->model->getOverleg($this->vars[1]);
            ecpimport("components.overleg.base.overlegform");
            $formmodel = new ECP_Comp_OverlegForm();
            $this->view->editOverleg($patient,$formmodel->getForm());
        }else{
            $this->std_command();
        }
    }

}

?>
