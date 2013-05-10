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
        $this->ouderzorg();
    }

    public function ouderzorg() {
        ecpimport("components.omb.listel.ombform");
        $formmodel = new ECP_Comp_OmbForm();
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $contactwijze = $this->model->getContactwijze();
            $probleemfactor = $this->model->getProbleemfactor();
            
            $formmodel->updateContactwijzeList($contactwijze);
            $formmodel->updateProbleemfactorList($probleemfactor);
            $this->view->viewBase($formmodel->getBaseForm());
        } else {
            echo '{"succes":"negative","message":"Oei het loopt even mis!<br/>De server ontving geen waarden van het formulier..."}';
            ecpexit();
        }
    }

    public function nieuw() {
        ecpimport("components.omb.listel.ombform");
        $formmodel = new ECP_Comp_OmbForm();
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $contactwijze = $this->model->getContactwijze();

            $formmodel->updateContactwijzeList($contactwijze);
            $this->view->viewBase($formmodel->getBaseForm());
        } else {
            echo '{"succes":"negative","message":"Oei het loopt even mis!<br/>De server ontving geen waarden van het formulier..."}';
            ecpexit();
        }
    }

}

?>
