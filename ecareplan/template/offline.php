<?php

/*
 * EcarePlan - Made by Robin Moors, Joris Jacobs
 * @version 1.0
 * Template for Listel vzw
 */

defined("ECP_AC") or die ("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Template_offline extends ECP_Template{
    public function __CONSTRUCT(){
        parent::createHead("listel");
        $body="
    <div align=\"center\">
        <div class='pagina'>
            <div class=\"header\">
                <h1>Ecareplan {[versionname]}</h1>
            </div>
            <div class='contents selfclear'>
                {[errors]}
                </div>
                <div class=\"main\">
                <div class=\"mainblock\">
                    <img src='{[baseurl]}/lib/images/site_maintenance.png'/>
                    <p>
                    {[content]}
                    </p>
                </div>
           </div>
           <div class=\"footer\">
        Ecareplan v.{[versionname]}
      </div>
      </div>
 </div>
 ";
    parent::createBody($body);        
    }
    
}
