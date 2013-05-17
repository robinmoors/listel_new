<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of overleg
 *
 * @author robindell
 */
class ECP_Comp_Omb_Controller implements ECP_ComponentController {

    protected $action = null;
    protected $vars = null;
    protected $model = null;
    protected $view = null;
    protected $app = null;
    protected $user = null;

    public function __CONSTRUCT() {
        ecpimport("components.overleg.overlegobserver"); //observer interface
        ecpimport("components.overleg.overlegobservable"); //observable (subject) interface
        ecpimport("components.omb.ombmodel"); //std model
        ecpimport("components.omb.ombview"); //std view
        $this->action = "std_command";
        $this->app = ECPFactory::getApp(); //haal de app op om template te gaan veranderen
        $this->user = $this->app->getUser(); //via de app de user ophalen zodat we zeker de huidige user hebben :)
        $this->model = new ECP_Comp_OmbModel($this->user->getUserId());
        $this->view = new ECP_Comp_OmbView($this->app);
    }

    public function command($command) {
        if ($command == "command" || !is_callable(array(&$this, $command))) {
            $command = "command_error";
        }
        $this->action = $command;
    }

    public function command_error() {
        $this->std_command();
    }

    public function execute() {
        call_user_func(array(&$this, $this->action));
    }

    public function params($vars) {
        $this->vars = $vars;
    }

    public function lijst() {
        $this->std_command();
    }

    public function std_command() {
        $ombs = $this->model->getOmbs();
        $this->view->viewListOmb($ombs);
    }

    public function bewerk(){
        $this->nieuw();
    }
    
    public function nieuw(){
        ecpimport("components.omb.listel.ombform");
        $formmodel = new ECP_Comp_OmbForm();
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            /*
             * Model
             */
            $contactwijze = $this->model->getContactwijze();
            $relatie = $this->model->getHoofdrelatie();
            //$probleemfactor = $this->model->getProbleemfactor();
            
            //$test = $this->model->testFunction();
            /*
             * Form
             */
            $formmodel->updateContactwijzeList($contactwijze);
            $formmodel->updateHoofdrelatieList($relatie);
            /*
             * View
             */
            $this->view->viewMeldingForm($formmodel->getForm("melding"));
        } else {
            echo '{"succes":"negative","message":"Oei het loopt even mis!<br/>De server ontving geen waarden van het formulier..."}';
            ecpexit();
        }
    }
    
    public function checkOmb(){
        $form = ECPFactory::getForm("base");
        $form->smartInsert($_POST);
        $rapport = $form->validate();
        if(is_array($rapport)){
          echo '{"error":"'.$rapport[0][0].'"}'; //eerste index:: 1. velden met fouten, 2. fout per veld, 3. aantal fouten totaal.
          exit(); //geen view doen :)
        } else{
            $omb = $this->model->newOmb();
        }
    }
}

?>
