<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OverlegLok
 *
 * @author joris
 */
include_once 'OverlegOrg.trait.php';
include_once 'OverlegLok.trait.php';
class OverlegLok extends Overlegbasis{
    //put your code here
    use OverlegLokTrait, OverlegOrgTrait;
}

?>
