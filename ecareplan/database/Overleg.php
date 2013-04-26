<?php
include_once 'Overlegstructuur.class.php';
include_once 'util/TestTraits.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Overleg {
    private $type;
    private $db;
    
    use World;
    
    function __construct($type) {
        $this->type=$type;
        $this->db= new PDO('mysql:host=localhost;dbname=listel5', 'root');
        $this->loadModules();
   }
   
    public function loadModules(){
        $o = new Overlegstructuur();
        $o->setOverleggenre($this->type);
        $modules = $o->findByExample($this->db, $o);
        foreach ($modules as $m) {
            echo $m->getTabelnaam();
            $this->sayWorld();
            
        }
        
    }
    
    
}
?>
