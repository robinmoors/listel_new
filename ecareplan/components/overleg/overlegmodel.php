<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OverlegModel {

    protected $db = null;
    protected $uid = 0;

    public function __CONSTRUCT($uid) {
        $this->uid = $uid;
        $this->db = ECPFactory::getDbo();
    }

    public function get($limit = 30, $from = 0, $to = 30){
        $user = ECPFactory::getUser($this->uid);
        $patients = $this->db->newQuery("select","patients")->table("patient")->where("gem_id",$user->gem_id,"=")->execute();
        echo $patients->getRows();
    }

}

?>
