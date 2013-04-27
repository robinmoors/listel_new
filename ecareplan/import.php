<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * EcarePlan Loader (starter)
 * @version 1.0
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

// Loader inladen..
if (!class_exists('ECPLoader')) {
	require_once ECPPATH_SITE.DS.'loader.php';
}

//
// Import libraries..
//

// Basis
ECPLoader::import('core.object');
// Omgeving

// EcarePlan class and methods.
ECPLoader::import('factory');
        //hier kan een versie class komen maar voorlopig zie ik het nut hiervan nog niet in :)

// Error

// Helpers

// Filters

