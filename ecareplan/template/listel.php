<?php

/*
 * EcarePlan - Made by Robin Moors, Joris Jacobs
 * @version 1.0
 * Template for Listel vzw
 */

defined("ECP_AC") or die ("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Template_Listel extends ECP_Template{
    public function __CONSTRUCT(){
        parent::createHead("listel");
        $body="
    <div align=\"center\">
        <div class='pagina'>
            <div class='userbar'>
                <div class='menuicon'><img src='{[baseurl]}/lib/images/24/user.png' alt='U' title='Gebruikersmenu openen'/></div>
                <div class='menutitle'>{[username]}User</div>
                <div class='menusuboption'>{[loginbutton]}</div>
            </div>
            <div class=\"header\">
                <h1>Listel VZW</h1>
            </div>
            <div class='contents selfclear'>
                <div class='navigation'>
                    <div id='menu' class='selfclear'>
                    <ul>
                       <li><img src='{[baseurl]}/lib/images/home.png' alt='H' title='Homepagina'/> <span class='content'>Home</span></li>
                       <li>
                            <img src='{[baseurl]}/lib/images/balloons.png' alt='O' title='Overleg...'/> <span class='content'>Overleg</span>
                       </li>
                       <li>
                            <img src='{[baseurl]}/lib/images/marker.png' alt='E' title='Evaluaties...'/> <span class='content'>Evaluaties</span>
                       </li>
                       <li>
                            <img src='{[baseurl]}/lib/images/drawer.png' alt='Z' title='Zorgplannen...'/> <span class='content'>Zorgplannen</span>
                       </li>
                       <li>
                            <img src='{[baseurl]}/lib/images/chair.png' alt='OZ' title='Ouderenzorg...'/> <span class='content'>Ouderenbehandeling</span>
                       </li>
                       <li>
                            <img src='{[baseurl]}/lib/images/briefcase.png' alt='F' title='Formulieren...'/> <span class='fastcontent'>Formulieren</span>
                       </li>
                    </ul>
                </div>
                {[errors]}
                </div>
                <div class=\"main\">
                <div class=\"mainblock\">
                    {[content]}
                </div>
           </div>
      </div>
      <div class=\"footer\">
        {[footer]} - Ecareplan v.{[versionname]} - LISTEL vzw A. Rodenbachstraat 29 bus 1, 3500 Hasselt
      </div>
 </div>
 ";
    parent::createBody($body);        
    }
    
}
