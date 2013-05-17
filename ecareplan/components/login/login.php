<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller for Login component
 * @author Robin Moors
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_Login_Controller implements ECP_ComponentController {

    protected $action = null;
    protected $vars = null;
    protected $model = null;
    protected $app = null;

    public function __CONSTRUCT() {
        ecpimport("components.login.model");
        $this->model = new ECP_Comp_Login_Model();
        $this->action = "std_command";
    }

    public function command($command) {
        if ($command == "command" || !is_callable(array(&$this, $command))) {
            $command = "command_error";
        }
        $this->action = $command;
    }

    public function command_error() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            echo '{"succes":"negative","reason":"unknown request","error":"404"}';
            exit();
        }
        $this->std_command();
    }

    public function execute() {
        call_user_func(array(&$this, $this->action));
    }

    public function params($vars) {
        $this->vars = $vars;
    }

    /* Commands */

    public function std_command() {
        $this->app = ECPFactory::getApp(); //haal de app op zodat we de template kunnen wijzigen!
        $tdata = $this->model->loginpage();
        $this->app->setTemplate('login');
        $this->app->setTemplateData($tdata);
    }

    public function login() {
        //   if($_SERVER['REQUEST_METHOD']=="POST"){
        $form = ECPFactory::getForm("login");
        $form->smartInsert($_POST);
        $rapport = $form->validate();
        /* if(is_array($rapport)){
          echo '{"error":"'.$rapport[0][0].'"}'; //eerste index:: 1. velden met fouten, 2. fout per veld, 3. aantal fouten totaal.
          exit(); //geen view doen :)
          }else{ */
        //this in orde dus hier iets met model gaan doen
        $login = $this->model->login();
        if (!$login) {
            echo '{"succes":"negative","reason":"no-access"}';
            exit();
        } elseif ($login === 2) {
            echo '{"succes":"negavive","reason":"database"}';
            exit();
        } else {
            echo '{"succes":"positive","uid":"' . $login["uid"] . '","pin":"' . $login["pin"] . '"}';
            exit();
        }
        //}
        // }else{
        //     $this->std_command();
        // }
    }

    public function eid() {
        include "openid.php";
        $openid = new LightOpenID('localhost');
        if ($openid->mode) {
            $session = ECPFactory::getSession();
            ecpimport("helpers.cryptology");
            $loginpin = ECP_Cryptology::generateInteger(30);
            $pinhash = ECP_Cryptology::generateHash($loginpin);

            $user = $openid->getAttributes();
            $achternaam = $user["namePerson/last"];
            $postcode = $user["contact/postalCode/home"];
            $adres = $user["contact/postalAddress/home"];
            $db = ECPFactory::getPDO("Logins");
            $log = new Logins();
            $log->setAdres($adres)->setOverlegGemeente($postcode)->setNaam($achternaam);
            $results = Logins::findByExample($db, $log);
            if (empty($results)) {
                //email en ww komt niet overeen
                ecpexit("exit");
            } else {
                foreach ($results as $result) {
                    $id = $result->getId();
                    $result->setIpadres($_SERVER['REMOTE_ADDR'])->setLoginpin($pinhash);
                    $count = $result->updateToDatabase($db);
                    if ($count != l)
                        return 2; //fout bij updaten dus geen access!
                    else {
                        ecpexit("uid=>$id,pin=>$loginpin");
                    }
                }
            }
        } else {
            //Step 2: Authentication, with requirements
            $openid->identity = 'https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident';
            $openid->required = array('namePerson/first', 'namePerson/last',
                'namePerson', 'person/gender', 'contact/postalCode/home',
                'contact/postalAddress/home', 'contact/city/home', 'eid/nationality',
                'eid/pob', 'birthDate', 'eid/card-number', 'eid/card-validity/begin',
                'eid/card-validity/end');
            //$openid->optional = array('');
            header('Location: ' . $openid->authUrl());
        }
    }

}

?>
