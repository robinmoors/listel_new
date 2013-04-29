<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ocmw
 *
 * @author robindell
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
class ECP_User_RDC implements ECP_UserType{
    //put your code here
    
    /* Start implement Usertype */
    public static function filterPatient(array $results) {
        return $results;
    }    
    /* End implement Usertype */
}

?>
