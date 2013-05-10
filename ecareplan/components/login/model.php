<?php
//include_once '../../database/Logins.class.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_Login_Model {

    private $appobj = null;
    private $registerform = array("fname", "name", "email", "password");
    private $loginform = array("email", "password");
    private $eidform;
    private $formerror = 0;

    public function __CONSTRUCT() {
        $this->loginform = ECPFactory::getForm("login");
        $this->loginform->addField(new ECP_FormObj_Input("login",3,30));
        $this->loginform->addField(new ECP_FormObj_Password("password", 8, 30));
        $this->loginform->addField(new ECP_FormObj_Button("Aanmelden"));
        $this->eidform = ECPFactory::getForm("eid");
        $this->eidform->addField(new ECP_FormObj_NormalButton("eid","Login met eID"));
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
    public function login() {
        /*
        $db = ECPFactory::getDbo();
         * */
        ecpimport("helpers.cryptology");
        $db = ECPFactory::getPDO("Logins");
        
        $pasw = 'c17a1a963e2b9ebb228030c0615fdb4bd91bd982';
        //$pasw = ECPFactory::getForm("login")->pasw->value;
        $login = 'joris-rdc';
        
        $loginpin = ECP_Cryptology::generateInteger(30);
        $pinhash = ECP_Cryptology::generateHash($loginpin);
        
        
        $log=new Logins();
        $log->setLogin($login)->setPaswoord($pasw);
        $results = Logins::findByExample($db, $log);
        if(empty($results)){
            //email en ww komt niet overeen
            return false;
        }else{
            foreach ($results as $result) {
                $id = $result->getId();
                $result->setIpadres($_SERVER['REMOTE_ADDR'])->setLoginpin($pinhash);
                $count = $result->updateToDatabase($db);
                if($count!=l) return 2; //fout bij updaten dus geen access!
                else{
                    return array("uid"=>$id,"pin"=>$loginpin);
                }
            }
        }
    }

    public function loginpage() {
        $script = "$('#eid-eid').bind('click',function(){EQ.reRoute('eid',true);});";
        $script .= $this->loginform->getScript("/listel_new/ecareplan/login/login/",
                array("title"=>"Aanmelden",
                    "action"=>"Bezig met aanmelden...",
                    "succes"=>"U bent aangemeld <br/><img src=\'/listel_new/lib/images/flat-loader.gif\' />",
                    "fail"=>"Er is iets misgegaan. Probeer opnieuw!"),
                "EQ.reRoute('home');","",
                "else if(json.reason && json.reason=='no-access'){
                                EQ.OVR.content='Emailadres of wachtwoord fout!';
                                EQ.OVR.refresh('c');
                            }");
        $content = "<div id='home'><h3>Welkom bij ecareplan!</h3><h5>Het online zorgplatform van Listel vzw.</h5><p>Je moet je inloggen om verder te gaan!</p>";
        $content.=$this->loginform->getHtml(
                "login", array("email" => "Email voor login",
            "password" => "Wachtwoord")
        );
        $content.=$this->eidform->getHtml("login",array());
        
        
        
        return array("content" => $content, "headscript" => $script);
    }

}

?>
