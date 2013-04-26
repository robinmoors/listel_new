<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Configuration class of EcarePlan
 * @version 1.0
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
class ECPConfig {
	/* MainSite Settings */
        public $cur_version = "1alpha0"; //NOTE versiebeheer!
	public $offline = '0'; //zet het hele systeem uit door hier 1 te zetten (voor alle websites die runnen vanaf deze server!)
	public $offline_message = 'Hey! We zijn bezig met opknappen en schoonmaken van de website...<br/>Kom zeker nog eens terug...<br/>Hey! We\'re cleaning and fixing things at the moment...<br /> Please check back again soon.';
	public $sitename = 'Ecareplan - De online Zorgplannenbeheerder!';
	public $list_limit = '30';
        public $standard_SID = 'listelvzwbe'; //noodzakelijk om meerdere ecareplannen te runnen vanuit 1 server..
        public $standard_url = "www.listel.be";
        public $base_url = "http://localhost/listel_new";

	/* Database Settings */
	public $host = 'localhost';				
	public $user = 'root'; //NOTE user met host: localhost, verder heeft hij alle previleges voor de database "ecareplan"!!
        public $password = '';
	public $db = 'listel5'; //NOTE er is dus een nieuwe database gemaakt met de naam "ecareplan" prefixen zijn "ecp_" dit moet dan de geoptimaliseerde database worden.
	public $dbprefix = '';
        public $debug = false; //NOTE dit is de database debugger, false = uit!!

	/* System Settings */
	public $secret = 'AjaEhk97edabslLeP45z6ej';
	public $error_reporting = '-1';

        
	/* Session settings */ 
	public $lifetime = '10'; //tijd in minuten voordat de user inactief word
	public $session_handler = 'database'; //NOT USED YET
        
        //NOTE - volgende items zijn momenteel nog niet in gebruik (en mogelijk mss helemaal niet nodig)


	/* Cache Settings */
	public $caching = '0';
	public $cachetime = '15';
	public $cache_handler = 'file';

	/* Meta Settings */
	public $MetaDesc = 'De meta description';
	public $MetaKeys = 'De, meta, keys';
	public $MetaTitle = '1';
	public $MetaAuthor = '1';

	/* Feed Settings */
	public $feed_limit = 10;
	public $feed_email = 'author';
        
        public function __toString() {
            return "Hey, ja deze site heeft een configuratieklasse. Maar we vertellen je niet wat er in zit!";
        }
        
        public function get($name){
            return $this->$name;
        }
}
