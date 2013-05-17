<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Template class of EcarePlan System
 * @version 1.0
 * @package core
 * @subpackage template
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Template extends ECP_Object {

    protected $head = '';
    protected $body = '';
    protected $data = array();

    public function __construct() {
        
    }

    /**
     * Create a custom html head-section 
     * @param array $styles (stylefiles without .css), leave blank if no styles are needed
     * @param array $scripts (javascripts withoud .js), leave blank if no scripts are needed
     */
    protected function createHead($styles = null, $scripts = null) {
        $scripts = is_null($scripts) ? array("none") : (is_array($scripts) ? $scripts : array($scripts));
        $styles = is_null($styles) ? array("none") : (is_array($styles) ? $styles : array($styles));
        $this->head = "
<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta charset=\"utf-8\" />
        <link rel=\"shortcut icon\" href=\"/listel_new/favicon.ico.png.ico\" />";
        if ($styles[0] != "none") {
            foreach ($styles as $style) {
                $this->head.="<link rel=\"stylesheet\" href=\"/listel_new/lib/css/{$style}.css\" media=\"screen\" />";
            }
        }
        $this->head.=" 
        <script src=\"/listel_new/lib/js/jquery.js\" type=\"text/javascript\"></script>
        ";
        if ($scripts[0] != "none") {
            foreach ($scripts as $script) {
                $this->head.="<script src=\"/listel_new/lib/js/{$script}.js\"></script>";
            }
        }

        $this->head.="
        <script type=\"text/javascript\">
            $(document).ready(function(){
                EQ.CPU = EQ.ajaxProcessor;
                {[headscript]}
            });
        </script>
        <title>{[title]}</title>
        <!--[if lt IE 9]>
            <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>
        <![endif]-->
    </head>
                    ";
    }

    /**
     * Creates the body-block
     * @param type $html 
     */
    protected function createBody($html) {
        $this->body = "
    <body>
        $html
    </body>
</html>";
    }
    
    /**
     * Geef een bericht door
     * @param html $msg 
     */
    public function input($msg){
        self::replace("message",$msg);
    }
    
    /**
     * Vervang een textgebied in de template met de opgegeven tekst
     * @param templateTextArea $needle
     * @param html $txt 
     */
    protected function replace($needle,$txt){
        $this->head = str_replace("{[{$needle}]}",$txt,$this->head);
        $this->body = str_replace("{[{$needle}]}",$txt,$this->body);
    }
    
    /**
     * Maak het template klaar en geef de inhoud terug
     * @return html 
     */
    public function get(){
        self::finish();  //deleting templateTextArea's wich are not filled in
        return $this->head.$this->body;
    }
    /**
     * Pass the templatedata to this class.
     * @param array $data templatedata 
     * @return boolean true=data passed, false=no data passed
     */
    public function give($data){
        if(!is_array($data)){ 
            $this->addError("Fatal Error: No templatedata given in give!");
            return false;
        }else{
            $this->data = $data;
            return true;
        }
    }
    /**
     *  Verwijder alle ongebruikte templateTextArea's om een mooi template af te kunnen leveren
     */
    protected function finish(){
        //replace all templateTextArea's with ""
        $tags = array("baseurl","headscript","title","bodyscript","content","content-title","content-sub-title","footer","version-name","errors","user-name","login-button");
        foreach($tags as $tag){
            if(array_key_exists($tag, $this->data)) self::replace($tag,$this->data[$tag]);
            else self::replace($tag,"");
        }
    }
    /**
     * Toon errors in template
     */
    public function viewErrors(){
        foreach($this->errors as $error){
            $errors.=$error."<br/>";
        }
        self::replace("errors",$errors);
    }
    /**
     * Returns an object of EQApp from the right $id
     * @param type $id Clientname
     */
    public static function getInstance($templatefile) {
        static $instances;
        if (!isset($instances)) {
            $instances = array();
        }
        if (empty($instances[$id])) {
            $prefix = "ECP_Template_";
            $classname = $templatefile;
            if (ecpimport("template." . strtolower($classname))) {
                $classname = $prefix . $templatefile;
                $instance = new $classname($templatefile);
            } else {
                $this->addError("<hr/>error@ECP_Template::getInstance");
                $instance = "";
            }
            $instances[$templatefile] = &$instance;
        }
        return $instances[$templatefile];
    }
}

?>
