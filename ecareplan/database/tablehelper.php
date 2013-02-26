<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * TableHelper for Query Database class of EcarePlan System
 * @version 1.0
 * @package Database
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");


class ECP_DatabaseTableHelper{

    public static function is_table($tablename){
        $r = self::getTablePermissionLevel($tablename)>=1 ? true : false;
        return $r;
    }
    /**
     * Geeft het permissieniveau terug van een database tabel
     * @param string $tablename De mysql tabelnaam
     * @return integer 0 = onbestaande tabel, 1 = frontende en backend (all), 2 = backend (all), 3 = backend (admin), 4 = systemAuthorization (alleen via login.php) voor alle niveaus waar login vereist is = STRONG!!
     */
    public static function getTablePermissionLevel($tablename){
        switch(strtolower($tablename)){
            
            default:
                return 6;
                break;
        }
    }
     /**
     * Geeft het permissieniveau terug van een database tabel VOOR DELETE opdrachten!
     * @param string $tablename De mysql tabelnaam
     * @return integer 0 = onbestaande tabel of niet verwijderbaar, 1 = frontende en backend (all), 2 = backend (all), 3 = backend (admin), 4 = systemAuthorization (alleen via login.php) voor alle niveaus waar login vereist is = STRONG!!
     */
    public static function getTableDeletePermissionLevel($tablename){
        switch(strtolower($tablename)){
            
            default:
                return 6;
                break;
        }
    }
}