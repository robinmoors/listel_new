<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * User class of EcarePlan System
 * @version 1.0
 * @package Framework
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_User extends ECP_Object {

    //put your code here
    private $id = null;
    private $type = null;
    private $name = null;
    private $username = null;
    private $password = null;
    private $guest;
    private $user = 0;
    private $locked = true;

    /**
     * User parameters
     * @var    JRegistry
     * @since  11.1
     */
    protected $_params = null;

    /**
     * @var    array  ECP_User instances container.
     */
    protected static $instances = array();

    public function __construct($identifier = 0) {
        // Create the user parameters object
        //$this->_params = new JRegistry;
            // Initialise
            $this->id = 0;
            $this->sendEmail = 0;
            $this->aid = 0;
            $this->guest = 1;
            $this->locked = true;
    }

    /**
     * Returns the global User object, only creating it if it
     * doesn't already exist.
     *
     * @param   integer  $identifier  The user to load - Can be an integer or string - If string, it is converted to ID automatically.
     *
     * @return  JUser  The User object.
     *
     * @since   11.1
     */
    public static function getInstance($identifier = 0) {
        // Find the user id 
        if (!is_numeric($identifier)) {
            //TODO helper maken of functie die via de username de user gaat ophalen
                parent::addError("ECP_User getInstance::User doesn't exist.");
                return false;
        } else {
            $id = $identifier;
        }

        // If the $id is zero, just return an empty ECP_User.
        // Note: don't cache this user because it'll have a new ID on save!
        if ($id === 0) {
            return new ECP_User;
        }

        // Check if the user ID is already cached.
        if (empty(self::$instances[$id])) {
            $user = new ECP_User($id);
            self::$instances[$id] = $user;
        }

        return self::$instances[$id];
    }

    /**
     * Return ID of user
     * @return $UID integer
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * Tell if session is guest!
     * @return boolean true if guest
     */
    public function isGuest(){
        if($this->guest) return true;
        else return false;
    }
    
    /**
     * Return the name of the user
     * @return username !guest if guestsession!
     */
    public function getName(){
        if($this->isGuest()) return "guest";
        return $this->name;
    }
    
    public function setUser($id){
        $db = ECPFactory::getDbo();
        $user = $db->newQuery("select","user")->table("users")->where("UID",$id,"=")->execute();
        if($user->getRows()){
            $u = $user->getSingleResult();
            $this->guest = false;
            $this->id = $id;
            $this->user = $u;
            $this->locked = 1;
        }else{
            $this->guest = 1;
            $this->locked = 1;
        }
    }
    /**
     * Return Userdata from database
     * Can only be done by sessionclass (when starting)
     * @return Array with userdata or null when negative
     */
    public function getUser(){
        $session= ECPFactory::getSession();
        if($session->getState()==="starting")
            return $this->user;
        else return null;
    }
    /**
     * Set user to guest -> can only be done from session class! (when validating)
     */
    public function setGuest(){
        $session= ECPFactory::getSession();
        if($session->getState()==="unvalidated"){
            $this->guest = 1;
            $this->locked = 1;
            $this->user = null;
        }
    }

}

?>
