<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Factory of EcarePlan
 * @version 1.0
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
abstract class ECPFactory
{
    //alles static! ook variables en methoden!
    public static $app = null;
    public static $conf = null;
    public static $db = null;
    public static $template = null;
    public static $email = null;

    /**
     * Geef het EQApp object door, als het nog niet bestaat: maak het object
     * Het object zal maar 1x aangemaakt worden.
     * @param string $id            ClientID
     * @return Object EQApp 
     */
    public static function getApp($id=null){
        if(!self::$app){
            ecpimport("application.application");
            //if(!$arg) //maak grote error
            self::$app = ECP_App::getInstance($id);
        }
        return self::$app;
    }
    /**
     * Get a database object
     *
     * Returns the global {@link EQDatabase} object, only creating it
     * if it doesn't already exist.
     * @param array $conf array with configparameters
     *
     * @return EQDatabase object
     */
    public static function getDbo($conf = array())
    {
            if (!self::$db) {
                    self::$db = self::_createDbo($conf);
            }
            return self::$db;
    }
    
    /**
     * Get a template object (replaces the jsonobjects)
     * @param string $templatefile TemplateObject to be created
     * @return object EQTemplate 
     */
    public static function getTemplate($templatefile){
        if(!self::$template){
            ecpimport("template.template");
            self::$template = ECP_Template::getInstance($templatefile);
        }
        return self::$template;
    }
    
    /**
     * Get a json object (replaces the templateobjects)
     * @param string $templatefile JsonObject to be created
     * @return object EQJSON 
     */
     public static function getJSON($templatefile){
        if(!self::$template){
            ecpimport("json.json");
            self::$template = ECP_JSON::getInstance($templatefile);
        }
        return self::$template;
    }
    
     /**
     * Get a mail object 
     * @param string $mailtype mailer to be created
     * @return object EQMail
     */
     public static function getMailer($mailtype){
        if(!self::$email){
            ecpimport("mail.mail");
            self::$email = ECP_Mail::getInstance($mailtype);
        }
        return self::$email;
    }
    /**
     * Get a configuration object
     *
     * Returns the global {@link EQConfig} object, only creating it
     * if it doesn't already exist.
     *
     *
     * @return EQConfig object
     */
    public static function getConfig()
    {
            if (!self::$conf) {
                    self::$conf = self::_createConfig();
            }
            return self::$conf;
    }
        
    /**
     * Create an database object
     *
     * @return EQDatabase object
     *
     * @since 1.0
     */
    private static function _createDbo($arconf = array())
    {
            ecpimport('database.database');
            $conf = self::getConfig();
            $host		= $conf->host;
            $user	= $conf->user;
            $password	= $conf->password;
            $database	= $conf->db;
            $prefix	= $conf->dbprefix;
            $debug	= $conf->debug;

            $options	= array ('host' => $host, 'user' => $user, 'password' => $password, 'database' => $database, 'prefix' => $prefix);
            $db = ECP_Database::getInstance($options,$arconf);

            //ERROR handling here

            $db->debug($debug);
            return $db;
    }
    /**
     * Create a configuration object
     *
     * @return EQConfig object
     * @since 1.0
     */
    private static function _createConfig()
    {
        ecpimport('includes.configuration');
        return new ECPConfig();
    }

}
