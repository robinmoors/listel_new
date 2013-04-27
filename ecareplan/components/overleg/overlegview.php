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
    private $state = "unset";

    public function __CONSTRUCT($app) {
        $this->app = $app;
        $this->app->setTemplate("listel");
        $this->state = "view.constructed";
    }
    //Begin Observer pattern (Subject)
    public function attach(ECP_OverlegObserver $obs){
        $i = array_search($obs, $this->observer);
        if($i===false){
            $this->observers[]=$obs;
        }
        return $this;
    }
    public function detach(ECP_OverlegObserver $obs){
        if(!empty($this->observers)){
            $i = array_search($obs, $this->observers);
            if($i !== false){
                delete($this->observers[$i]);
            }
        }
        return $this;
    }
    public function notify(){
        foreach($this->observers as $obs){
            $obs->update($this);
        }
        return $this;
    }
    public function getObservers() {
        return $this->observers;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $old = $this->state;
        $this->state = $state;
        if($old !== $this->state) $this->notify(); //autonotify on statechange...
        return $this;
    }
    //End Observer pattern (Subject
    
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
    
    public function viewOverlegList($data) {
        $keys = array('id', 'startdatum', 'afronddatum', 'afgerond', 'subsidiestatus');
        $keysnamed = array('#', 'Start', 'Afgerond op', 'Afgerond', 'Status subsidie');
        $content = "<div class='box'>
                            <h5>Pati&euml;ntinfo</h5>
                            Rijksregisternummer: {$data[0]['rijksregister']} <br/>
                            Volgnummer: SO98 - {$data[0]['code']} <br/>
                            Pati&euml;ntnaam: {$data[0]['naam']} <br/>
                    </div><div class='box'>Klik op een overleg om te bewerken.<br/><table id='ShowTable' class='wider'><tr id='TableHead'>";
        for ($i = 0; $i < count($keys); $i++) {
            $content.="<td>{$keysnamed[$i]}</td>";
        }
        $content.="</tr>";
        foreach ($data as $overleg) {
            $content.="<tr id='TableRow' onclick='EQ.reRoute(\"overlegbewerk\",true,\"{$overleg[0]}/{$overleg['id']}/\");'>";
            for ($i = 0; $i < count($keys); $i++) {
                $content.="<td>{$overleg[$keys[$i]]}</td>";
            }
        }
        $content.="</table></div>";
        $this->content = $content;
        $this->title = "Overleg bewerken";
        $this->export();
    }

    public function editOverleg($data, $form) {
        if ($data === null || $data === false) {
            $this->content = "Deze pati&euml;nt blijkt geen overleggen te hebben! <a onclick='EQ.reRoute(\"overleg\",true)'>Keer terug naar patientenlijst. (Ook om er een aan te maken)</a>";
            $this->export();
        } else {
            print_r($data);
            $content = "<div class='box'>
                            <h5>Pati&euml;ntinfo</h5>
                            <p>
                            Rijksregisternummer: {$data[0]['rijksregister']} <br/>
                            Volgnummer: SO98 - {$data[0]['code']} <br/>
                            Pati&euml;ntnaam: {$data[0]['naam']} <br/>
                            </p><h5>Gegevens overleg</h5>
                            <p>
                            Start van het overleg: {$data[0]['startdatum']}<br/>
                            Aanvrager: mr x
                            Doel: het doel
                    </div><div class='box inline'>
                                <h5>Basisgegevens:</h5><br/>";
            $content.=$form[0]->getHtml("normal", array("locatie" => "Plaats van het overleg:<br/>", "aanwezig" => "Wie is er aanwezig op het overleg?<br/>", "instemming" => "Instemming met de deelnemers van het overleg. De pati&euml;nt of vertegenwoordiger?<br/>"))
                    ."</div><div class='box inline'>
                                <h5>Teamoverleg:</h5><br/>
                                Hier komt een tabel met teamleden - hun rechten - teamleider.
                      </div><div class='box inline'>
                                <h5>Attesten en bijlagen</h5>
                      </div><div class='box inline'>
                                <h5>Taakfiches</h5>
                      </div><div class='box inline'>
                                <h5>Afdrukpagina</h5>
                      </div>";


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
            $content.=$form[0]->getHtml("normal", array("organisator" => "Kies een organisator voor het overleg:<br/>")).
                      $form[1]->getHtml("normal",array("rdclist"=> "Welk regionaal dienstencentrum?<br/>")).
                      $form[2]->getHtml("normal",array("rdcwhy"=>"Waarom dit dienstencentrum?<br/>")).
                      $form[3]->getHtml("normal",array("zalist"=> "Welke zorg aanbieder?<br/>")).
                      $form[4]->getHtml("normal",array("zawhy"=>"Waarom deze zorgaanbieder?<br/>")).
                      $form[5]->getHtml("normal",array("psylist"=> "Welke zorg aanbieder?<br/>")).
                      $form[6]->getHtml("normal",array("psywhy"=>"Waarom deze zorgaanbieder?<br/>"));
            $content .="</div><div class='box' id='step_2'>
                            <h5>Stap 2: Doel van het overleg</h5>
                            ".$form[7]->getHtml("normal",array("informeren"=>"Informeren","debriefen"=>"Debriefen","ander"=>"Ander doel","overtuigen"=>"Overtuigen","organiseren"=>"Organiseren","beslissen"=>"Beslissen"))."
                        </div><div class='box' id='step_3'>
                            <h5>Stap 3: Informatie aanvrager</h5>
                            ".$form[8]->getHtml("normal",array(
                                "naam"=>"Naam en voornaam",
                                "relatie"=>"Relatie tot pati&euml;nt:",
                                "telefoon"=>"Telefoonnummer",
                                "email"=>"Of emailadres",
                                "organisatie"=>"Naam organisatie"
                            ))."</div>";

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