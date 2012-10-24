<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of site_app
 *
 * @author robindell
 */
class ECP_Site extends ECP_App {
    private $site = null;
    private $page = null;

    /**
     * Class constructor.
     *
     * @param	string	$id	A client identifier.
     * @since	1.0
     */
    public function __construct($id) {
       parent::__construct($id);
       self::initialise();
       self::build();
    }

    /**
     * Initialise the application.
     *
     * @param	array An optional associative array of configuration settings.
     * @since	1.0
     */
    public function initialise() {
        //custom configuratie inladen
        //sessie inladen en eventueel aanmaken
        //adhv sessie ook user/admin klassen laden
        //configuratie wijzigen advh sessie
        //taalpakket inladen,...        
        parent::route();
    }

    /**
     * Laad onderdelen in en duw ze in een template
     *
     * @since	1.0
     */
    protected function build() {
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
        $templ = ECPFactory::getTemplate("Listel");
        $templ->give(self::createTemplateData());
        $templ->input($message);
        if($templ->succes()) $this->output = $templ->get();
        else{
            $templ->viewErrors();
            $this->output = $templ->get();
        }
    }
    
    /**
     * Create the templatedata wich a template reads to add content.
     * @param array $data site_conf from (query_result as array) 
     */
    protected function createTemplateData($siteconfig=null){
        $tdata = array();
        $tdata['baseurl'] = $this->conf->base_url;
        $tdata['username'] = $this->router->getParameter();
        $tdata['loginbutton'] = "afmelden";
        //$tdata['content'] = "De website wordt nu door equinsi samengesteld. Normaal duurt dit slechts enkele seconden.<br/>Duurt het toch lang? Vernieuw dan eventjes deze pagina. Dan probeert Equinsi opnieuw..";
        //$tdata['title'] = $siteconfig["siteName"];
        //$tdata['sitename'] = $siteconfig["siteName"];
        //$tdata['versionname'] = $this->conf->cur_version;
        //$tdata['username'] = $this->user->getName();
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
