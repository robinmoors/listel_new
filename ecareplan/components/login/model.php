<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_Login_Model {

    private $appobj = null;
    private $registerform = array("fname","name","email","password");
    private $loginform = array("email","password");
    private $formerror = 0;
    public function __CONSTRUCT() {

    }

    public function login($action,$post){
        switch($action){
            case "valid": //lkj
                for($i=0; $i<count($this->loginform); $i++){
                    if($this->loginform[$i]!="email" && (strlen(trim($post[$this->loginform[$i]]))>30 || strlen(trim($post[$this->loginform[$i]]))<2)){
                        $this->formerror = $i;
                        return false;
                    }
                    if($this->loginform[$i]=="email"){
                        $reg = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
                        if(!preg_match($reg,$post[$this->loginform[$i]])){
                            $this->formerror = $i;
                            return false;
                        }
                    }elseif($this->loginform[$i]=="password"){
                        if(strlen(trim($post[$this->loginform[$i]]))<8){
                            $this->formerror = $i;
                            return false;
                        }
                    }
                }
                return true;
                break;
            case "succes": //lk
                $db = ECPFactory::getDbo();
                ecpimport("helpers.cryptology");
                $pasw = ECP_Cryptology::generateHash(trim($post['password']));
                $where = array("email","pasw");
                $wheres = array($post['email'],$pasw);
                $echeck = $db->newQuery("select","echeck")->table("users")->where($where,$wheres,"=","AND")->execute();
                if(!$echeck->getRows()){
                    //oepsiepoepsie ergens iets niet juist!
                    echo '{"succes":"negative","reason":"no-access"}';
                    exit();
                }else{
                    //access dus we gaan een loginpin geven ;)
                    $loginpin = ECP_Cryptology::generateInteger(30);
                    $pinhash = ECP_Cryptology::generateHash($loginpin);
                    $logtodb = $db->newQuery("update","login")->table("users")->updateset(array('Loginpin', 'Ip'),array($pinhash,$_SERVER['REMOTE_ADDR']))->where($where,$wheres,"=","AND")->execute();
                    if($logtodb->getRows())
                        echo '{"succes":"positive","loginpin":"'.$loginpin.'","Ip":"'.$_SERVER['REMOTE_ADDR'].'"}';
                    else
                        echo '{"succes":"negavive","reason":"database"}';
                    exit();
                }
                break;
            case "false": //lkk
                echo '{"error":"'.$this->loginform[$this->formerror].'"}';
                exit();
                break;
            default: $this->loginpage();
                break;
        }
    }
    public function register($action,$post){
        switch($action){
            case "valid": //lkj
                for($i=0; $i<count($this->registerform); $i++){
                    if($this->registerform[$i]!="email" && (strlen(trim($post[$this->registerform[$i]]))>30 || strlen(trim($post[$this->registerform[$i]]))<2)){
                        $this->formerror = $i;
                        return false;
                    }
                    if($this->registerform[$i]=="email"){
                        $reg = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
                        if(!preg_match($reg,$post[$this->registerform[$i]])){
                            $this->formerror = $i;
                            return false;
                        }
                    }elseif($this->registerform[$i]=="password"){
                        if(strlen(trim($post[$this->registerform[$i]]))<8){
                            $this->formerror = $i;
                            return false;
                        }
                    }
                }
                return true;
                break;
            case "succes": //lk
                $db = ECPFactory::getDbo();
                $echeck = $db->newQuery("select","echeck")->table("users")->where("email",$post['email'],"=")->execute();
                if(!$echeck->getRows()){
                    //email is nieuw
                    ecpimport("helpers.cryptology");
                    $unlock = ECP_Cryptology::generateInteger(30);
                    $password = ECP_Cryptology::generateHash(trim($post['password']));
                    $b = false;
                    $post['email'] = filter_var(trim(strtolower($post['email'])),515);
                    $post['fname'] = filter_var(trim(strtolower($post['fname'])),515);
                    $post['name'] = filter_var(trim(strtolower($post['name'])),515);
                    while(!$b){
                        $id = ECP_Cryptology::generateInteger(18);
                        $s=$db->newQuery("select","checkeid")->table("users")->rows("UID")->where("UID",$id,"=")->execute();
                        if($s->getRows()==0) $b = true;
                    }
                    $newu = $db->newQuery("insert","newu")->table("users")->rows('UID,Email,Pasw,Unlockpin,Firstname,Lastname')->values("{$id},'{$post['email']}','{$password}','{$unlock}','{$post['fname']}','{$post['name']}'")->execute();
                    if(!$newu->getRows()){
                        //opslaan mislukt :(
                        echo '{"succes":"negative","reason":"database"}';
                        exit();
                    }
                }else{
                    //email bestaat al
                    echo '{"succes":"negative","reason":"email"}';
                    exit();
                }
                echo '{"succes":"positive"}';
                exit();
                break;
            case "false": //lkk
                echo '{"error":"'.$this->registerform[$this->formerror].'"}';
                exit();
                break;
            default: $this->loginpage();
                break;
        }
    }

    public function loginpage() {
        $script.="
            var logincompletion = function(){
                EQ.OVR = new EQ.overflow({
                    title:'{$this->langtempl->login_title}'
                });
                EQ.OVR.content = '{$this->langtempl->login_buzy}<br/><img src=\'/lib/images/flat-loader.gif\' />';
                EQ.OVR.refresh('c').open();
                var pname = 'logincompletion';";
        for($i=0; $i<count($this->loginform); $i++){
            $script .="var {$this->loginform[$i]} = document.login.{$this->loginform[$i]}.value.toString();";
        }
        $script .="
                EQ.CPU.makeProcess({
                    name: pname,
                    process: function(resp){
                        var json = EQ.jsp(resp);
                        if(json.error){
                            $('#login'+json.error).html(EQ.messages['form-wrong']).removeClass('succes').addClass('wrong');
                            EQ.OVR.close();
                        }else if(json.succes){
                            if(json.succes=='positive'){
                                EQ.OVR.content='Het is gelukt!<br/><img src=\'/lib/images/flat-loader.gif\' />';
                                EQ.OVR.refresh('c');
                                EQ.change('home');
                            }else if(json.reason && json.reason=='no-access'){
                                EQ.OVR.content='Het is niet gelukt!';
                                EQ.OVR.refresh('c');
                                EQ.change('home');
                            }else{
                                EQ.OVR.content='Der is iets grandioos mislukt!';
                                EQ.OVR.refresh('c');
                            }
                        }
                        //laad ook userobjecten in..
                        }
                });
                EQ.CPU.newRequest({
                    process: pname,
                    url:'http://www.equinsi.be/equinsi/nl/login/login/',
                    parameters:'";
        for($i=0; $i<count($this->loginform); $i++){
            $script.="{$this->loginform[$i]}='+{$this->loginform[$i]}";
            if(($i+1)<count($this->loginform))$script.="+'&";
        }
        $script.="
                });
                EQ.CPU.startProcess(pname);
            }
            $('#login-form').bind('click',function(){
                var b = true;
                if(!EQ.formCheck(document.login.email,'x','x','login',true)) b = false;
                if(!EQ.formCheck(document.login.password,8,30,'login')) b = false;
                if(b){
                    $('#loginsubmit').removeClass('wrong').addClass('succes').html(EQ.messages['form-complete']);
                    logincompletion();
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
        $content = "<div id='home'><h3>Welkom bij ecareplan!</h3><h5>Het online zorgplatform van Listel vzw.</h5><p>Je moet je inloggen om verder te gaan!</p>
            <form name='login'><div class='centered'><input name='{$this->loginform[0]}' type='email' placeholder='e-mail voor login' class='login'/><span id='loginemail' class='form-error'></span>
                <br/><input name='{$this->loginform[1]}' type='password' placeholder='Wachtwoord' class='login'/><span id='loginpassword' class='form-error'></span>
                <br/><input type='button' id='login-form' value='Aanmelden' class='login'/><span id='loginsubmit' class='form-error'></div></form><p>hier oook wat content...</p></div>
           ";
        return array("content" => $content, "headscript" => $script);
    }
}

?>
