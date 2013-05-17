<?php
/**
 * Description of OverlegGDT
 *
 * @author Robin Moors, Joris Jacobs
 */
ecpimport("database.overleggen.OverlegExtended", "trait");
ecpimport("database.overleggen.OverlegOrg", "trait");
ecpimport("database.overleggen.OverlegLok", "trait");
ecpimport("database.overleggen.OverlegOmb", "trait");
ecpimport("database.overleggen.OverlegOrg", "trait");
ecpimport("database.overleggen.OverlegPsy", "trait");
ecpimport("database.overleggen.OverlegTp", "trait");
ecpimport("database.Overlegbasis", "class");

class OverlegGewoon extends Overlegbasis{
    
}

class OverlegMenos extends Overlegbasis{
    use OverlegOmbTrait;
}

/*
class OverlegLok extends Overlegbasis{
    use OverlegLokTrait, OverlegOrgTrait;
}

class OverlegGDT extends Overlegbasis{
    use OverlegExtendedTrait, OverlegOrgTrait{
        OverlegExtendedTrait:: setId insteadof OverlegOrgTrait;
        OverlegOrgTrait:: setId insteadof OverlegExtendedTrait;
    }
}

class OverlegPsy extends Overlegbasis {
    use OverlegOrg, OverlegPsy;    
}

Class OverlegPsy2013 extends Overlegbasis{
    use OverlegExtendedTrait, OverlegOrgTrait, OverlegPsyTrait;
}

class OverlegTp extends Overlegbasis{
    use OverlegTpTrait;
}
 * */
?>
