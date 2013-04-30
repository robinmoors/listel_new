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

    /**
     * Session State
     * @see getState()
     * @var string sessionstate 
     */
    protected $_state = 'inactive';

    /**
     * Expiretime of the session in minutes
     * @var int minutes
     * @see getExpire()
     */
    protected $_expire = 15;

    private $options;
    
    private $user;
    
    private $db;
    
    private $session;


    /**
     * @var    ECP_Session  ECP_Session instances container.
     */
    protected static $instance;

    public function __CONSTRUCT($options = array()) {
        $this->options = $options;
        $this->_state = 'inactive';
        
        $this->_expire = $options['expire'];
    }

    private function startGuest() {
        $this->session = "guest";
        $this->_state = "guest";
    }

    private function isUserSession() {
        // hier gaan controleren welke velden er in $_Session zitten
        return false;
    }

    /**
     * Get the time until the session expires
     * @param boolean true if time needs to be in seconds false in minutes
     * @return int time in minutes (default) or seconds
     */
    public function getExpire($seconds = false) {
        if ($seconds)
            return $this->_expire * 60;
        else
            return $this->_expire;
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

    /**
     * Returns the state of the session. Values:
     * inactive when not started or restarted(default),
     * active when validated,
     * unvalidated when started,
     * expired,restart,
     * destroyed when stopped,
     * empty when creating of storage failed,
     * error when validation failed.
     * @return sessionstate
     */
    public function getState() {
        return $this->_state;
    }

    /**
     * Checks if session state is active
     * @return boolean True when is active
     */
    public function isActive() {
        return (bool) ($this->_state === 'active');
    }

    /**
     * Starts a session
     * 
     * @return boolean True when done
     */
    public function start() {
        if ($this->_state === 'active') {
            return true; //session already started
        }
        $this->user = ECPFactory::getApp()->getUser();
        if(!$this->user->isGuest()){
            $this->_state = "starting"; //moet omdat anders userclass niks gaat teruggeven!
            $this->session = $this->user->getUser();
            $this->_state = "unvalidated"; //moet omdat anders userclass niet naar guest kan overgaan!
            $this->validate();
        }else{
            $this->startGuest();
        }

        // hier eventuele dispatchers als we dat gaan gebruiken...
        return true;
    }

    public function restart() {
        $this->destroy();
        if ($this->_state !== 'destroyed') {
            parent::addError("ECP_Session::restart - Session seems not be destroyed, so can't restart the session.");
            return false;
        }
        $this->_state = 'restart';
        $this->_start();
        $this->_state = 'active';

        $this->_validate();
        $this->_setCounter();

        return true;
    }
    
    public function validate(){
        if($this->_state === "unvalidated"){
            $ip = $_SERVER['REMOTE_ADDR'];
            if($ip!=$this->session['ipadres']){
                //echo "terug gast want~$ip~{$this->session['ipadres']}";
                $this->user->setGuest();
                $this->_state = "error";
            }else{
                //sessie geldig nu ffe kijken of hij niet verlopen is...
                $this->_state = "active";
            }
        }else{
            return true;
        }
    }
    
    public function sessionToken(){
        if($this->_state!=="guest") return false;
        if($this->_state!=="error") return 0;
        $this->_state = "postunvalidated";
        if(array_key_exists("pin", $_POST)){
            ecpimport("helpers.cryptology");
            $pinhash = ECP_Cryptology::generateHash($_POST['pin']);
            if($pinhash!==$this->session['loginpin']){
                $this->user->setGuest();
                return false;
            }else{
                //pin update?
                $this->_state = "active";
                return true; //hier normaal nieuwe pin teruggeven..
            }
        }else{
            $this->_state = "error";
            return 0;
        }
    }

}

?>
