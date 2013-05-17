<?php

defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OmbView implements ECP_OverlegObservable{
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
        if ($i === false) {
            $this->observers[] = $obs;
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
        $this->state = "viewomb.".$state;
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

    private function export() {
        $this->app->setTemplateData(array("content" => $this->content, "content-title" => "Oudermisbehandeling", "content-sub-title" => $this->title, "title" => "Ecareplan ~ Oudermisbehandeling - " . $this->title, "headscript" => $this->script));
    }

    private function moveToContent(){
        $this->content.=$this->stack; $this->stack = '';
        return $this;
    }

    private function moveToScript(){
        $this->script.=$this->stack; $this->stack ='';
        return $this;
    }

    public function viewMeldingForm($form){
        $this->setState("meldingform.start");
        $this->setState("meldingform.content.start");

        /**
         * 
         */
        /*
         * melding
         */
        $this->setState("meldingform.content.melding.start");
        $content = $form[0]->getHtml("normal",array("datum"=> "dd/mm/jjjj","contactwijzelijst"=>"Contactwijze","meldpunt"=>"Contactname met Vlaams Meldpunt (078/15.15.70)","meldersoort"=>"Melder-soort"));
        $this->stack.=$content;
        $this->setState("meldingform.content.melding.end");
        $this->moveToContent();
        
        /*
         * soortHvl
         */
        $this->setState("meldingform.content.melding.hvl.start");
        $meldinghvl = "<div class='box' id='meldinghvl' class='hidden'>
            <h5>Hulpverlener</h5>"
        .$this->content .= $form[1]->getHtml("normal",array("hulpverlener"=>"Naam")).
        "</div>";
        $this->stack .=$meldinghvl;
        $this->setState("meldingform.content.melding.hvl.end");
        $this->moveToContent();
        
        /*
         * soortAnders
         */
        $this->setState("meldingform.content.melding.anders.start");
        $meldinganders="<div class='box hidden' id='meldinganders'>
            <h5>Andere:</h5>".
                $form[2]->getHtml("normal",array("naam"=>"Naam","adres"=>"Adres","postcode"=>"Postcode","telefoon"=>"Telefoon","email"=>"e-mail","relatielist"=>"Relatie met het slachtoffer","detail"=>"Relatiedetails")).
                "</div>";
        $this->stack.=$meldinganders;
        $this->setState("meldingform.content.melding.anders.end");
        $this->moveToContent();
        
        /*
         * Verzenden
         */
        $this->setState("meldingform.content.melding.send.start");
        $send="
                    <div id='send' class='box'>
                        U heeft alle nodige velden ingevuld. Indien u zeker bent dat alles juist is kan u verder.<br/>
                        <input type='button' id='send' name='verzenden' value='Verzenden'/>
                    </div>";
        $this->stack.=$send;
        $this->setState("meldingform.content.melding.send.end");
        $this->moveToContent();
        
        $this->setState("meldingform.content.end");
        $this->moveToContent();
        
        unset($content); unset($meldinghvl); unset($meldinganders); unset($send);
        
        /*
         * SCRIPT
         */
        /*
        $this->setState("meldingform.script.start");
        $this->setState("meldingform.script.base.start");
        $script="
            //validation
            re = /^\d{1,2}$/;
            dag = form.melding.dag.value;
            
                
            }
            //validation
            var hvlhidden = true;
            var andershidden = true;
            
            //Ajax process
        ";
        $this->stack = $script;
        $this->setState("meldingform.script.base.end");
        
        
        
        
        
        */
       
        $this->title = "Melding";
        $this->script=$script;
        $this->export();
    }

    public function viewListOmb($data){
        $this->setState("viewList.start");
        $keys = array('id','dag','maand','jaar','afgerond','slachtoffer_naam');
        $keysnamed=array('#','dd','mm','jj','Afgerond','Slachtoffer');
        $this->setState("viewList.content.start");

        $content = "<a class='RoundedButton2' login href='' onclick='EQ.reRoute(\"ombnieuw\",true);'>Nieuwe registratie</a><br/><table id='ShowTable' class='wider'><tr id='TableHead'>";

        for ($i = 0; $i < count($keys); $i++) {
            $content.="<td>{$keysnamed[$i]}</td>";
        }
        $content.="</tr>";

        $revData = array_reverse($data);
        if($revData!=null){
        foreach ($revData as $omb) {
            $content.="<tr id='TableRow' onclick='EQ.reRoute(\"ombbewerk\",true,{$omb[$keys[0]]});'>";
            for ($i = 0; $i < count($keys); $i++) {
                if(strcmp($keys[$i], $keys[4])==0){
                    if(strcmp($omb[$keys[$i]], 0)==0){
                        $content.="<td>Nee</td>";
                    } else {
                        $content.="<td>Ja</td>";
                    }
                } else {
                    $content.="<td>{$omb[$keys[$i]]}</td>";
                }
            }
        }
        }else{
            $content.="<tr id='TableRow'><td colspan='".count($keys)."'><em>Geen registratie van oudermishandeling aanwezig. Kies nieuwe registratie.</em></td></tr>";
        }

        $content.="</table>";
        $this->stack=$content;
        $this->setState("viewlist.content.end");

        $this->title = "Oudermisbehandelingenlijst";
        $this->moveToContent();

        $this->setState("viewlist.end");
        $this->export();
    }
}
?>
