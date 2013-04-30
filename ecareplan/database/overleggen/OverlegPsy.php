<?php
/**
 * Description of OverlegPsy
 *
 * @author Robin Moors, Joris Jacobs
 */

include_once 'OverlegOrg.trait.php';
include_once 'OverlegPsy.trait.php';

class OverlegPsy extends Overlegbasis {
    use OverlegOrg, OverlegPsy;
    
}

?>
