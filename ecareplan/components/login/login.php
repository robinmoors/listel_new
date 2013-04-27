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
        if($command=="command" || !is_callable(array(&$this,$command))){
            $command = "command_error";
        }
        $this->action = $command;
    }

    public function command_error() {
        if($_SERVER['REQUEST_METHOD']=="POST"){
            echo '{"succes":"negative","reason":"unknown request","error":"404"}';
            exit();
        }
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
        
    public function login(){
     //   if($_SERVER['REQUEST_METHOD']=="POST"){
            $form = ECPFactory::getForm("login");
            $form->smartInsert($_POST);
            $rapport = $form->validate();
            /*if(is_array($rapport)){
                echo '{"error":"'.$rapport[0][0].'"}'; //eerste index:: 1. velden met fouten, 2. fout per veld, 3. aantal fouten totaal.
                exit(); //geen view doen :)
            }else{*/
                //this in orde dus hier iets met model gaan doen
                $login = $this->model->login();
                if(!$login){
                    echo '{"succes":"negative","reason":"no-access"}';
                    exit();
                }elseif($login===2){
                    echo '{"succes":"negavive","reason":"database"}';
                    exit();
                }else{
                    echo '{"succes":"positive","uid":"'.$login["uid"].'","pin":"'.$login["pin"].'"}';
                    exit();
                }
            //}
       // }else{
       //     $this->std_command();
       // }
        
    }
    
}

?>
