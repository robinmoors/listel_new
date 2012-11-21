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

abstract class ECPFactory {

    //alles static! ook variables en methoden!
    public static $app = null;
    public static $conf = null;
    public static $db = null;
    public static $template = null;
    public static $email = null;
    public static $session = null;
    public static $user = null;

    /**
     * Geef het EQApp object door, als het nog niet bestaat: maak het object
     * Het object zal maar 1x aangemaakt worden.
     * @param string $id            ClientID
     * @return Object EQApp 
     */
    public static function getApp($id = null) {
        if (!self::$app) {
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
    public static function getDbo($conf = array()) {
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
    public static function getTemplate($templatefile) {
        if (!self::$template) {
            ecpimport("template.template");
            self::$template = ECP_Template::getInstance($templatefile);
        }
        return self::$template;
    }

    /**
     * Get a mail object 
     * @param string $mailtype mailer to be created
     * @return object EQMail
     */
    public static function getMailer($mailtype) {
        if (!self::$email) {
            ecpimport("mail.mail");
            self::$email = ECP_Mail::getInstance($mailtype);
        }
        return self::$email;
    }

    /**
     * Get a session object.
     * @param   array  $options  An array containing session options
     * @return  ECP_Session object
     */
    public static function getSession(array $options = array()) {
        if (!self::$session) {
            self::$session = self::createSession($options);
        }

        return self::$session;
    }

    /**
     * Get an user object.
     * @param   integer  $id  The user to load - Can be an integer or string - If string, it is converted to ID automatically.
     * @return  ECP_User object
     */
    public static function getUser($id = null) {
        ecpimport('user.user');
        $instance = self::getSession()->get('user');

        if (is_null($id)) {
            if (!($instance instanceof ECP_User)) {
                $instance = ECP_User::getInstance();
            }
        } elseif ($instance->id != $id) {
            $instance = ECP_User::getInstance($id);
        }

        return $instance;
    }

    /**
     * Get a configuration object
     *
     *
     * @return EQConfig object
     */
    public static function getConfig() {
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
    private static function _createDbo($arconf = array()) {
        ecpimport('database.database');
        $conf = self::getConfig();
        $host = $conf->host;
        $user = $conf->user;
        $password = $conf->password;
        $database = $conf->db;
        $prefix = $conf->dbprefix;
        $debug = $conf->debug;

        $options = array('host' => $host, 'user' => $user, 'password' => $password, 'database' => $database, 'prefix' => $prefix);
        $db = ECP_Database::getInstance($options, $arconf);

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
    private static function _createConfig() {
        ecpimport('includes.configuration');
        return new ECPConfig();
    }

    /**
     * Create a session object
     * @param   array  $options  An array containing session options
     * @return  ECP_Session object
     */
    protected static function createSession(array $options = array()) {
        // Get the editor configuration setting
        $conf = self::getConfig();

        $options['expire'] = ($conf->get('lifetime')) ? $conf->get('lifetime') : 15;
        ecpimport('session.session');
        $session = ECP_Session::getInstance($options);
        if ($session->getState() == 'expired') {
            $session->restart();
        }

        return $session;
    }

}
