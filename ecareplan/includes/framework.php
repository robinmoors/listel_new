<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * EcarePlan Framework loader
 * @version 1.0
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");


//
// EcarePlan Startup
//

// System includes.
require_once ECPPATH_SITE.DS.'import.php';
// Pre-Load configuration class
require_once 'configuration.php';
    // System configuration.
    $CONFIG = new ECPConfig();
if (@$CONFIG->error_reporting === 0) {
	error_reporting(0);
} else if (@$CONFIG->error_reporting > 0) {
	error_reporting($CONFIG->error_reporting);
	ini_set('display_errors', 1);
}
define('ECPDEBUG', $CONFIG->debug);
unset($CONFIG);

//
// Equinsi library imports.
//

