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
    private $iterator;
    private static $instances = array();

    public function __construct($formname = false) {
        if (!$formname)
            $this->name = "form";
        else
            $this->name = $formname;

        $this->iterator = 0;
        return $this;
    }

    public static function getInstance($formname = false) {
        if (!$formname)
            $formname = "form";
        if (empty(self::$instances[$formname])) {
            self::$instances[$formname] = new ECP_Form($formname);
        }
        return self::$instances[$formname];
    }

    public function __GET($fieldname) {
        if (in_array($fieldname, $this->names))
            return $this->obj[$fieldname];
        elseif ($fieldname == "name") {
            return $this->name;
        }
        else
            return null;
    }

    public function getNames() {
        return $this->names;
    }

    public function __toString() {
        return "" . print_r($this->names);
    }

    public function addField(ECP_FormObj $field) {
        array_push($this->names, $field->name);
        $this->obj[$field->name] = $field;
        return $this;
    }

    public function validate() {
        $error = array();
        $fields = array();
        $count = 0;
        $length = count($this->obj);
        foreach ($this->obj as $fieldobj) {
            if (!$fieldobj->validate()) {
                array_push($error, $fieldobj->msg);
                array_push($fields, $fieldobj->name);
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
        }
        else
            return false;
    }

    public function smartInsert($array) {
        if (!is_array($array))
            return false;
        foreach ($array as $field => $value) {
            if (array_key_exists($field, $this->obj)) {
                $this->obj[$field]->insert($value);
            }
        }
        return $this;
    }

    public function getHtml($class = "default", $placeholders = array(), $nobreak = false) {
        if (!empty($placeholders)) {
            foreach ($this->obj as $key => $value) {
                $this->obj[$key]->setPlaceholder($placeholders[$key]);
            }
        }
        $html = "<form name='{$this->name}'><div class='centered'>";

        foreach ($this->obj as $value) {
            $html .= $value->getHtml($this->name, $class);
        }
        $html.="</div></form>";
        if ($nobreak) {
            $html = str_replace("<br/>", "", $html);
        }
        return $html;
    }

    public function getScript($route, $txt = array(), $succes = "", $fail = "", $extra = "") {
        if (empty($txt)) {
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
            if ($this->names[$i] != "submit")
                $script .="var {$this->names[$i]} = document.{$this->name}.{$this->names[$i]}.value.toString();";
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
            if ($this->names[$i] != "submit")
                $script.="{$this->names[$i]}='+{$this->names[$i]}";
            if (($i + 2) < count($this->names)) //1 veld is altijd ongeldig, daarom i+2 !!
                $script.="+'&";
        }
        $script.="
                });
                EQ.CPU.startProcess(pname);
            }
            $('#{$this->name}-form').bind('click',function(){
                var b = true;
                ";
        foreach ($this->obj as $value) {
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

    public static function generateCollector($forms = array()) {
        if (!is_array($forms) && $forms instanceof ECP_FormObj) {
            $formar = array($forms);
        } elseif (!is_array($forms)) {
            return "";
        } else {
            $formar = $forms;
        }
        $script = "valueCollector = function(){
                    return {
                    ";
        foreach ($formar as $form) {
            $names = $form->getNames();
            foreach ($names as $name) {
                switch ($form->$name->type) {

                    case "radio":
                        $script .= "$name : radioValue(document.{$form->name}.$name);";
                        break;
                    case "checkbox":
                        $script .= "$name : document.{$form->name}.$name.checked";
                        break;
                    default: case "select": case "input":
                        $script .= "$name : document.{$form->name}.$name.value";
                        break;
                }
            }
        }
        $script.=" };
                 };";
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
    protected $type = "input";

    public function __CONSTRUCT($fieldname = false) {
        if (!$fieldname)
            $this->name = "field";
        else
            $this->name = $fieldname;

        $this->type = "input";
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
            case "type": return $this->type;
            default:
                return false;
        }
    }

    public function setPlaceholder($placeholder) {
        $this->placeholder = $placeholder;
        return true;
    }

    public function getHtml($formname, $class) {
        return "";
    }

}

class ECP_FormObj_Checkbox extends ECP_FormObj {

    protected $checked = false;
    protected $tobechecked = false;

    public function __CONSTRUCT($fieldname, $checked = false, $tobechecked = false) {
        $this->name = $fieldname;
        $this->checked = $checked;
        $this->script = "0,999,false";
        $this->tobechecked = $tobechecked;

        $this->type = "checkbox";
    }

    public function validate() {
        if ($this->value == '1' && $this->tobechecked)
            return true;
        else if ($this->value == '0' && !$this->tobechecked)
            return true;
        else
            return false;
    }

    public function getHtml($formname, $class) {
        $html = "<span class='description {$class}'>{$this->placeholder}</span><input type='checkbox' name='{$this->name}' value='{$this->value}' class='{$class}'>"
                . "<span id='{$formname}{$this->name}'></span></br>";
        return $html;
    }

}

class ECP_FormObj_Select extends ECP_FormObj {

    protected $select = false;
    protected $options = false;
    protected $disabled = false;

    public function __CONSTRUCT($fieldname, $options = array(), $select = true) {
        $this->name = $fieldname;
        $this->select = $select;
        $this->options = $options;
        $this->disabled = array();
        if ($this->select) {
            $this->script = "1,999,false";
        } else {
            $this->script = "0,999,false";
        }

        $this->type = "select";
    }

    public function insertOptions($options = array()) {
        $this->options = $options;
        return $this;
    }

    public function disableOption($optionkey) {
        foreach ($this->options as $key => $value) {
            if ($optionkey == $key)
                $this->disabled[$key] = $value;
        }
        return $this;
    }

    public function validate() {
        if ($this->is_option($this->value) && $this->select) {
            return true;
        } elseif (!$this->select) {
            return true; //selectie moest niet gemaakt worden
        } else {
            return false;
        }
    }

    protected function is_option($value) {
        if (!$value)
            $value = 0;
        return array_key_exists($value, $this->options);
    }

    protected function is_disabled($optionkey) {
        if (array_key_exists($optionkey, $this->disabled))
            return true;
        else
            return false;
    }

    public function getHtml($formname, $class) {
        $html = "<span class='description {$class}'>{$this->placeholder}</span><select name='{$this->name}' class='{$class}'>";
        $first = false;
        $disabled = '';
        foreach ($this->options as $key => $value) {
            if ($this->is_disabled($key))
                $disabled = "disabled='disabled'";
            else
                $disabled = '';
            if (!$first && $disabled === '') { //kan zijn dat 1ste value geblokkeerd is en die mag dus niet selected zijn!
                $html.="<option value='$key' selected='selected'>$value</option>";
                $first = true;
            }
            else
                $html.="<option value='$key' $disabled>$value</option>";
        }
        $html.="</select><span id='{$formname}{$this->name}'></span></br>";
        return $html;
    }

}

class ECP_FormObj_Radio extends ECP_FormObj_Select {

    public function __CONSTRUCT($fieldname, $options = array(), $select = true) {
        parent::__CONSTRUCT($fieldname, $options, $select);
        $this->type = "radio";
    }

    public function getHtml($formname, $class) {
        $html = "<span class='description {$class}'>{$this->placeholder}</span>";
        $first = true;
        foreach ($this->options as $key => $value) {
            if ($first) {
                $first = false;
                $html.="<input type='radio' name='{$this->name}' value='$key' class='{$class}' checked='checked'>$value<br/>";
            }
            else
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

    public function getHtml($formname, $class) {
        return "<input type='text' name='{$this->name}' value='' placeholder='{$this->placeholder}' class='{$class}'/><span id='{$formname}{$this->name}'></span><br/>";
    }

}

class ECP_FormObj_Password extends ECP_FormObj_Input {

    public function getHtml($formname, $class) {
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

    public function getHtml($formname, $class) {
        return "<input type='email' name='{$this->name}' value='' placeholder='{$this->placeholder}' class='{$class}'/><span id='{$formname}{$this->name}'></span><br/>";
    }

}

class ECP_FormObj_Button extends ECP_FormObj {

    private $text;

    public function __CONSTRUCT($text) {
        $this->name = "submit";
        $this->text = $text;
        $this->script = "0,0,false";
        $this->type = "button";
    }

    public function validate() {
        return true;
    }

    public function getHtml($formname, $class) {
        return "<input type='button' id='{$formname}-form' name='button' value='{$this->text}' class='{$class}'/><span id='{$formname}{$this->name}'></span><br/>";
    }

}

class ECP_FormObj_NormalButton extends ECP_FormObj {

    private $text;

    public function __CONSTRUCT($name, $text) {
        $this->name = $name;
        $this->text = $text;
        $this->script = "0,0,false";
        $this->type = "button";
    }

    public function validate() {
        return true;
    }

    public function getHtml($formname, $class) {
        return "<input type='button' id='{$formname}-{$this->name}' name='button' value='{$this->text}' class='{$class}'/><span id='{$formname}{$this->name}'></span><br/>";
    }

}

/*
 * Speciale FormObj met javascript
 */

class ECP_FormObj_Date extends ECP_FormObj_Input {

    public function __CONSTRUCT($fieldname = false, $minlength = 0, $maxlength = 30) {
        parent::__CONSTRUCT($fieldname, 11, 11);
        $this->type = "date";
    }

    public function validate() {
        
    }

    public function getHtml($formname, $class) {
        return "<input type='text' maxlength='11' name='{$this->name}' value='' placeholder='{$this->placeholder}' class='{$class}'
            onchange='EQ.formCheckDate();'
            /><span id='{$formname}{$this->name}'></span><br></br>";
    }

}

class ECP_FormObj_Hulpverlener extends ECP_FormObj_Input {

    public function getHtml($formname, $class) {
        return "<input type='text' name='{$this->name}' value='' placeholder='{$this->placeholder}' 
            onkeyup='' 
            onclick='' 
            class='{$class}'/><span id='{$formname}{$this->name}'></span><br/>";
    }

}

class ECP_FormObj_Telefoon extends ECP_FormObj_Input {

    public function __CONSTRUCT($fieldname = false, $minlength = 9, $maxlength = 9) {
        parent::__CONSTRUCT($fieldname, $minlength, $maxlength);
        $this->type = "telephone";
    }

    public function validate() {
        $reg = '/^[0-9]{9}/$';
        if (!preg_match($reg, $this->value)) {
            $this->msg = "match";
            return false;
        }
        return true;
    }

    public function getHtml($formname, $class) {
        return "<input type='text' maxlength='9' name='{$this->name}' value='' placeholder='{$this->placeholder}' class='{$class}'
            onfocus=''
            onchange=''
            /><span id='{$formname}{$this->name}'></span><br></br>";
    }

}

class ECP_FormObj_Postcode extends ECP_FormObj_Input {

    public function __CONSTRUCT($fieldname = false) {
        parent::__CONSTRUCT($fieldname, 4, 4);
        $this->type = "postal";
    }

    public function validate() {
        $reg = '/^[1-9]{1}[0-9]{3}/$';
        if (!preg_match($reg, $this->value)) {
            $this->msg = "match";
            return false;
        }
        return true;
    }

    public function getHtml($formname, $class) {
        return "<input type='text' maxlength='4' name='{$this->name}' value='' placeholder='{$this->placeholder}' class='{$class}'
            onfocus=''
            onmouseup=''
            onkeyup=''
            /><span id='{$formname}{$this->name}'></span><br></br>";
    }

}

?>
