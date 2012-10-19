<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Basis klasse voor EcarePlan App
 * @version 1.0
 * @package core
 * @subpackage template
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
class ECP_App extends ECP_Object {
    
    protected $conf = null;
    protected static $_id = null;
    protected $output ='{"error":"empty","response":"rejected","action":"end","message":"Geen inhoud gevonden"}';
    protected $templatedata = array();
    protected $router;

    /**
     * Class constructor.
     *
     * @param	string	$id	A client identifier.
     * @since	1.0
     */
    public function __construct($id) {
        $this->conf = ECPFactory::getConfig();
        self::$_id=$id;
    }
    /**
     * Returns an object of EQApp from the right $id
     * @param type $id Clientname
     */
    public static function getInstance($id){
        static $instances;
        if(!isset($instances)){
            $instances = array();
        }
        if(empty($instances[$id])){
            $prefix = "ECP_";
            $classname = $id;
            if(ecpimport("application.".strtolower($classname)."_app")){
                $classname = $prefix.$id;
                $instance =  new $classname($id);
            }else{
                parent::addError("ECPApp::getInstance");
                $instance = "";
            }
            $instances[$id] = &$instance;
        }
        return $instances[$id];
    }
     /**
     * Initialise the application.
     *
     * @param	array An optional associative array of configuration settings.
     * @since	1.0
     */
    public function initialise() {
    }

    /**
     * Laad onderdelen in en duw ze in een template
     *
     * @since	1.0
     */
    protected function build() {
        //inlezen welke site, pagina, optie geladen is of welke opdracht uitgevoerd moet worden
        //benodigde files inladen en openen
    }
    
    protected function route(){
        if(ecpimport('application.router')){
            $this->router = new ECP_Router();
        }else{
            parent::addError("ECPApp::getRouter");
            $this->router = new stdClass();
        }
    }
    /**
     * Create the templatedata wich a template reads to add content.
     * @param array $data could be a query from sitestable
     */
    protected function createTemplateData($data){
        
    }
    /**
     * Exit the application.
     *
     * @param	int	Exit code
     * @since	1.0
     */
    public function close($code = 0) {
        exit($code);
    }

    
/**
 * Create queryrestrictions
 * @return $conf array with restrictions
 */
    protected function getDbRestrictions($conf=null){
        if(is_null($conf)){
            $conf = array();
            $conf["permissionlevel"] = 1;
            $conf["select"] = true;
        }else{
            $conf["select"]= true;
        }
        return $conf;
    }

    /**
     * Returns the response
     * Hier wordt het proces beëindigd!
     *
     * @return	string
     * @since	1.0
     */
    public function __toString() {
        if($this->output != "")
            return $this->output;
        else parent::__toString ();
    }
    
    /**
     * Json parser
     * @param string $json
     * @return json
     */
    public function jsonparse($json){
        return json_encode($json,JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP);
    }
     /**
     * Json DEparser
     * @param string $json
     * @return decoded json
     */
    public function jsonDeparse($json){
        return json_decode($json,true);
    }
    
    protected function matchReg($string,$specialmatch){
        if($specialmatch){
            switch($specialmatch){
                case "datestamp": $r = '/(19|20)\d\d(-)(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])/'; break;
                default: $r = $specialmatch; break;
            }
            return preg_match($r,$string);
        }else return false;
    }
    
}
?>