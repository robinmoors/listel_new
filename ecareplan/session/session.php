<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Session class of EcarePlan System
 * @version 1.0
 * @package Framework
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Session extends ECP_Object {
    
    public static $user;
    private $password;
    private $username;
    private $sid;
    private $uid;
    private $params;
    private $options;

    /**
     * @var    ECP_Session  ECP_Session instances container.
     */
    protected static $instance;

    public function __CONSTRUCT($options = array()) {
        $this->options = $options;
        // Disable transparent sid support
        ini_set('session.use_trans_sid', '0');

        // Only allow the session ID to come from cookies and nothing else.
        // dus niet van url's of zo...
        ini_set('session.use_only_cookies', '1');
        
        session_start();
        // check for login sessions to fork with
        // or for a valid user session
        // and if not.. make all sessions invalid
        if(self::isUserSession()){
            //vernieuwen of controleren van lopende sessie
        }elseif(self::isLoginSession()){
            //forken
        }else{
            //sessie ingeldig maken en het systeem laten weten dat we geen sessie hebben :(
            //session_unset(); session_destroy(); enzo..
            // en dan starten we een "guest" sessie :) en normaal trigert dit een loginform!
        }
    }
    
    public function isLoginSession(){
        if(isset($_SESSION['loginapp']) && isset($_SESSION['appkey'])){
            //TODO hier sessie gaan valideren adhv loginapp en appkey
            return true;
        }else return false;
    }
    
    public function isUserSession(){
        // hier gaan controleren welke velden er in $_Session zitten
        return false;        
    }

    /**
     * Magic method to get read-only access to properties.
     * @param   string  $name  Name of property to retrieve
     * @return  mixed   The value of the property
     */
    public function __get($name) {
        if ($name === 'storeName') {
            return $this->$name;
        }

        if ($name === 'state' || $name === 'expire') {
            $property = '_' . $name;
            return $this->$property;
        }
    }

    /**
     * Returns the global Session object, only creating it
     * if it doesn't already exist.
     * @param   string  $handler  The type of session handler.
     * @param   array   $options  An array of configuration options.
     *
     */
    public static function getInstance($options) {
        if (!is_object(self::$instance)) {
            self::$instance = new ECP_Session($options);
        }

        return self::$instance;
    }

}

?>
