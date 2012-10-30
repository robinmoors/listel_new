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
            case "stream_45saw33bmg9a": case "stream_truc8as7ec3u":
            case "advertisements":  case "com_contact": case "stream":  case "advertisement":
                return 1;
                break;
            case "equinsi": case "equinsi_ins": case "equinsi_lists": case "orders":
                return 2;
                break;
            case "files":
                return 3;
                break;
            case "finance": 
                return 2;
                break; 
            case "horses":
                return 2;
                break;
            case "reservations": case "reservations_types":
                return 2;
                break;
            case "page": case "sites": case "devices":
                return 1;
                break;
            case "users":
                return 2;
                break;
            case "sessions":
                return 4;
                break;
            case "votes":
                return 3;
                break;
            default:
                return 0;
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
            case "stream_45saw33bmg9a": case "stream_truc8as7ec3u":
            case "advertisements":  case "com_contact": case "stream":  case "equinsi": case "equinsi_ins": case "equinsi_lists": case "files": case "finance": case "page":
                return 3;
                break; 
            case "horses":
                return 2;
                break;
            case "reservations": case "reservations_types":
                return 2;
                break;
            case "sessions":
                return 4;
                break;
            case "votes":
                return 3;
                break;
            default:
                return 0;
                break;
        }
    }
}