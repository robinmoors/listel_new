<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OverlegView {

    private $app;
    private $content;
    private $title;
    private $script;

    public function __CONSTRUCT($app) {
        $this->app = $app;
        $this->app->setTemplate("listel");
    }

    public function viewList($data) {
        $keys = array('id', 'code', 'naam', 'voornaam', 'gebdatum', 'geboordeplaats', 'adres');
        $keysnamed = array('#', 'Code', 'Naam', 'Voornaam', 'Geboortedatum', 'Geboorteplaats', 'Adres');
        $content = "<table id='ShowTable' class='wider'><tr id='TableHead'>";
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
            $content.=$form->getHtml();


            $this->title = "Overleg bewerken";
            $this->content = $content;
            $this->script = $script;
            $this->export();
        }
    }

    private function export() {
        $this->app->setTemplateData(array("content" => $this->content, "content-title" => $this->title, "title" => "Ecareplan ~ " . $this->title, "headscript" => $this->script));
    }

}

?>