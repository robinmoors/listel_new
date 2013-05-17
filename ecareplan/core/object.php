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

    protected static $errors = array();
    private $properties;

    protected static function addError($error) {
        self::$errors[count(self::$errors)] = $error;
    }
    protected static function getErrors(){
        return self::$errors;
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

    /**
     * Returns a property of the object or the default value if the property is not set.
     *
     * @param   string  $property  The name of the property.
     * @param   mixed   $default   The default value.
     *
     * @return  mixed    The value of the property.
     *
     *
     * @see     getProperties()
     */
    public function get($property, $default = null) {
        if (isset($this->$property)) {
            return $this->$property;
        }
        return $default;
    }

    /**
     * Returns an associative array of object properties.
     *
     * @param   boolean  $public  If true, returns only the public properties.
     *
     * @return  array
     *
     *
     * @see     get()
     */
    public function getProperties($public = true) {
        $vars = get_object_vars($this);
        if ($public) {
            foreach ($vars as $key => $value) {
                if ('_' == substr($key, 0, 1)) {
                    unset($vars[$key]);
                }
            }
        }

        return $vars;
    }

    /**
     * Modifies a property of the object, creating it if it does not already exist.
     *
     * @param   string  $property  The name of the property.
     * @param   mixed   $value     The value of the property to set.
     *
     * @return  mixed  Previous value of the property.
     *
     * @since   11.1
     */
    public function set($property, $value = null) {
        $previous = isset($this->$property) ? $this->$property : null;
        $this->$property = $value;
        return $previous;
    }

    /**
     * Set the object properties based on a named array/hash.
     *
     * @param   mixed  $properties  Either an associative array or another object.
     *
     * @return  boolean
     *
     *
     * @see     set()
     */
    public function setProperties($properties) {
        if (is_array($properties) || is_object($properties)) {
            foreach ((array) $properties as $k => $v) {
                // Use the set function which might be overridden.
                $this->set($k, $v);
            }
            return true;
        }

        return false;
    }

}

?>
