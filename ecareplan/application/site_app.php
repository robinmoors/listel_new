<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Site_App class of EcarePlan System
 * @version 1.0
 * @package application
 * @author Robin Moors, Joris Jacobs
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
class ECP_SiteApp extends ECP_App {
    private $site = null;
    private $page = null;
    private $template = null;
    private $data = null;
    private $state = "inactive"; //inactive, initialized, routed, dispatched, rendered, offline

    /**
     * Class constructor.
     *
     * @param	string	$id	A client identifier.
     * @since	1.0
     */
    public function __construct($id) {
       parent::__construct($id);
       $this->state = $this->conf->offline ? "offline" : "inactive";
       
    }

   /**
     * Initialise the application.
     *
     * @param	array An optional associative array of configuration settings.
     * @since	1.0
     */
    public function initialise() {
        $this->session = ECPFactory::getSession();
        if($this->state !== "offline") $this->state = "initialized";
    }
    
    public function route(){
        //router laden
        //parent::route();
        if($this->state !== "offline") {
            $this->router = ECPFactory::getRouter();
            $this->router->parse();
            $this->state = "routed";
        }
    }
    
    public function dispatch(){
        //alle opties zijn verzameld, nu gaan we de componenten laden en de juiste informatie meegeven
        if($this->state !== "offline"){
            $this->user = ECPFactory::getUser($this->router->getUserId());
            $this->user->setUser($this->router->getUserId());
            $this->session->start();
            $this->router->dispatch();
            //echo $this->session->getState();
            $this->state = "dispatched";
        }else{
            $this->setTemplate("offline");
            $this->setTemplateData(array('content' => $this->conf->offline_message, 'content-title'=>'Ecareplan Offline'));
        }        
    }
    
    public function render(){
        //alles in template steken
        $templ = ECPFactory::getTemplate($this->template);
        $tdata = self::createTemplateData();
        $templ->give($tdata);
        $message = "";
        $errors = parent::getErrors();
        for($i=0; $i<count($errors);$i++){
            $message.=" $i - {$errors[$i]}";
        }
        $templ->input($message);
        if($templ->succes()) $this->output = $templ->get();
        else{
            $templ->viewErrors();
            $this->output = $templ->get();
        }
        $this->state = "rendered";
    }

    /**
     * Laad onderdelen in en duw ze in een template
     *
     * @since	1.0
     */
    public function build() {
        //inlezen welke site, pagina, optie geladen is of welke opdracht uitgevoerd moet worden
        //benodigde files inladen en openen
        
        //site website, heeft enkel een siteID en een to parameter nodig, dus controleren of die er is
        if($this->conf->offline == "1"){
            $site_conf['state'] = "offline"; //forceer offline status want server staat op offline..
            $site_conf['message'] = $this->conf->offline_message;
            
        }
        /*
        //site status controleren en template instellen
        switch($site_conf['state']){
            default: case "offline":  //site is offline, of de status is niet gekend.
                $template = "offline";
                $msg = $site_conf['message'];
                break;
            case "running": //site staat online voor iedereen
                $name = explode('.php',$site_conf['TemplateFile']); //old sites have .php extention in templatename, stripping this out..
                $template = $name[0];
                break;
            case "private": //site staat alleen online voor leden
                $template = "private";
                $msg = $site_conf['message'];
                break;
            case "admin": //site alleen toegankelijk voor administrators
                $template = "private_adminonly";
                $msg = $site_conf['message'];
                break;
        }
        
        //templatedata
        if($template!="offline") self::createTemplateData($site_conf);
        else{
            self::createTemplateData($site_conf);
            $this->templatedata['content'] = $msg;
        }
        
        //template inladen, instellen en dan afsluiten
       $templ = EQFactory::getTemplate($template);
       $templ->give($this->templatedata); //give templatedata to the template
        $templ->input($message);
        if($templ->succes()){
            $this->output = $templ->get();
        }else{ //error gemaakt ergens..
            $templ->viewErrors(); 
            $this->output = $templ->get();
        } */
        $this->template = $this->conf->offline ? "offline" : "listel" ;
        
        $templ = ECPFactory::getTemplate($this->template);
        $tdata = self::createTemplateData();
        $templ->give($tdata);
        $templ->input($message);
        if($templ->succes()) $this->output = $templ->get();
        else{
            $templ->viewErrors();
            $this->output = $templ->get();
        }
    }
    
    /**
     * Retuns the state of the Site_app
     * @return string state 
     */
    public function getState(){
        return $this->state;
    }
    
    /**
     * Sets the templatename to load when rendering
     * @param string $template the templatename
     */
    public function setTemplate($template){
        $this->template = $template;
    }
    
    /**
     * Set templatedata, only setting wat was givven!
     * @param array $tdata
     */
    public function setTemplateData($tdata=array()){
        foreach($tdata as $datakey => $td){
            $this->data[$datakey] = $td;
        }
    }
    
    public function getUser(){
        return $this->user;
    }
    /**
     * Create the templatedata wich a template reads to add content.
     * @param array $data site_conf from (query_result as array) 
     */
    protected function createTemplateData($siteconfig=null){
        $tdata = array();
        foreach($this->data as $datakey => $td){
            $tdata[$datakey] = $td;
        }
        $tdata['baseurl'] = $this->conf->base_url;
        $tdata['user-name'] = $this->user->naam; //Username
        $tdata['login-button'] = "afmelden";
        //$tdata['title'] = $siteconfig["siteName"];
        $tdata['versionname'] = $this->conf->cur_version;
        //$tdata["headscript"] = " ";
        return $tdata;
    } 
    
    protected function getDbRestrictions($conf=null){ 
        //door niks op te geven wordt het minimum aan bevoegdheden ingesteld in EQApp
        $conf = parent::getDbRestrictions();
        return $conf;
    }
}

?>
