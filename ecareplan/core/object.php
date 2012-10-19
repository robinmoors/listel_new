<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Core class Object
 * @version 1.0
 * @package core
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Object {

    protected $errors=array();
    private $properties;

    protected function addError($error) {
        $this->errors[count($this->errors)] = $error;
    }

    /**
     * Class constructor, overridden in descendant classes.
     *
     * @param	mixed $properties	Either and associative array or another object to set the initial properties of the object.
     * @since	1.0
     */
    public function __construct($properties = null) {
        if ($properties !== null) {
            $this->properties = $properties;
        }
    }

    /**
     * Magic method to convert the object to a string gracefully.
     *
     * @return	string	The classname.
     * @since	1.0
     */
    public function __toString() {
        return "oeps! Er gaat iets grandioos mis. Er moest hier een mooi tekstje komen :(";
    }

    /**
     * Kijkt of er fouten zijn gebeurt tijdens het aanmaken van de template
     * @return boolean true= geen fouten, false = fout(en)
     */
    public function succes() {
        if (count($this->errors) == 0)
            return true;
        else
            return false;
    }

}

?>
