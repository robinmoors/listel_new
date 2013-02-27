<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller for Login component
 * @author Robin Moors
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
class ECP_Comp_Login_Controller implements ECP_ComponentController{
    protected $action = null;
    protected $vars = null;
    protected $model = null;
    protected $app = null;
    
    public function __CONSTRUCT(){
        ecpimport("components.login.model");
        $this->model = new ECP_Comp_Login_Model();
        $this->action = "std_command";
    }
    
    public function command($command){
        if($command!="command" || !is_callable(array(&$this,$command))){
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
    
    /* Commands */
    public function std_command(){
        $this->app = ECPFactory::getApp(); //haal de app op zodat we de template kunnen wijzigen!
        $tdata = $this->model->loginpage();
        $this->app->setTemplate('login');
        $this->app->setTemplateData($tdata);
    }
    
    public function register(){
        $this->app = ECPFactory::getApp(); //haal de app op zodat we de template kunnen wijzigen!
        $this->app->setTemplate("login");
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if($this->model->register('valid',$_POST))
                //generation of id here!!
                $this->model->register('succes',$_POST);
            else
                $this->model->register('false',$_POST);
        }else{
            $this->model->loginpage();
        }
    }
    
    public function login(){
        $this->app = ECPFactory::getApp(); //haal de app op zodat we de template kunnen wijzigen!
        $this->app->setTemplate("login");
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if($this->model->login('valid',$_POST))
                //generation of id here!!
                $this->model->login('succes',$_POST);
            else
                $this->model->login('false',$_POST);
        }else{
            $this->model->loginpage();
        }
    }
    
}

?>
