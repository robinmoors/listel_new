<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OverlegView implements ECP_OverlegObservable{

    private $app;
    private $content;
    private $title;
    private $script;
    private $observer = array();

    public function __CONSTRUCT($app) {
        $this->app = $app;
        $this->app->setTemplate("listel");
    }
    //begin Observer pattern (Subject)
    public function attach(ECP_OverlegObserver $obs){
        $this->observer["$obs"] = $obs;
    }
    public function detach(ECP_OverlegObserver $obs){
        delete($this->observers["$obs"]);
    }
    public function notify($message){
        foreach($this->observers as $obs){
            $obs->update($this,$message);
        }
    }
    //end Observer pattern (Subject)
    
    public function viewList($data) {
        $keys = array('id', 'code', 'naam', 'voornaam', 'gebdatum', 'geboordeplaats', 'adres');
        $keysnamed = array('#', 'Code', 'Naam', 'Voornaam', 'Geboortedatum', 'Geboorteplaats', 'Adres');
        $content = "<a class='RoundedButton2 login' href='' onclick='EQ.reRoute(\"overlegnieuw\",true);'>Nieuw overleg</a><br/><table id='ShowTable' class='wider'><tr id='TableHead'>";
        for ($i = 0; $i < count($keys); $i++) {
            $content.="<td>{$keysnamed[$i]}</td>";
        }
        $content.="</tr>";
        foreach ($data as $patient) {
            $content.="<tr id='TableRow' onclick='EQ.reRoute(\"overlegbewerk\",true,{$patient[0]});'>";
            for ($i = 0; $i < count($keys); $i++) {
                $content.="<td>{$patient[$keys[$i]]}</td>";
            }
        }
        $content.="</table>";
        $this->content = $content;
        $this->title = "Patientenlijst";
        $this->export();
    }

    public function editOverleg($data, $form) {
        if ($data == null) {
            $this->content = "Oeps geen of te veel overleggen gevonden voor deze patient. <a onclick='EQ.reRoute(\"overleg\",true)'>Keer terug naar patientenlijst.</a>";
            $this->export();
        } else {
            $script = $form->getScript("/listel_new/ecareplan/login/login/", array("title" => "Aanmelden",
                "action" => "Bezig met aanmelden...",
                "succes" => "U bent aangemeld <br/><img src=\'/listel_new/lib/images/flat-loader.gif\' />",
                "fail" => "Er is iets misgegaan. Probeer opnieuw!"), "EQ.reRoute('home');", "", "else if(json.reason && json.reason=='no-access'){
                                EQ.OVR.content='Emailadres of wachtwoord fout!';
                                EQ.OVR.refresh('c');
                            }");
            $content = "";
            $content.=$form->getHtml("normal", array("overleg_locatie_id" => "Plaats van het overleg:", "aanwezig_patient" => "Wie is er aanwezig op het overleg?", "overleg_instemming" => "Instemming met de deelnemers van het overleg. De pati&euml;nt of vertegenwoordiger?"));


            $this->title = "Overleg bewerken";
            $this->content = $content;
            $this->script = $script;
            $this->export();
        }
    }

    public function newOverleg($step, $data, $form) {
        if ($data == null) {
            $this->content = "De opgegeven patient werd niet gevonden! <a onclick='EQ.reRoute(\"overleg\",true)'>Keer terug naar patientenlijst.</a>";
            $this->export();
        } else {
            if($data[0]) $patient = $data[0]; else $patient = $data;
            $script = $form[0]->getScript("/listel_new/ecareplan/login/login/", array("title" => "Aanmelden",
                "action" => "Bezig met aanmelden...",
                "succes" => "U bent aangemeld <br/><img src=\'/listel_new/lib/images/flat-loader.gif\' />",
                "fail" => "Er is iets misgegaan. Probeer opnieuw!"), "EQ.reRoute('home');", "", "else if(json.reason && json.reason=='no-access'){
                                EQ.OVR.content='Emailadres of wachtwoord fout!';
                                EQ.OVR.refresh('c');
                            }");
            $content = "<div class='box'>
                            <h5>Pati&euml;ntinfo</h5>
                            Rijksregisternummer: {$patient['rijksregister']} <br/>
                            Volgnummer: SO98 - {$patient['code']} <br/>
                            Pati&euml;ntnaam: {$patient['naam']} <br/>
                        </div>
                        <div class='box' id='step_1'>
                            <h5>Stap 1: De organisator van het overleg</h5>
                            ";
            $content.=$form[0]->getHtml("normal", array("organisator" => "Kies een organisator voor het overleg:<br/>"));
            $content .="</div>";

            $this->title = "Overleg toevoegen";
            $this->content = $content;
            $this->script = $script;
            $this->export();
        }
    }

    public function selectPatient($data, $form) {
        if ($data == null) {
            $this->content = "Oeps geen of te veel overleggen gevonden voor deze patient. <a onclick='EQ.reRoute(\"overleg\",true)'>Keer terug naar patientenlijst.</a>";
            $this->export();
        } else {
            //we nemen hier geen normaal formscript maar maken een reRoute adhv de geselecteerde patient
            $script = "$('#patient_select-form').bind('click',function(){EQ.reRoute('overlegnieuw',true,document.patient_select.patientlist.value+'/1/')});";
            $content = "";
            $content.=$form->getHtml("normal", array("patientlist" => "Selecteer een patient om een overleg mee te starten.", "overleg_locatie_id" => "Plaats van het overleg:", "aanwezig_patient" => "Wie is er aanwezig op het overleg?", "overleg_instemming" => "Instemming met de deelnemers van het overleg. De pati&euml;nt of vertegenwoordiger?"));


            $this->title = "Overleg toevoegen";
            $this->content = $content;
            $this->script = $script;
            $this->export();
        }
    }

    private function export() {
        $this->app->setTemplateData(array("content" => $this->content, "content-title" => "Overleg", "content-sub-title" => $this->title, "title" => "Ecareplan ~ " . $this->title, "headscript" => $this->script));
    }

}

?>