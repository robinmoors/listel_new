<?php
    //----------------------------------------------------------
    // Berekening van een aantal andere kritische factoren en aantallen:
    // het aantal artsen, het aantal thuisverpleegkundigen
    // het aantal Riziv-hebbenden, het aantal HVL's, het aantal mantelzorgers
    // het aantal XVL's, het aantal betrokkenen.
    require("../includes/aantal_arts.php"); //$_SESSION['aantal_arts']
    require("../includes/aantal_tvp.php"); //$_SESSION['aantal_tvp']
    require("../includes/aantal_zvl.php"); //$_SESSION['aantal_zvl']
    require("../includes/aantal_hvl.php"); //$_SESSION['aantal_hvl']
    require("../includes/aantal_xvl.php"); //$_SESSION['aantal_xvl']
    require("../includes/aantal_mz.php"); //$_SESSION['aantal_mz']
    $aantalHulpverleners=$_SESSION['aantal_hvl']+$_SESSION['aantal_xvl']+$_SESSION['aantal_mz'];
    //----------------------------------------------------------
    /*print("Dit overleg groepeert:<br />".
    $_SESSION['aantal_arts']." artsen ZVL (arts)<br />".
    $_SESSION['aantal_tvp']." thuisverpleegkundigen ZVL (Thuisverpleegkundige)<br />".
    $_SESSION['aantal_zvl']." zorgverleners<br />".
    $_SESSION['aantal_hvl']." hulpverleners ZVL + HVL<br />".
    $_SESSION['aantal_xvl']." niet-professionelen of tweede lijners XVL<br />".
    $_SESSION['aantal_mz']." mantelzorgers<br />");*/
    
    $melding="";
    $teOudVoorGDT = false;
    
    // gekke berekeningen om zowel rekening te houden met een jaar met 2 of met 4 cijfers
    $jaar = $_SESSION['overleg_jj'];
    if ($jaar < 100) {
      if ($jaar > 90) $jaar = "19$jaar";
      else $jaar = "20$jaar";
    }

    if ($jaar < 2003 || ($jaar == 2003 && $_SESSION['overleg_mm'] < 7)) {
      $teOudVoorGDT = true;
    }

    $_SESSION['zorgenplan']=true; // alleen relevant voor het eerste overleg

    if (!$teOudVoorGDT) $_SESSION['gdt']=true;

    $ditJaarQry = "select * from overleg where substring(overleg_datum,1,4) = $jaar and overleg_wilGDT = 1 and overleg_type = 4 and overleg_pat_nr = {$_SESSION['pat_nr']}";
    $aantalDitJaar = mysql_num_rows(mysql_query($ditJaarQry)) ;
    if ($pvsVraag = mysql_fetch_array(mysql_query("select pat_type from patienten where pat_nr = {$_SESSION['pat_nr']}"))) {
      $gewonePatient = ($pvsVraag['pat_type'] == 0);
    }
    else {
      print("miljaar geen pat_type");
    }
    if ($teOudVoorGDT) {
      $nogRechtOp = 0;
    }
    else if ($gewonePatient) {
      $nogRechtOp = 1 - $aantalDitJaar;
    }
    else {
      $nogRechtOp = 4 - $aantalDitJaar;
      // pvs-patienten hebben recht op 4 vergoedbare overleggen per jaar
    }

    if ($nogRechtOp == 1) {
      $meldingKanGDT = "Tip: Deze patient heeft nog recht op 1 vergoedbaar overleg.<br />
                        Hiervoor moeten er op het overleg minstens 3 zorg- en hulpverleners zijn waaronder een huisarts.";
    }
    else if ($nogRechtOp > 0) {
      $meldingKanGDT = "Tip: Deze patient heeft nog recht op $nogRechtOp vergoedbare overleggen.<br />
                        Hiervoor moeten er op het overleg minstens 3 zorg- en hulpverleners zijn waaronder een huisarts.";
    }

//require("../includes/toonSessie.inc");
    if ($_SESSION['gdt']) {
       $_SESSION['gdt'] = ($nogRechtOp > 0);
       if (!$_SESSION['gdt']) {
         if ($gewonePatient) $meldingWilGDT = "Een patient mag maar 1 vergoedbaar overleg per kalenderjaar hebben. Dit overleg komt hiervoor dus niet in aanmerking.";
         else $meldingWilGDT = "Een PVS-patient mag maar 4 vergoedbare overleggen per kalenderjaar hebben. Dit overleg komt hiervoor dus niet in aanmerking.";
       }
    }


    if ($_SESSION['aantal_arts']<1)
    {
        if ($_SESSION['eersteOverleg']) {
          $meldingZP="Dit overleg bevat geen huisarts en kan niet in aanmerking komen voor een officieel zorgenplan.";
          $meldingWilGDT="Dit overleg bevat geen huisarts en kan niet in aanmerking komen voor een officieel zorgenplan, en dus ook niet voor een vergoedbaar overleg.";
          $_SESSION['zorgenplan']=false;
          $_SESSION['gdt']=false;
        }
        else {
          if ($_SESSION['wilGDT'] == 1 || !isset($_SESSION['wilGDT']))
          $meldingWilGDT="Dit overleg bevat geen huisarts en kan niet in aanmerking komen voor een vergoedbaar overleg";
          $_SESSION['gdt']=false;
        }
    }
    else         // er is dus al minstens één arts
        {
        if ($_SESSION['aantal_hvl']>=2) // arts + 1 ZVL of HVL
            {
            if ($_SESSION['aantal_hvl']>=3)
                {
                if ($teOudVoorGDT) {
                     $meldingZP="Dit overleg voldoet aan de eisen voor een officieel zorgenplan,
                               wat betreft aanwezige personen";
                     $_SESSION['gdt']=false;
                }
                else {
                    if ($_SESSION['gdt']) {
                       $meldingWilGDT= $meldingGDT= $meldingZP ="Dit overleg voldoet aan de eisen voor een vergoedbaar
                            multidisciplinair overleg (GDT), dus ook voor een officieel zorgenplan,
                            wat betreft aanwezige personen";
                    }
                }
                }
            else
                {
                if($aantalHulpverleners>=3)
                    {
                    $meldingZP="Dit overleg voldoet aan de eisen van een officieel zorgenplan,
                            wat betreft aanwezige personen";
                    $_SESSION['zorgenplan']=true;
                    $_SESSION['gdt']=false;
                    }
                else
                    {
                    $meldingZP="Dit overleg voldoet <b>NIET</b> aan de eisen van een officieel zorgenplan,
                            wat betreft aanwezige personen";
                    $meldingWilGDT="Dit overleg voldoet <b>NIET</b> aan de eisen van een officieel zorgenplan,
                            en dus ook niet aan de eisen van het vergoedbaar overleg
                            wat betreft aanwezige personen";
                    $_SESSION['zorgenplan']=false;
                    $_SESSION['gdt']=false;
                    }
                }
            }
        else
            {
            $meldingZP=$meldingWilGDT="Dit overleg bevat niet de noodzakelijke zorg- of hulpverlener
                    buiten de aanwezigheid van de huisarts";
            $_SESSION['zorgenplan']=false;
            $_SESSION['gdt']=false;
            }
        }
        if ($_SESSION['aantal_tvp_aanwezig']==0 && $_SESSION['aantal_tvp_betrokken']>0) {
            if ($_SESSION['gdt']) {
             $meldingGDT= $meldingWilGDT="Dit overleg voldoet <b>NIET</b> aan de eisen van een officieel zorgenplan,
                            omdat de thuisverpleegkundige niet aanwezig is.";
            }
            $_SESSION['gdt']=false;
        }
        if (!$_SESSION['gdt'] && !$teOudVoorGDT)
          $fout = $meldingWilGDT;
?>