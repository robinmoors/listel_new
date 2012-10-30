<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database class of EcarePlan System
 * @version 1.0
 * @package framework
 * @subpackage database
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Database extends ECP_Object{
    private static $_debug=false;
    private $querys = array();
   
    private static $_db = null;
    private static $_pasw = null;
    private static $_user = null;
    private static $_host = null;
    private static $_prefix = null;
    private $_conf = null;
    private $con = null;
    
    public function __CONSTRUCT($options,$conf=array()){
        ecpimport("database.query");
        $this->_conf = $conf;
        self::$_prefix = array_key_exists("prefix", $options) ? $options["prefix"] : "e_";
        $this->_conf['prefix']=self::$_prefix;
        self::$_host = array_key_exists("host", $options) ? $options["host"] : "localhost";
        if(!array_key_exists("user",$options) || !array_key_exists("password",$options) || !array_key_exists("database",$options)){
            $this->addError("ECP_DATABASE CONSTRUCTOR");
        }else{
            self::$_user = $options["user"]; self::$_pasw = $options['password']; self::$_db = $options['database'];
        }
        $this->con = mysql_connect(self::$_host, self::$_user,self::$_pasw);
        mysql_select_db(self::$_db,$this->con);
    }
     /**
     * Update Array with configuration parameters
     * @param array $options 
     */
    public function updateRestrictions($options){
        $this->_conf = $options;
        $this->_conf['prefix']=self::$_prefix;
    }
    /**
     * Create new queryobject and return it to obtain chainability
     * @param type $action Mysql Action (select,update,insert into,...)
     * @param type $name If given: the name of the object
     * @return type EQDatabaseQuery Object
     */
    public function newQuery($action,$name=null){
        $name = isset($name) ? $name : count($this->querys);
        $this->querys[$name] = new ECP_DatabaseQuery($action,$this->_conf);
        return $this->querys[$name];
    }
    
    /**
     * @param $options array with databaseconfig parameters
     * @param $conf array with queryrestrictions
     * @return EQDatabase 
     */
    public static function getInstance($options = array(),$conf = array()){
        return new ECP_Database($options,$conf);
    }
    public function debug($b){
        self::$_debug = $b;
        $this->_conf["debug"] = $b;
    }
    
    public function __DESTRUCT() {
        mysql_close($this->con);
        return true;
    }
}

?>