<?php
/**
 * Description of OverlegGDT
 *
 * @author Robin Moors, Joris Jacobs
 */
include_once 'OverlegExtended.trait.php';
include_once 'OverlegOrg.trait.php';

class OverlegGDT extends Overlegbasis{
    //put your code here
    use OverlegExtendedTrait, OverlegOrgTrait;
}

class OverlegGewoon extends Overlegbasis{
    //put your code here
}

include_once 'OverlegOrg.trait.php';
include_once 'OverlegLok.trait.php';
class OverlegLok extends Overlegbasis{
    //put your code here
    use OverlegLokTrait, OverlegOrgTrait;
}

include_once 'OverlegOmb.trait.php';
class OverlegMenos extends Overlegbasis{
    //put your code here
    use OverlegOmbTrait;
    
}

include_once 'OverlegOrg.trait.php';
include_once 'OverlegPsy.trait.php';

class OverlegPsy extends Overlegbasis {
    use OverlegOrg, OverlegPsy;
    
}

include_once 'OverlegPsy.trait.php.php';
include_once 'OverlegExtended.trait.php';
include_once 'OverlegOrg.trait.php';

Class OverlegPsy2013 extends Overlegbasis{
    //put your code here
    use OverlegExtendedTrait, OverlegOrgTrait, OverlegPsyTrait;
    
}

include_once 'OverlegTp.trait.php';

class OverlegTp extends Overlegbasis{
    //put your code here
    use OverlegTpTrait;
}
?>
