<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OmbModel {

    protected $uid = 0;
    protected static $db; //db is een static object (zie factory)
    
    //data
    private static $organisations = null;

    public function __CONSTRUCT($uid) {
        $this->uid = $uid;
    }
 
    private static function resultToArray($result,$names){
        if(!is_array($names) || $result==null) return null;
        foreach($result as $resource){//array van objecten dus een object nemen..
            $res=$resource->toArray();//dat object omzetten naar array
            foreach($res as $key => $value){
                $ar[$names[$key]] = $value; //hier gebeurd de key-wissel..
            }
            $data[] = $ar; //alles netjes terug in een array zetten :)
        }
        return $data;
    }
    
    public static function getContactwijze(){
        self::$db = ECPFactory::getPDO("OmbContactwijze");
        $contact = new OmbContactwijze();
        $sql = "SELECT * FROM `omb_contactwijze`";
        $result = $contact->findBySql(self::$db, $sql);
        return self::resultToArray($result, OmbContactwijze::getFieldNames());
    }
    
    public static function getProbleemfactor(){
        self::$db= ECPFactory::getPDO("OmbProbleemfactor");
        $probleem= new OmbProbleemfactor();
        $sql = "SELECT * FROM `omb_probleemfactor";
        $result = $probleem->findBySql(self::$db, $sql);
        return self::resultToArray($result, OmbProbleemfactor::getFieldNames());
    }
    
    public function newOmb(){
        
    }
}
?>