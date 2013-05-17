<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database class of EcarePlan System
 * @version 1.0
 * @package Database
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_DatabaseQuery extends ECP_Object {

    private static $permlvl = 0;
    private static $debug;
    private $action = false;
    private $table = null;
    private $rows = null;
    private $where = null;
    private $order = "";
    private $result = null;
    private $updateset = null;
    private $current_row = null;
    private $current_needle = 0;
    private $sql_error = null;
    private $sql_error_number = null;
    private $_conf = array();
    private $limit = "";

    /**
     * Contstructor for class reader
     * @param string $action Mysql Action (select,update,insert into)
     * @param array $options Array with configuration parameters (restrictions, debugging,..)
     */
    public function __CONSTRUCT($action, $options) {
        $this->_conf = $options;
        self::$debug = array_key_exists("debug", $options) ? $options["debug"] : false;
        //self::$debug = true;
        self::$permlvl = array_key_exists("permissionlevel", $options) ? $options["permissionlevel"] : 1;
        //security disabled!
        self::$permlvl = 6;
        if (self::$debug)
            echo "Debugging Query<br/><hr/>\n";
        self::action(strtolower($action));
    }
    
   

    /**
     * Stelt de mysql actie in en returned het object voor kettingvorming
     * Actie wordt enkel ingesteld als daarvoor permissie is
     * @param type $action select, update, delete, insert into...
     * @return EQDatabaseQuery 
     */
    private function action($action) {
        if (self::$debug)
            echo "* action given: $action<br/>";
        $this->action = array_key_exists($action, $this->_conf) ? $action : false;
        //security disabled!
        $this->action = $action;
        if ($this->action) {
            if (self::$debug)
                echo "action accepted<br/>";
        }else {
            if (self::$debug)
                echo "action rejected<br/>";
        }
        return $this;
    }
    /**
     *
     * @param string $rows (rows for SELECT * or other..)
     * @return EQDatabaseQuery 
     */
    public function rows($rows){
        $this->rows = $rows;
        return $this;
    }
    /**
     * Stelt de tabel in en returned thet object voor kettingvorming
     * @param string $table De tabelnaam
     * @return EQDatabaseQuery 
     */
    public function table($table) {
        ecpimport("database/tablehelper");
        if (self::$debug)
            echo "* table given: $table<br/>";
        if (ECP_DatabaseTableHelper::is_table($table)) {
            if (self::$debug)
                echo "table exists,, checking permission..<br/>";
            if (ECP_DatabaseTableHelper::getTablePermissionLevel($table) <= self::$permlvl) {
                if (self::$debug)
                    echo "permission ok for table (deletepermission not checked yet): $table<br/>";
                $this->table = strtolower($table);
            }else {
                if (self::$debug)
                    echo "no permission for table: $table, permissionlevel::".self::$permlvl."<br/>";
                $this->table = null;
            }
        }else {
            if (self::$debug)
                echo "$table doesnt exist!<br/>";
            $this->table = null;
        }
        return $this;
    }

    /**
     * Creëer een where statement en geef het object terug voor kettingvorming
     * @param string/array $row De rijnaam
     * @param string/array $value De waarde (bij gelijke waarde voor alle rijen, gewoon als string opgeven)
     * @param string/array $sign De operator (bij gelijke waarde voor alle rijen, gewoon als string opgeven)
     * @param string $logic De Logische operator (and, or, and not, or not) (slechts 1x opgeven!)
     * @return EQDatabaseQuery 
     */
    public function where($row=null, $value=null, $sign=null, $logic = null) {
        if (!is_array($row) && !is_array($value) && !is_array($sign)) {
            if (self::$debug)
                echo "* Single Where statement detected<br/>";
            $sign = !is_null($sign) ? $sign : "=";
            $this->where = "$row $sign '$value'";
            if (self::$debug)
                echo "where {$this->where}<br/>";
        }elseif (is_array($row) && is_array($value)) {
            if (self::$debug)
                echo "* Multitple Where statement detected<br/>";
            $l = count($row);
            for ($i = 0; $i < $l; $i++) {
                $v = array_key_exists($i, $value) ? "'$value[$i]'" : "'$value[0]'";
                $s = is_null($sign) ? "=" : (is_array($sign) ? (array_key_exists($i, $sign) ? $sign[$i] : $sign[0]) : $sign);
                $logic = is_null($logic) ? "AND" : $logic;
                if ($i != 0)
                    $this->where .= " $logic $row[$i] $s $v";
                else
                    $this->where .= "$row[$i] $s $v";
            }
            if (self::$debug)
                echo "where {$this->where}<br/>";
        }else {
            $this->where = null;
            if (self::$debug)
                echo "* Invallid arguments for where! $row - $value - $sign - $logic<br/>";
        }
        return $this;
    }
    /**
     * Maak een speciale where (toevoegen aan de gewone) om met timestamps te werken!
     * @param string $row
     * @param timestamp $from 
     * @param timestamp $to
     * @param string $logic1 - Indien er een gewone where is gemaakt moet hier de logica zijn (and,or,not) anders niks
     * @param string $logic2 - and or not
     */
    public function addDateWhere($row,$from,$to,$logic2,$logic1=null){
        if($this->where){
            $this->where.=" $logic1 $row between '$from' $logic2 '$to' ";
        }else{
            $this->where=" $row between '$from' $logic2 '$to' ";
        }
        if (self::$debug)
                echo "(addDate)Where {$this->where}<br/>";
        return $this;
    }
    
    public function values($values){
        $this->values =$values;
        return $this;;
    }
    
    /**
     * ORDER BY
     * @param mysql_row $row
     * @param boolean $up sort up or down(=false or empty)
     * @return EQDatabaseQuery 
     */
    public function order($row,$up = null){
        $up = is_null($up) ? "DESC" : "ASC";
        $this->order = "ORDER BY {$row} {$up}";
        return $this;
    }
    
    public function limit($to,$from=0){
        $this->limit = "LIMIT $from,$to";
        return $this;
    }
    /**
     * UPDATE table SET row1=value1,row2=value2
     * @param type $rows Array met rijen of enkele rij
     * @param type $values Array met waardes of enkele waarde
     */
    public function updateset($rows,$values){
        if(is_array($rows) && is_array($values) && count($rows) == count($values)){
            for($i = 0; $i<count($rows); $i++){
                $this->updateset .= $rows[$i]."='".$values[$i]."'";
                $i++;
                if($i!=count($rows)){
                    $this->updateset.=",";
                    $i--;
                }
            }
        }elseif(is_array($rows) && !is_array($values)){
            for($i = 0; $i<count($rows); $i++){
                $this->updateset .= $rows[$i]."='".$values."'";
                $i++;
                if($i!=count($rows)){
                    $this->updateset.=",";
                    $i--;
                }
            }
        }elseif(!is_array($rows) && !is_array($values)){
            $this->updateset = $rows."='".$values."'";
        }
        return $this;
    }
    /**
     * Execute mysql_query and saves it. Returning the object itself for chainability.
     * Before running this function you must set the actions by using "select, insert,..." or nothing will happen.
     * @return EQDatabaseQuery 
     */
    public function execute() {
        if (!is_null($this->action) && !is_null($this->table)) {
            if (self::$debug)
                echo "* Execute query<br/>";
            //sorters and seekers
            $where = is_null($this->where) ? "" : "WHERE ".$this->where;
            $order = is_null($this->order) ? "" : "ORDER BY {$this->order[0]} {$this->order[1]}";
            //actions
            $select = $this->action == "select" ? (is_null($this->rows) ? "SELECT * FROM ".$this->_conf['prefix']."{$this->table} {$where} {$this->order} {$this->limit}" : "SELECT {$this->rows} FROM ".$this->_conf['prefix']."{$this->table} {$where} {$this->order} {$this->limit}") : '';
            $update = $this->action == "update" ? (is_null($this->updateset)) ? '' : "UPDATE ".$this->_conf['prefix']."{$this->table} SET {$this->updateset}  {$where}" : ''; 
            $insert = $this->action == "insert" ? is_null($this->rows) ? is_null($this->values) ? '' : "INSERT INTO ".$this->_conf['prefix']."{$this->table} VALUES({$this->values})" : is_null($this->values) ? '' : "INSERT INTO ".$this->_conf['prefix']."{$this->table} ({$this->rows}) VALUES ({$this->values})" : '';
            //deleting requires special permissions!
            if($this->action == "delete" && ECP_DatabaseTableHelper::getTableDeletePermissionLevel($this->table) <= self::$permlvl){
                $delete = $this->action == "delete" ? "DELETE FROM ".$this->_conf['prefix']."{$this->table} WHERE ".$this->where : '';
            }else{
                if(self::$debug) echo "<br/>No permission to delete rows in table,,!<br/>Deletequery not created";
            }
                if (self::$debug)
                echo "selectquery: $select <br/>updatequery (not implemented in mysql_query): $update <br/>insertquery (not implemented in mysql_query): $insert<br/>deletequery (not implemented in mysql_query): $delete<br/>";
            $this->result =  mysql_query($select.$update.$insert.$delete);
            $this->sql_error =  mysql_error();
            $this->sql_error_number = mysql_errno();
            if(self::$debug){
                 echo "Query excuted - Output: {$this->result}, errornr: {$this->sql_error_number}, errormgs: {$this->error}<br/>";
                 echo "Number of rows:: ".self::getRows();
            }
        }
        return $this;
    }

    /**
     * Return het aantal rijen van het resultaat - indien er een resultaat is.
     * @return integer Het aantal rijen in het resultaat, false indien er geen resultaat is. true/false als het gaat om delete,update,insert,...
     */
    public function getRows() {
        if(is_null($this->result)) return false; //nog geen query aangemaakt
        if ($this->debug)
            echo mysql_num_rows($this->result) . "<br/>";
        if (is_bool($this->result)) //er is een foute query gemaakt of een insert,update..., resultaat is dus een boolean
            return $this->result;
        return mysql_num_rows($this->result);
    }
    /**
     * Return resultaat van query, of de rij van een query indien er een "singeResult" of "nextResult" is toegepast.
     * @return array
     */
    public function get() {
        if(!is_null($this->current_row))
            return $this->current_row;
        else
            return $this->result;
    }
    /**
     * Return resultaat van query, of de rij van een query indien er een "singeResult" of "nextResult" is toegepast.
     * @return mysql_result
     */
    public function getFullResult() {
            return $this->result;
    }
    /**
     * Return errormessage
     * @return mysql_error
     */
    public function getError() {
        return mysql_error($this->con);
    }
    
    /**
     * 
     * @see singleResult, get
     */
    public function getSingleResult(){
        $this->singleResult();
        return $this->get();
    }
    /**
     *  Sla het resultaat als array op en return het object voor kettingmakerij
     * @return EQDatabaseQuery 
     */
    public function singleResult(){
        @$this->current_row = is_null($this->current_row) ? mysql_fetch_array($this->result) : $this->current_row;
        return $this;
    }
    /**
     * Sla het resultaat van de volgende rij op in een array en return het object voor kettingmakerij
     * @return EQDatabaseQuery 
     */
    public function nextResult(){
        if(self::getRows()>1){
            $this->current_row = mysql_fetch_array($this->result);
            $this->current_needle++;
            return $this;
        }else{
            self::singleResult();
            return $this;
        }
    }
    
    public function debug(){
        self::$debug = true;
        return $this;
    }

}

?>
