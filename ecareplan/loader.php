<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * EcarePlan Loader
 * @version 1.0
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

abstract class ECPLoader
{
    
     /**
      * File importer - Includes classes/files
      * @param filestring $doc string zoals "type.document.extra'
      * @return boolean true=imported
      */
     public static function import($doc){
         $paths = explode(DIRECTORY_SEPARATOR,__FILE__);
         array_pop($paths);
         $path = implode("/",$paths);
         $docpath=explode('.',$doc);
         $path = $path.DS.implode("/",$docpath);
         if(file_exists($path.PHP)){
            return (bool)include_once($path.PHP);
         }else{
            echo "<hr/>Sorry, het loopt een beetje fout... Het bestand ".$path.PHP." bestaat niet.<br/>";
            return false;
         }
     }
     
     /**
      * Checks if a file exists and returns the answer
      * (Offers a safe check before trying to import)
      * @param string $path
      * @return boolean true if exist
      */
     public static function locate($doc){
         $paths = explode(DIRECTORY_SEPARATOR,__FILE__);
         array_pop($paths);
         $path = implode("/",$paths);
         $docpath=explode('.',$doc);
         $path = $path.DS.implode("/",$docpath);
         if(file_exists($path.PHP)){
             return true;
         }else return false;
     }
}

/**
 * App exit...
 *
 * @param	mixed	Exit code or string. Defaults to zero.
 * @since	1.0
 */
function ecpexit($message = NULL)
{
	exit($message);
}

/**
 * File Importer (with filechecker)
 *
 * @param	filestring	string zoals "type.document.extra'
 * @since	1.0
 */
function ecpimport($path)
{
	return ECPLoader::import($path);
}

function ecplocate($path){
    return ECPLoader::locate($path);
}
