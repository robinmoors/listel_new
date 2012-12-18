<?php
/*
 * EcarePlan - Made by Robin Moors, Joris Jacobs
 * @version 1.0
 * Template for Listel vzw
 */

defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Template_Listel extends ECP_Template {

    public function __CONSTRUCT() {
        parent::createHead("listel");
        $body = "
 <header>
    <div class='wrapper nopadding'>
        <div class='top selfclear'>
            <div class='logo'>
                <h1>LISTEL vzw</h1>
            </div>
            <div class='userbar'>
                <div class='menuicon'><img src='{[baseurl]}/lib/images/24/user.png' alt='U' title='Gebruikersmenu openen'/></div>
                <div class='menutitle'>{[user-name]}</div>
                <div class='menusuboption'>{[login-button]}</div>
            </div>
        </div>
        <nav class='selfclear'>
            <ul>
                <li>
                    <img src='{[baseurl]}/lib/images/home.png' alt='H' title='Homepagina'/> <span class='content'>Home</span>
                </li>
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
        </nav>
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
                {[content]}
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
?>