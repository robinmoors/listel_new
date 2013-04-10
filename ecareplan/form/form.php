<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Form extends ECP_Object {

    private $names = array();
    private $obj = array();
    private $name = "";
    
    private static $instances = array();

    public function __construct($formname = false) {
        if (!$formname)
            $this->name = "form";
        else
            $this->name = $formname;
    }

    public static function getInstance($formname = false) {
        if(!$formname) $formname = "form";
        if (empty(self::$instances[$formname])) {
                self::$instances[$formname] = new ECP_Form($formname);
        }
        return self::$instances[$formname];
    }

    public function __GET($fieldname){
        if(in_array($fieldname,$this->names)) return $this->obj[$fieldname]->value;
        else return "0";
    }
    
    public function addField(ECP_FormObj $field) {
        array_push($this->names, $field->name);
        $this->obj[$field->name] = $field;
        return true;
    }

    public function validate() {
        $error = array();
        $fields = array();
        $count = 0;
        $length = count($this->obj);
        foreach ($this->obj as $fieldobj) {
            if (!$fieldobj->validate()) {
                array_push($error, $fieldobj->msg);
                array_push($fields,$fieldobj->name);
                $count++;
            }
        }
        if ($count == 0)
            return true;
        else
            return array($fields, $error, $count);
    }

    public function insertValue($name, $value) {
        if (in_array($name, $this->names)) {
            $this->obj[$name]->insert($value);
            return true;
        }else
            return false;
    }
    
    public function smartInsert($array){
        if(!is_array($array)) return false;
        foreach($array as $field => $value){
            if(array_key_exists($field,$this->obj)){
                $this->obj[$field]->insert($value);
            }
        }
        return true;
    }
    
    public function getHtml($class, $placeholders = array()){
        if(!empty($placeholders)){
            foreach($this->obj as $key => $value){
                $this->obj[$key]->setPlaceholder($placeholders[$key]);
            }
        }
        $html = "<form name='{$this->name}'><div class='centered'>";
        
        foreach($this->obj as $value){
            $html .= $value->getHtml($this->name,$class);
        }
        $html.="</div></form>";
        return $html;
    }
    
    public function getScript($route,$txt = array(),$succes="",$fail="",$extra=""){
        if(empty($txt)){
            $txt["title"] = "Formulier";
            $txt["action"] = "Bezig met verzenden...";
        }$script.="
            var {$this->name}completion = function(){
                EQ.OVR = new EQ.overflow({
                    title:'{$txt["title"]}'
                });
                EQ.OVR.content = '{$txt["action"]}<br/><img src=\'/listel_new/lib/images/flat-loader.gif\' />';
                EQ.OVR.refresh('c').open();
                var pname = '{$this->name}completion';";
        for ($i = 0; $i < count($this->names); $i++) {
            if($this->names[$i]!="submit") $script .="var {$this->names[$i]} = document.{$this->name}.{$this->names[$i]}.value.toString();";
        }
        $script .="
                EQ.CPU.makeProcess({
                    name: pname,
                    process: function(resp){
                        var json = EQ.jsp(resp);
                        if(json.error){
                            $('#{$this->name}'+json.error).html(EQ.messages['form-wrong']).removeClass('succes').addClass('wrong');
                            EQ.OVR.close();
                        }else if(json.succes){
                            if(json.succes=='positive'){
                                EQ.OVR.content='{$txt["succes"]}';
                                EQ.OVR.refresh('c');
                                EQ.login(json);
                                {$succes}
                            }
                            {$extra}
                            else{
                                EQ.OVR.content='{$txt["fail"]}';
                                EQ.OVR.refresh('c');
                                {$fail}
                            }
                        }
                        //laad ook userobjecten in..
                        }
                });
                EQ.CPU.newRequest({
                    process: pname,
                    url:'{$route}',
                    parameters:'";
        for ($i = 0; $i < count($this->names); $i++) {
            if($this->names[$i]!="submit") $script.="{$this->names[$i]}='+{$this->names[$i]}";
            if (($i+2) < count($this->names)) //1 veld is altijd ongeldig, daarom i+2 !!
                $script.="+'&";
        }
        $script.="
                });
                EQ.CPU.startProcess(pname);
            }
            $('#{$this->name}-form').bind('click',function(){
                var b = true;
                ";
            foreach($this->obj as $value){
                $script.= "if(!EQ.formCheck(document.{$this->name}.{$value->name},{$value->script},'{$this->name}')) b = false;
                ";
            }
        $script.="
                if(b){
                    $('#{$this->name}submit').removeClass('wrong').addClass('succes').html(EQ.messages['form-complete']);
                    {$this->name}completion();
                }
            });
            
            EQ.messages = {
                    'form-length-short':'Te kort',
                    'form-length-max':'Te lang',
                    'form-match':'Dit is geen emailadres!',
                    'form-nocopy':'Komt niet overeen!',
                    'form-uncomplete':'Niet volledig!',
                    'form-complete':'Ok!',
                    'form-wrong':'Ongeldig!'
                }";
        return $script;
    }

}

class ECP_FormObj {

    protected $name;
    protected $value;
    protected $type;
    protected $msg = "";
    protected $placeholder;
    protected $script;

    public function __CONSTRUCT($fieldname = false) {
        if (!$fieldname)
            $this->name = "field";
        else
            $this->name = $fieldname;
    }

    public function insert($value) {
        $this->value = trim($value);
        return true;
    }

    public function validate() {
        return true;
    }

    public function __GET($name) {
        switch ($name) {
            case "msg": return $this->msg;
                break;
            case "name": return $this->name;
                break;
            case "script": return $this->script;
                break;
            case "value": return $this->value;
                break;
            default: 
                return false;
        }
    }
    
    public function setPlaceholder($placeholder){
        $this->placeholder = $placeholder;
        return true;
    }
    
    public function getHtml($formname,$class){
        return "";
    }

}
class ECP_FormObj_Select extends ECP_FormObj{
    protected $select = false;
    protected $options = false;
    
    public function __CONSTRUCT($fieldname, $options=array(), $select=false){
        $this->name = $fieldname;
        $this->select = $select;
        $this->options = $options;
        if($this->select){
            $this->script = "1,999,false";
        }else{
            $this->script = "0,999,false";
        }
    }
    
    public function validate(){
        if($this->is_option($this->validate) && $this->select){ 
            return true;
        }elseif (!$this->select) { 
            return true; //selectie moest niet gemaakt worden
        }else{
            return false;
        }
    }
    
    private function is_option($value){
        return array_key_exists($value, $this->options);
    }
    
    public function getHtml($formname, $class){
        $html = "<select name='{$this->name} class='{$class}'>";
        foreach($this->options as $key => $value){
            $html.="<option value='$key'>$value</option>";
        }
        $html.="</select><span id='{$formname}{$this->name}'></span></br>";
        return $html;
    }
}
class ECP_FormObj_Radio extends ECP_FormObj_Select{

    public function getHtml($formname, $class){
        $html="";
        foreach($this->options as $key => $value){
            $html.="<input type='radio' name='{$this->name}' value='$key' class='{$class}'>$value<br/>";
        }
        $html.="<span id='{$formname}{$this->name}'></span></br>";
        return $html;
    }
}

class ECP_FormObj_Input extends ECP_FormObj {

    protected $minlength;
    protected $maxlength;

    public function __CONSTRUCT($fieldname = false, $minlength = 0, $maxlength = 30) {
        parent::__CONSTRUCT($fieldname);
        $this->minlength = $minlength;
        $this->maxlength = $maxlength;
        $this->script = "$minlength,$maxlength,false";
    }

    public function validate() {
        if (strlen($this->value) > $this->maxlength) {
            $this->msg = "long";
            return false;
        }if (strlen($this->value) < $this->minlength) {
            $this->msg = "short";
            return false;
        }
        return true;
    }
    
    public function getHtml($formname,$class){
        return "<input type='text' name='{$this->name}' value='' placeholder='{$this->placeholder}' class='{$class}'/><span id='{$formname}{$this->name}'></span><br/>";
    }

}

class ECP_FormObj_Password extends ECP_FormObj_Input {

    public function getHtml($formname,$class){
        return "<input type='password' name='{$this->name}' value='' placeholder='{$this->placeholder}' class='{$class}'/><span id='{$formname}{$this->name}'></span><br/>";
    }
}

class ECP_FormObj_Email extends ECP_FormObj {
    
    public function __CONSTRUCT($fieldname = false) {
        parent::__CONSTRUCT($fieldname);
        $this->script = "'x','x',true";
    }

    public function validate() {
        $reg = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
        if (!preg_match($reg, $this->value)) {
            $this->msg = "match";
            return false;
        }
        return true;
    }
    
    public function getHtml($formname,$class){
        return "<input type='email' name='{$this->name}' value='' placeholder='{$this->placeholder}' class='{$class}'/><span id='{$formname}{$this->name}'></span><br/>";
    }

}

class ECP_FormObj_Button extends ECP_FormObj {
    private $text;
    
    public function __CONSTRUCT($text){
        $this->name = "submit";
        $this->text = $text;
        $this->script= "0,0,false";
    }

    public function validate() {
        return true;
    }
    
    public function getHtml($formname,$class){
        return "<input type='button' id='{$formname}-form' name='button' value='{$this->text}' class='{$class}'/><span id='{$formname}{$this->name}'></span><br/>";
    }

}

?>
