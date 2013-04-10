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
    /**
     * Het uit te voeren commando (invoer)
     * @param string $command Functienaam van het commando
     */
    public function command($command);
    
    /**
     * Standaard commando, wordt aangeroepen indien er geen commando werd meegegeven.
     */
    public function std_command();
    
    /**
     * Wordt aangeroepen wanneer er een ongeldig commando werd meegegeven
     */
    public function command_error();
    /**
     * Parameter invoer als array (invoer)
     * @param Array $vars array met meegegeven parameters
     */
    public function params($vars);
    /**
     * Laat de controller zijn werk doen! (wordt aangeroepen nadat alle gegevens zijn ingevoerd)
     */
    public function execute();
}

?>
