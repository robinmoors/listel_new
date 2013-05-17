<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_Error_Model {

    private $appobj = null;

    public function __CONSTRUCT() {
        $this->appobj = ECPFactory::getApp(); //haal de app op zodat we de template kunnen wijzigen!
        $this->appobj->setTemplate("unknownrequest");
    }

    public function wrongUrl() {
        $content = "Error 404! Dat is dus niet goed. Hoe komt u die tegen?<br/>
            <ul><li>Mogelijk hebt u een verkeerde url ingetypt! Kijk hem even na, hij ziet eruit als &quot;ecareplan/doe/iets/vanA/totZ&quot;</li>
            <li>U hebt op een onjuiste link geklikt! Als je deze fout blijft tegenkomen kan je die melden...</li>
            <li>In ieder geval kunnen we de gevraagde pagina niet laden...</li>
            </ul>";
        $tdata = array("content" => $content);
        $this->appobj->setTemplateData($tdata);
    }

    public function example() {
        $content = "Error 200! Dat is dus niet erg! Juist ok :D<br/>
            <ul><li>Normaal ziet u hier foutmeldingen en oplossingen opgesomd</li>
            <li>Maar u heeft duidelijk gevraagd om een error te tonen!</li>
            <li>U krijgt bij een error deze pagina te zien, maar dan met betere uitleg, en over een echte fout!</li>
            </ul>";
        $tdata = array("content" => $content);
        $this->appobj->setTemplateData($tdata);
    }
    
    public function serverError() {
        $content = "Error 500! Dat betekent dat de server het noorden kwijt is...<br/>
            <ul><li>U kan proberen de pagina te vernieuwen om te zien of de server weer bij positieven is.</li>
            <li>Als u deze fout dan nog steeds ziet, betekent dit een echte serverfout!</li>
            <li>U kan deze fout melden, maar verder kan u helaas niets doen...</li>
            <li>Waarschijnlijk hebben de programmeurs de fout al ontdekt en werken ze aan een oplossing!</li>   
            </ul>";
        $tdata = array("content" => $content);
        $this->appobj->setTemplateData($tdata);
    }

}

?>
