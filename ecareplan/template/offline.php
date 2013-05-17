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
 <header>
    <div class='wrapper nopadding'>
        <div class='top selfclear'>
            <div class='logo'>
                <h1>LISTEL vzw</h1>
            </div>
            <div class='userbar'>
                <div class='menuicon'><img src='{[baseurl]}/lib/images/24/terminal.png' alt='U' title='Aanmelden voor back-end'/></div>
                <div class='menutitle'>{[user-name]}</div>
                <div class='menusuboption'>{[login-button]}</div>
            </div>
        </div>
    </div>
</header>
<div class='wrapper pagina'>
        <div class=\"header\">
            <hgroup>
                <h1>{[content-title]}</h1>
                <h3>{[content-sub-title]}</h3>
            </hgroup>
        </div>
        <div class='contents selfclear'>
            <div class='error' style='display:none;'>
                {[errors]}
            </div>
            <div class=\"main\">
               <img src='{[baseurl]}/lib/images/site_maintenance.png'/>
                    <p>
                    {[content]}
                    </p>
            </div>
        </div>
</div>
<footer>
    <div class='wrapper nopadding'>
        {[footer]} - Ecareplan v.{[version-name]} - LISTEL vzw A. Rodenbachstraat 29 bus 1, 3500 Hasselt
    </div>
</footer>   
 ";
    parent::createBody($body);        
    }
    
}
