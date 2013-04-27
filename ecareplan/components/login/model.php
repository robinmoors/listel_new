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
    private $formerror = 0;

    public function __CONSTRUCT() {
        $this->loginform = ECPFactory::getForm("login");
        $this->loginform->addField(new ECP_FormObj_Email("email"));
        $this->loginform->addField(new ECP_FormObj_Password("password", 8, 30));
        $this->loginform->addField(new ECP_FormObj_Button("Aanmelden"));
    }

    public function login() {
        /*
        $db = ECPFactory::getDbo();
         * */
        ecpimport("helpers.cryptology");
        $db = ECPFactory::getPDO("Logins");
        
        $pasw = 'c17a1a963e2b9ebb228030c0615fdb4bd91bd982';
        $login = 'joris-rdc';
                
        $log=new Logins();
        $log->setLogin($login) ->setPaswoord($pasw);
        $results = Logins::findByExample($db, $log);
        foreach ($results as $result) {
            $id = $result->getId();
            $result->setIpadres($_SERVER['REMOTE_ADDR']);
            $result->updateToDatabase($db);
        }
       
        
        //$pasw = ECP_Cryptology::generateHash(trim($post['password']));
        /*
        $where = array("email", "pasw");
        $wheres = array($email, $pasw);
        $echeck = $db->newQuery("select", "echeck")->table("logins")->where($where, $wheres, "=", "AND")->execute();
        if (!$echeck->getRows()) {
            //ongeldig, ww en e komt niet overeen!
            return false;
        } else {
         */
          
            //access dus we gaan een loginpin geven ;)
        /*
            $uid = $echeck->getSingleResult();
            $loginpin = ECP_Cryptology::generateInteger(30);
            $pinhash = ECP_Cryptology::generateHash($loginpin);
            
            $logtodb = $db->newQuery("update", "login")->table("logins")->updateset(array('loginpin', 'ipadres'), array($pinhash, $_SERVER['REMOTE_ADDR']))->where($where, $wheres, "=", "AND")->execute();
            if ($logtodb->getRows())
                return array("uid"=>$uid["id"],"pin"=>$loginpin);
            else
                return 2;
            exit();
            */
            //return array("uid"=>$uid["id"],"pin"=>$loginpin);
            return array("uid"=>$id,"pin"=>$loginpin);
        //}
        
    }

    public function loginpage() {
        $script = $this->loginform->getScript("/listel_new/ecareplan/login/login/",
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
        
        
        
        return array("content" => $content, "headscript" => $script);
    }

}

?>
