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


    /**
     * @var    ECP_Session  ECP_Session instances container.
     */
    protected static $instance;

    public function __CONSTRUCT($options = array()) {
        $this->options = $options;
        $this->_state = 'inactive';
        // Disable transparent sid support
        ini_set('session.use_trans_sid', '0');

        // Only allow the session ID to come from cookies and nothing else.
        // dus niet van url's of zo...
        ini_set('session.use_only_cookies', '1');
        
        $this->_expire = $options['expire'];
    }

    private function startGuest() {
        if (self::_createSessionStore())
            $this->start();
        else {
            parent::addError("ECP_Session::startGuest - Failed to create a sessionstore, session state set on error!");
            $this->_state = 'empty';
        }
    }

    private function isLoginSession() {
        if (isset($_SESSION['loginapp']) && isset($_SESSION['appkey'])) {
            //TODO hier sessie gaan valideren adhv loginapp en appkey
            return true;
        }else
            return false;
    }

    private function isUserSession() {
        // hier gaan controleren welke velden er in $_Session zitten
        return false;
    }

    /**
     * Creates a session storage
     * @return boolean True on succes
     */
    protected function _createSessionStore() {
        if ($this->_state !== 'active' && $this->_state !== 'expired') {
            $store = array('session.time.start', 'session.time.last', 'session.time.now', 'session.counter', 'session.token');
            $_SESSION['_ecpsession'] = $store;
            return true;
        } else {
            parent::addError("ECP_Session::_createSessionStore - Can't create a sessionstore when a session is active or expired!");
            return false;
        }
    }

    /**
     * Create a token-string
     * @param   integer  $length  Length of string
     * @return  string  Generated token
     */
    protected function _createToken($length = 32) {
        static $chars = '0123456789abcdefABC';
        $max = strlen($chars) - 1;
        $token = '';
        $name = session_name();
        for ($i = 0; $i < $length; ++$i) {
            $token .= $chars[(rand(0, $max))];
        }

        return md5($token . $name);
    }

    /**
     * Sets the counter of session usage
     * @return boolean True when done
     */
    protected function _setCounter() {
        $count = $this->get('session.counter', 0); //gets count value, if isn't set return 0
        $count++;
        $this->set('session.counter', $count);
        return true;
    }

    /**
     * Sets the time of the session
     * Starts timing when start time isn't set
     * @return boolean True when done
     */
    protected function _setTimer() {
        if (!$this->has('session.time.start')) {
            //session not started to time..
            $time = time();
            $this->set('session.time.start', $time);
            $this->set('session.time.last', $time);
            $this->set('session.time.now', $time);
        }

        $this->set('session.time.last', $this->get('session.time.now'));
        $this->set('session.time.now', time());
        return true;
    }

    /**
     * Starts a session or resumes the current one
     * @return boolean True when done
     */
    protected function _start() {
        if ($this->_state === 'restart') {
            session_regenerate_id(true); //new id to be generated when session is restarted
        } else {
            //$session_name = session_name();
            //hier eventueel cookie aanmaken en/of inlezen..
        }

        register_shutdown_function('session_write_close');

        session_cache_limiter('none');
        session_start();

        return true;
    }

    /**
     * Validates a session (several security checks are done)
     * @return boolean True if valid
     */
    protected function _validate() {
        //check if expired
        if($this->_expire){
            $curt = $this->get('session.timer.now',0);
            $maxt = $this->get('session.timer.last',0) + ($this->_expire * 60); //bijde tijden in seconden!
            if($curt > $maxt){
                $this->_state = 'expired';
                return false;
            }
        }
        //extra beveiliging bvb ipadres, browser, ...
        //hier toevoegen!
        return true;
    }

    /**
     * Checks for a formtoken in the request.
     * Needs the input from te request to work!
     * 
     * @param string $method the request method (POST,GET,PUT,...)
     * @return boolean True if valid, false if not
     */
    public static function checkToken($method = 'POST') {
        $token = self::getFormToken();
        $app = ECPFactory::getApplication();
        //moet gaan kijken in de app welke input er gegeven is..
        //indien er nog een is gaan we naar de huidige sessie moeten kijken
        // we zijn static bezig dus moeten we het echte sessie object opvragen
        $session = ECPFactory::getSession();
        // als de sessie nieuw is kan er geen form zijn ingevuld! dus redirect naar login
        // indien niet moeten we nog vragen aan de input of er een token te vinden is
        // en nog kijken of die overeen komen...
        return true;
    }

    /**
     * Magic method to get read-only access to properties.
     * @param   string  $name  Name of property to retrieve
     * @return  mixed   The value of the property
     */
    public function __get($name) {
        if ($name === 'state' || $name === 'expire') {
            $property = '_' . $name;
            return $this->$property;
        }
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
     * Get a formtoken
     * @param boolean $forceNew If true, a new token wil be generated
     * @return string token
     */
    public static function getFormToken($forceNew = false) {
        $user = ECPFactory::getUser();
        $session = ECPFactory::getSession(); //we werken statisch dus...
        return ECP_App::getHash($user->get('id', 0) . $session->getToken($forceNew));
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
     * Get session id - only when session isn't destroyed!
     * @return String session id
     */
    public function getId() {
        if ($this->_state === 'destroyed') {
            parent::addError("ECP_Session::getId - Can't return session id because session is destroyed!");
            return null;
        }
        return session_id();
    }

    /**
     * Get session name - only when session isn't destroyed!
     * @return string session name
     */
    public function getName() {
        if ($this->_state === 'destroyed') {
            parent::addError("ECP_Session::getName - can't return session name because session is destroyed!");
            return null;
        }
        return session_name();
    }

    /**
     * Returns the state of the session. Values:
     * inactive when not started or restarted(default),
     * active when started,
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
     * Get a session token, if a token isn't set yet one will be generated.
     *
     * Tokens are used to secure forms from spamming attacks. Once a token
     * has been generated the system will check the post request to see if
     * it is present, if not it will invalidate the session.
     *
     * @param   boolean  $forceNew  If true, force a new token to be created
     *
     * @return  string  The session token
     *
     */
    public function getToken($forceNew = false) {
        $token = $this->get('session.token');

        // Create a token
        if ($token === null || $forceNew) {
            $token = $this->_createToken(24);
            $this->set('session.token', $token);
        }

        return $token;
    }

    /**
     * Get data from the sessionstore
     * @param string $name Variablename
     * @param mixed $default value to return if variable isn't set
     * @return mixed Value of variablename
     */
    public function get($name, $default = null) {
        if ($this->_state !== 'active' && $this->_state !== 'expired') {
            parent::addError("ECP_Session::get - You can only get something from the sessionstore when a session is expired or active");
            return null;
        }
        $val = isset($_SESSION['_ecpsession'][$name]) ? $_SESSION['_ecpsession'][$name] : $default;
        return $val;
    }
    
    /**
     * Method to determine if a token exists in the session. If not the
     * session will be set to expired
     *
     * @param   string   $tCheck       Hashed token to be verified
     * @param   boolean  $forceExpire  If true, expires the session
     *
     * @return  boolean True on succes.
     */
    public function hasToken($tCheck, $forceExpire = true) {
        // Check if a token exists in the session
        $tStored = $this->get('session.token');

        // Check token
        if (($tStored !== $tCheck)) {
            if ($forceExpire) {
                $this->_state = 'expired';
            }
            return false;
        }

        return true;
    }

    /**
     * Check if variable exist in sessionstore
     * @param string $name
     * @return boolean True if exist (null on error!)
     */
    public function has($name) {
        if ($this->_state !== 'active' && $this->_state !== 'expired') {
            parent::addError("ECP_Session::has - Sessionstore can only have variables if session is active of expired!");
            return null;
        }

        return isset($_SESSION['_ecpsession'][$name]);
    }

    /**
     * Checks if session is new (freshly created)
     * @return boolean True when is new
     */
    public function isNew() {
        $count = $this->get('session.counter');
        return (bool) ($count === 1);
    }

    /**
     * Checks if session state is active
     * @return boolean True when is active
     */
    public function isActive() {
        return (bool) ($this->_state === 'active');
    }

    /**
     * Set data in the sessionstore
     * @param string $name name of the variable to be set
     * @param mixed $value value of the variable
     * @return mixed Old value
     */
    public function set($name, $value) {
        if ($this->_state !== 'active') {
            parent::addError("ECP_Session::set - You can only set something in the sessionstore when a session is active!");
            return null;
        }
        $old = isset($_SESSION['_ecpsession'][$name]) ? $_SESSION['_ecpsession'][$name] : null;
        if ($value === null) {
            unset($_SESSION['_ecpsession'][$name]);
        } else {
            $_SESSION['_ecpsession'][$name] = $value;
        }
        return $old;
    }

    /**
     * Clear a variable from the sessionstore
     * @param string $name variablename
     * @return mixed Value of the cleared variable or null on error or non-exist
     */
    public function clear($name) {
        if ($this->_state !== 'active') {
            parent::addError("ECP_Session::clear - a Sessionstore variable can only be cleared if session is active!");
            return null;
        }

        $val = null;
        if (isset($_SESSION['_ecpsession'][$name])) {
            $val = $_SESSION['_ecpsession'][$name];
            unset($_SESSION['_ecpsession'][$name]);
        }
        return $val;
    }

    /**
     * Destroy a session
     * @return boolean True if done.
     */
    public function destroy() {
        if ($this->_state === 'destroyed') {
            return true;
        }

        //hier mss cookies wegdoen of dergelijke..

        session_unset();
        session_destroy();
        $this->_state = 'destroyed';
        return true;
    }

    /**
     * Forks a running session with a new one
     * @return boolean True on succes.
     */
    public function fork() {
        if ($this->_state !== 'active') {
            parent::addError("ECP_Session::fork - can't fork session because session isn't active.");
            return false;
        }
        //iets doen om te forken
        //zowieso een session_destroy en een regenerate_id
        session_destroy();
        session_regenerate_id(true);

        session_start();
        return true;
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
        $this->_start();
        $this->_state = 'active';

        //initialiseren
        $this->_setTimer();
        $this->_setCounter();
        //beveiliging
        $this->_validate();

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

}

?>
