<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author robindell
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
interface ECP_ComponentController {
    public function command($command);
    public function std_command();
    public function command_error();
    public function params($vars);
    public function execute();
}

?>
