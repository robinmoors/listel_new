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

    public function viewBase($form){
        $script = "$('#base-form').bind('click',function(){EQ.reRoute(\"omb\",true);});";
        $this->content = $form->getHtml("normaal", array("contactwijze"=>"Contactwijze:","probleemfactor"=>"probleemfactor"),true);
        $this->title = "Basisformulier";
        $this->script=$script;
        $this->export();
    }
}
?>
