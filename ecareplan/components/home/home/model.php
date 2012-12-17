<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_Home_Model {
    
    protected $app;
    
    
    public function __CONSTRUCT(){
        $this->app = ECPFactory::getApp();
    }
    
    public function showWelcome(){
        $this->app->setTemplate("listel");
    }
}

?>