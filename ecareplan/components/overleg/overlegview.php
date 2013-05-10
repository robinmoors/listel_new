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
    
    private $stack='';

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
        if(empty($this->observers)) return $this; //indien er niemand meekijkt snel wegwezen!
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
        $this->state = "view.".$state;
        if($old !== $this->state) $this->notify(); //autonotify on statechange...
        return $this;
    }
    //End Observer pattern (Subject
    //Start special observer methods
    public function getStack(){
        return $this->stack;
    }
    public function setStack($stack){
        $this->stack = $stack;
        return $this;
    }
    //End special observer methods

    public function viewList($data) {
        $this->setState("viewlist.start"); //naam.actie!
        
        $keys = array('id', 'patient_code', 'rijksregister', 'naam_aanvrager', 'timestamp');
        $keysnamed = array('#', 'Patient Code', 'Rijksregister', 'Aanvrager', 'Datum aanvraag');
        $this->setState("viewlist.content.start");
        
        $content = "<a class='RoundedButton2 login' href='' onclick='EQ.reRoute(\"overlegnieuw\",true);'>Nieuw overleg</a><br/><table id='ShowTable' class='wider'><tr id='TableHead'>";
        for ($i = 0; $i < count($keys); $i++) {
            $content.="<td>{$keysnamed[$i]}</td>";
        }
        $content.="</tr>";
        if($data!=null){
        foreach ($data as $patient) {
            $content.="<tr id='TableRow' onclick='EQ.reRoute(\"overlegbewerk\",true,{$patient[0]});'>";
            for ($i = 0; $i < count($keys); $i++) {
                $content.="<td>{$patient[$keys[$i]]}</td>";
            }
        }
        }else{
            $content.="<tr id='TableRow'><td colspan='".count($keys)."'><em>Geen overleggen beschikbaar om te bewerken. Kies nieuw overleg.</em></td></tr>";
        }
        $content.="</table>";
        $this->stack=$content;
        $this->setState("viewlist.content.end");
        
        $this->title = "Patientenlijst";
        $this->moveToContent();
        
        $this->setState("viewlist.end");
        $this->export();
    }
    
    public function viewOverlegList($data) {
        $this->setState("viewoverleglist.start");
        $keys = array('id', 'startdatum', 'afronddatum', 'afgerond', 'subsidiestatus');
        $keysnamed = array('#', 'Start', 'Afgerond op', 'Afgerond', 'Status subsidie');
        
        $this->setState("viewoverleglist.content.start");
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
        $this->stack = $content;
        
        $this->setState("viewoverleglist.content.end");
        $this->title = "Overleg bewerken";
        $this->moveToContent();
        
        $this->setState("viewoverleglist.end");
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

    public function newOverleg($data, $pat_id, $form) {
        $this->setState("newoverleg.start");
        $this->setState("newoverleg.content.start");
        if ($data == null) {
            $this->stack .= "De opgegeven patient werd niet gevonden! <a onclick='EQ.reRoute(\"overleg\",true)'>Keer terug naar patientenlijst.</a>";
            $this->setState("newoverleg.content.end");
            $this->moveToContent();
            $this->setState("newoverleg.end");
            $this->export();
        } else {
            $this->setState("newoverleg.content.info.start");
            if($data[0]) $patient = $data[0]; else $patient = $data;
            $huidigtoegewezen = $patient["toegewezen"] === 1 ? $patient['toegewezen'] === null ? $patient['toegewezen'] : "Is dit een oude patient?" : "Het OCMW van de gemeente.";
            $content = "<div class='box'>
                            <h5>Pati&euml;ntinfo</h5>
                            Rijksregisternummer: {$patient['rijksregister']} <br/>
                            Volgnummer: SO98 - {$patient['code']} <br/>
                            Pati&euml;ntnaam: {$patient['naam']} <br/>
                        </div>";
            $this->stack .= $content;
            $this->setState("newoverleg.content.info.end");
            $this->moveToContent();
            
            $this->setState("newoverleg.content.step1.start");
            $stap1="
                        <div class='box' id='step_1'>
                            <h5>Stap 1: De organisator van het overleg</h5>
                            <div id='huidig'>De huidige organisator van het overleg is:<br/><strong>{$huidigtoegewezen}</strong><br/>
                                Is deze keuze correct?<br/><form name='huidig_organisator'><input type='radio' name='huidigok' value='1' id='huidigja' checked='checked'/> Ja<br/><input type='radio' name='huidigok' value='0' id='huidignee'/> Nee
                            </form></div><div id='niethuidig' class='hidden'>
                            ";
            $stap1.=$form[0]->getHtml("normal", array("organisator" => "Kies een organisator voor het overleg:<br/>")).
                      "<div id='rdc' class='hidden'>".$form[1]->getHtml("normal",array("rdclist"=> "Welk regionaal dienstencentrum?<br/>")).
                      $form[2]->getHtml("normal",array("rdcwhy"=>"Waarom dit dienstencentrum?<br/>"))."</div><div id='za' class='hidden'>".
                      $form[3]->getHtml("normal",array("zalist"=> "Welke zorg aanbieder?<br/>")).
                      $form[4]->getHtml("normal",array("zawhy"=>"Waarom deze zorgaanbieder?<br/>"))."</div><div id='psy' class='hidden'>".
                      $form[5]->getHtml("normal",array("psylist"=> "Welke zorg aanbieder?<br/>")).
                      $form[6]->getHtml("normal",array("psywhy"=>"Waarom deze zorgaanbieder?<br/>"))."</div>";
            $stap1 .="</div><div id='reden' class='hidden'>Reden:<br/><form name='organisator_reden'><textarea name='reden' id='reden'></textarea></form></div></div>";
            $this->stack .= $stap1;
            $this->setState("newoverleg.content.step1.end");
            $this->moveToContent();
            
            $this->setState("newoverleg.content.step2.start");
            $stap2="
                    <div class='box hidden' id='step_2'>
                            <h5>Stap 2: Doel van het overleg</h5>
                            ".$form[7]->getHtml("normal",array("informeren"=>"Informeren","debriefen"=>"Debriefen","ander"=>"Ander doel","overtuigen"=>"Overtuigen","organiseren"=>"Organiseren","beslissen"=>"Beslissen"))."
                        <div id='ander' class='hidden'><form name='ander'><textarea name='ander'></textarea></form></div>
                        </div>";
            $this->stack.=$stap2;
            $this->setState("newovlerg.content.step2.end");
            $this->moveToContent();
            
            $this->setState("newoverleg.content.step3.start");
            $stap3="
                    <div class='box hidden' id='step_3'>
                            <h5>Stap 3: Informatie aanvrager</h5>
                            ".$form[8]->getHtml("normal",array(
                                "naam"=>"Naam en voornaam",
                                "relatie"=>"Relatie tot pati&euml;nt:",
                                "telefoon"=>"Telefoonnummer",
                                "email"=>"Of emailadres",
                                "organisatie"=>"Naam organisatie"
                            ))."</div>";
            $this->stack.=$stap3;
            $this->setState("newoverleg.content.step3.end");
            $this->moveToContent();
            
            $this->setState("newoverleg.content.step4.start");
            $stap4="
                    <div id='step_4' class='box'>
                        U heeft alle nodige velden ingevuld. Indien u zeker bent dat alles juist is kan u verder.<br/>
                        <input type='button' id='send' name='verzenden' value='Verzenden'/>
                    </div>";
            $this->stack.=$stap4;
            $this->setState("newoverleg.content.step4.end");
            $this->moveToContent();
            
            $this->setState("newoverleg.content.end");
            $this->moveToContent(); //toch nog even moven indien observers nog iets hadden toegevoegd!
            
            unset($stap1); unset($stap2); unset($stap3); unset($stap4); unset($content);
            
            $this->setState("newoverleg.script.start");
            $this->setState("newoverleg.script.base.start");
            $script = "
                //Basic validation functions
                
                radioValue = function(radio){
                    var size = radio.length;
                    for(i=0; i<size; i++){
                        if(radio[i].checked) return radio[i].value;
                    };
                    return null;
                };
                
                //Variables
                
                var niethuidighidden = true;
                var step2hidden = true;
                var step3hidden = true;
                var rdchidden = true;
                var zahidden = true;
                var psyhidden = true;
                
                //Ajax Process
                
                var pname = 'nieuwoverleg';
                EQ.CPU.makeProcess({
                    name: pname,
                    process: function(resp){
                        var json = EQ.jsp(resp);
                        if(json.error){
                            $('#'+json.error).html(EQ.messages['form-wrong']).removeClass('succes').addClass('wrong');
                            EQ.OVR.close();
                        }else if(json.succes){
                            if(json.succes=='positive'){
                                EQ.OVR.content=json.message;
                                EQ.OVR.refresh('c');
                                EQ.login(json);
                                endNewOverleg();
                            }else{
                                EQ.OVR.content=json.message;
                                EQ.OVR.refresh('c');
                                EQ.login(json);
                            };
                        };
                    }
               });
               var newoverleg =  setInterval(function(){checkNewOverleg();},50);
                endNewOverleg = function(){
                    newoverleg = false;
                    checkOrganisatie(false);
                    step2hidden = true;
                    EQ.reRoute('overleg');
                };";
            $this->stack.=$script;
            $this->setState("newoverleg.script.base.end");
            $this->moveToScript();
            unset($script);
            $this->setState("newoverleg.script.collectvalues.start");
            $colval = "               
                collectValues = function(){
                        //stap 1
                        return {
                            huidigok : radioValue(document.huidig_organisator.huidigok),
                            organisator : radioValue(document.organisator_select.organisator),
                            rdclist : document.rdc_select.rdclist.value,
                            rdcwhy : radioValue(document.rdc_why.rdcwhy),
                            zalist : document.za_select.zalist.value,
                            psylist : document.psy_select.psylist.value,
                            zawhy : radioValue(document.za_why.zawhy),
                            psywhy : radioValue(document.psy_why.psywhy),
                            reden : document.organisator_reden.reden.value,
                            informeren : document.purpose.informeren.checked,
                            overtuigen : document.purpose.overtuigen.checked,
                            organiseren : document.purpose.organiseren.checked,
                            debriefen : document.purpose.debriefen.checked,
                            beslissen : document.purpose.beslissen.checked,
                            ander : document.purpose.ander.checked,
                            andertxt : document.ander.ander.value,
                            naam : document.requestor.naam.value,
                            relatie : document.requestor.relatie.value,
                            telefoon : document.requestor.telefoon.value,
                            email : document.requestor.email.value,
                            organisatie : document.requestor.organisatie.value
                        };
                };";
            $this->stack.=$colval;
            $this->setState("newoverleg.script.collectvalues.end");
            $this->moveToScript();
            unset($colval);
            $this->setState("newoverleg.script.checknewoverleg.start");
            $check = "
                checkNewOverleg = function(){
                    var values = collectValues();
                    if(values.huidigok == '0'){
                        $('#niethuidig').show();
                        niethuidighidden = false;
                        if(checkOrganisator(values)){ //organisatievelden controleren
                            $('#step_2').show(function(){step2hidden = false;});
                        }else{
                            $('#step_2').hide(function(){step2hidden = true;});
                        }
                    }else if(values.huidigok == '1'){
                        $('#niethuidig').hide();
                        checkOrganisator(false); //organisatievelden laten verdwijnen
                        niethuidighidden = true;
                        $('#step_2').show(function(){step2hidden = false;});
                    };
                    if(checkDoelen(values)){ //naar stap 2....
                        $('#step_3').show(function(){step3hidden = false;});
                    }else{
                        $('#step_3').hide(function(){step3hidden = true;});
                    }
                };";
            $this->stack.=$check;
            $this->setState("newoverleg.script.checknewoverleg.end");
            $this->moveToScript();
            unset($check);
            $this->setState("newoverleg.script.checkorganisator.start");
            $org = "
                checkOrganisator = function(values){
                    if(!values){
                        rdchidden = true; zahidden = true; psyhidden = true;
                        $('#rdc').hide(function(){ $('#psy').hide(function(){ $('#za').hide(function(){ $('#redenhide').hide()})})});
                        return true;
                    }else{
                        switch(values.organisator){
                            default: case '0': checkOrganisator(false); break;
                            case '1': if(rdchidden) $('#rdc').show(function(){rdchidden=false;}); 
                                      if(!zahidden) $('#za').hide(function(){zahidden = true;});
                                      if(!psyhidden) $('#psy').hide(function(){psyhidden = true;}); break;
                            case '2': if(zahidden) $('#za').show(function(){zahidden = false;});
                                      if(!rdchidden) $('#rdc').hide(function(){rdchidden=true;}); 
                                      if(!psyhidden) $('#psy').hide(function(){psyhidden = true;}); break;
                            case '3': if(!zahidden) $('#za').hide(function(){zahidden = true;});
                                      if(!rdchidden) $('#rdc').hide(function(){rdchidden=true;}); 
                                      if(psyhidden) $('#psy').show(function(){psyhidden = false;}); break;
                        };
                        if(rdchidden && zahidden && psyhidden){
                            $('#reden').hide();
                            return true;
                        }else{
                            if((values.rdcwhy == '2' && !rdchidden) || (values.zawhy == '2' && !zahidden) || (values.psywhy == '2' && !psyhidden)){
                                $('#reden').show();
                                if(values.reden.length > 3) return true;
                                else return false;
                            }else{
                                $('#reden').hide();
                                return true;
                            };
                        };
                    };
                };";
            $this->stack.=$org;
            $this->setState("newoverleg.script.checkorganisator.end");
            $this->moveToScript();
            unset($org);
            $this->setState("newoverleg.script.checkdoelen.start");
            $doel = "
                checkDoelen = function(values){
                    if(step2hidden) return false;
                    else{
                        if((values.informeren || values.overtuigen || values.organiseren || values.debriefen || values.beslissen) && !values.ander){
                            $('#ander').hide();
                            return true;
                        }else if(values.ander){
                            $('#ander').show();
                            if(values.andertxt.length < 3) return false;
                            else return true;
                        }else{
                            $('#ander').hide();
                            return false;
                        };
                    };
                };";
            $this->stack.=$doel;
            $this->setState("newoverleg.script.checkdoelen.end");
            $this->moveToScript();
            unset($doel);
            $this->setState("newoverleg.script.submit.start");
            $submit = "                
               submitNewOverleg = function(values){
                    EQ.OVR = new EQ.overflow({
                        title:'Nieuw overleg'
                    });
                    EQ.OVR.content = 'Bezig met verzenden van het nieuwe overleg<br/><img src=\'/listel_new/lib/images/flat-loader.gif\' />';
                    EQ.OVR.refresh('c').open();
                    EQ.CPU.newRequest({
                        process: pname,
                        url: '/listel_new/ecareplan/overleg/nieuw/',
                        parameters: 'values='+JSON.stringify(values)+'&patid=".$pat_id."'
                    });
                    EQ.CPU.startProcess(pname);
               };
               $('#send').bind('click',function(){submitNewOverleg(collectValues());});
            ";
            $this->stack.=$submit;
            $this->setState("newoverleg.script.submit.end");
            unset($submit);
            $this->setState("newoverleg.script.end");
            $this->moveToScript(); //toch nog een move doen omdat observers iets kunnen toegevoegd hebben
            $this->title = "Nieuw overleg";
            
            $this->setState("newoverleg.end");
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
            $content.=$form->getHtml("normal", array("patientlist" => "Selecteer een patient om een overleg mee te starten."));


            $this->title = "Overleg toevoegen";
            $this->content = $content;
            $this->script = $script;
            $this->export();
        }
    }

    private function export() {
        $this->app->setTemplateData(array("content" => $this->content, "content-title" => "Overleg", "content-sub-title" => $this->title, "title" => "Ecareplan ~ " . $this->title, "headscript" => $this->script));
    }
    
    private function moveToContent(){
        $this->content.=$this->stack; $this->stack = '';
        return $this;
    }
    
    private function moveToScript(){
        $this->script.=$this->stack; $this->stack ='';
        return $this;
    }

}

?>