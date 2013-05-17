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
    private $guest;
    private $user = 0;
    private $locked = true;
    
    private $typeobj = null;

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
        //echo "$identifier == identifier";
        if($identifier == "null" || $identifier == "") $identifier = 0;
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
     * 
     * @see getId()
     */
    public function getUserId(){
        return $this->getId();
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
    public function __get($name) {
        if(!is_array($this->user))
            return null;
        if(array_key_exists($name, $this->user)){
            return $this->user[$name];
        }else{
            $name = ucwords(strtolower($name));
            if(array_key_exists($name, $this->user)){
                return $this->user[$name];
            }else{
                return null;
            }
        }
    }
    
    public function setUser($id){
        $db = ECPFactory::getDbo();
        
        $user = $db->newQuery("select","user")->table("logins")->where("id",$id,"=")->execute();
        if($user->getRows()){
            $u = $user->getSingleResult();
            $this->guest = false;
            $this->id = $id;
            $u['profiel'] = strtolower($u['profiel']);
            $this->user = $u;
            ecpimport("user.usertype"); //usertype interface
            if(ecplocate("user.types.{$u['profiel']}")){
                ecpimport("user.types.{$u['profiel']}"); //usertype class
                $classname = "ECP_User_".$u['profiel'];
                $this->typeobj = new $classname();
            }else{
                echo "fatal error.. usertype unknown<br/>Missing type is: {$u['profiel']}";
                ecpexit();
            }$this->locked = 1;
        }else{
            $this->guest = 1;
            $this->locked = 1;
            $this->user = array("naam"=>"Gast","type"=>"Guest");
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
        if($session->getState()==="unvalidated" || $session->getState()==="postunvalidated"){
            $this->guest = 1;
            $this->locked = 1;
            $this->user = array("naam"=>"Gast","type"=>"Guest");
        }
    }
    
    public function filterPatients($results=array()){
        if(count($results)<1 || !is_array($results)) return null;
        else if($this->guest == 1) return array();
        else if($this->typeobj === null) return array();
        else return $this->typeobj->filterPatients($results);
    }

}

?>
