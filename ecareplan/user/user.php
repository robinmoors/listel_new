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
    public $id = null;
    private $type = null;
    public $name = null;
    public $username = null;
    public $password = null;
    public $guest = 1;

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

        // Load the user if it exists
        if (!empty($identifier)) {
            $this->load($identifier);
        } else {
            // Initialise
            $this->id = 0;
            $this->sendEmail = 0;
            $this->aid = 0;
            $this->guest = 1;
        }
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
            if (!$id = JUserHelper::getUserId($identifier)) {
                parent::addError("ECP_User getInstance::User doesn't exist.");
                return false;
            }
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
     * Method to load a ECP_User object by user id number
     *
     * @param   mixed  $id  The user id of the user to load
     *
     * @return  boolean  True on success
     *
     */
    public function load($id) {
        // Create the user table object
        ////////TODO hier database klaarmaken om user op te halen... $table = $this->getTable();

//        // Load the ECP_UserModel object based on the user id or throw a warning.
//        if (!$table->load($id)) {
//            // Reset to guest user
//            $this->guest = 1;
//            parent::addError('ECP_User load::Not able to load user');
//            return false;
//        }

        /*
         * Set the user parameters using the default XML file.  We might want to
         * extend this in the future to allow for the ability to have custom
         * user parameters, but for right now we'll leave it how it is.
         */

        //loadstring komt van een registry die hebben we niet nodig eh!!! $this->_params->loadString($table->params);

        // Assuming all is well at this point let's bind the data
        $this->setProperties($table->getProperties());

        // The user is no longer a guest
        if ($this->id != 0) {
            $this->guest = 0;
        } else {
            $this->guest = 1;
        }

        return true;
    }
    
    public function getType(){
        switch($this->type){
            case 1: "OC"; break;
            case 2: "Listel"; break;
            case 3: "Hoofdproject"; break;
            case 4: "Bijkomend Project"; break;
            case 5: "CAW"; break;
            case 6: "RDC"; break;
            case 7: "Menos"; break;
            case 8: "Ziekenhuis"; break;
            case 9: "Psy"; break;
            default: "Gast"; break;
        }
    }

}

?>
