<?php

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   $paginanaam="Initialisatie subsidiestatus";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");

      print("</head>");

      print("<body>");

      print("<div align=\"center\">");

      print("<div class=\"pagina\">");

      require("../includes/header.inc");

      require("../includes/kruimelpad.inc");

      print("<div class=\"contents\">");

      require("../includes/menu.inc");

      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");



// begin mainblock

function maximaleKatz($code) {

   $maxKatzRij1 = getFirstRecord("select max(totaal) as maxKatz from katz k, evaluatie e where k.id = e.katz_id and e.patient = '$code'");

   $maxKatzRij2 = getFirstRecord("select max(totaal) as maxKatz from katz k, overleg o where k.id = o.katz_id and o.patient_code = '$code'");

   return max($maxKatzRij1['maxKatz'],$maxKatzRij2['maxKatz']);

}



function aantalAanwezigenAfgerondOK($code, $controle) {

    // zoek eerst het maximaal aanwezige ZVL/HVL/... bij afgeronde overleggen

    $qryAantalHVL1 = "select count(aanwezig) as maxHVL1 from afgeronde_betrokkenen betr,

                                       hulpverleners hvl,

                                       organisatie org,

                                       overleg o

                  where o.id = betr.overleg_id
                    and betr.overleggenre = 'gewoon'
                    and o.patient_code =  '$code'

                    and (betr.genre = 'hulp' or betr.genre = 'orgpersoon')

                    and betr.persoon_id = hvl.id

                    and hvl.organisatie = org.id

                    and org.genre in ('ZVL','HVL','XVL', 'XVLP')

                    and aanwezig = 1

                    and controle = $controle

                  group by o.id

                  order by maxHVL1 desc;";

    $aantalHVL1 = getFirstRecord($qryAantalHVL1);

    // als dit minstens 3 is, is het ok

    if ($aantalHVL1['maxHVL1']>=3) return true;



    // als het minder dan 2 is, kan die ene mantelzorger ook geen verschil meer maken

    // dus return false.

    if (($aantalHVL1['maxHVL1']<2)) return false;



    // nu weten we dat er minstens 2 ZVL/HVL/... aanwezig waren

    // als we nog een aanwezige mantelzorger vinden is het OK

    $qryAantalMZ1 = "select aanwezig from afgeronde_betrokkenen betr,

                                       overleg o

                  where o.id = betr.overleg_id
                    and betr.overleggenre = 'gewoon'
                    and o.patient_code = '$code'

                    and (betr.genre = 'mantel')

                    and aanwezig = 1

                    and controle = $controle

                  order by aanwezig desc;";

    $resultAantalMZ1 = mysql_query($qryAantalMZ1) or die("KO: $qryAantalMZ1");



    if (mysql_num_rows($resultAantalMZ1) > 0) {

      return true;

    }



    // geen mantelzorger en maar twee ZVL/HVL/XVL/....

    return false;

}

function aantalAanwezigenHuidigOK($code) {

    // zoek eerst het maximaal aanwezige ZVL/HVL/... bij het huidige overleg

    $qryAantalHVL2 = "select sum(aanwezig) as maxHVL2 from huidige_betrokkenen betr,

                                       hulpverleners hvl,

                                       organisatie org

                  where patient_code = '$code'
                    and betr.overleggenre = 'gewoon'
                    and (betr.genre = 'hulp' or betr.genre = 'orgpersoon')

                    and betr.persoon_id = hvl.id

                    and hvl.organisatie = org.id

                    and org.genre in ('ZVL','HVL','XVL', 'XVLP')

                    and aanwezig = 1;";

    $aantalHVL2 = getFirstRecord($qryAantalHVL2);

    // als dit minstens 3 is, is het ok

    if ($aantalHVL2['maxHVL2']>=3) return true;



    // als het minder dan 2 is, kan die ene mantelzorger ook geen verschil meer maken

    // dus return false.

    if ($aantalHVL1['maxHVL2']<2) return false;



    // nu weten we dat er minstens 2 ZVL/HVL/... aanwezig waren

    // als we nog een aanwezige mantelzorger vinden is het OK

    $qryAantalMZ2 = "select aanwezig from huidige_betrokkenen betr

                     where patient_code =  '$code'
                    and betr.overleggenre = 'gewoon'
                    and (betr.genre = 'mantel')

                    and aanwezig = 1

                  order by aanwezig desc;";

    $resultAantalMZ2 = mysql_query($qryAantalMZ2) or die("KO: $qryAantalMZ2");



    if (mysql_num_rows($resultAantalMZ2) > 0) {

      return true;

    }



    // geen mantelzorger en maar twee ZVL/HVL/XVL/....

    return false;

}



function huisartsStatusAfgerond($code, $controle) {

    $qryZoekHA = "select aanwezig from afgeronde_betrokkenen betr,

                                       hulpverleners hvl,

                                       overleg o

                  where o.id = betr.overleg_id
                    and betr.overleggenre = 'gewoon'
                    and o.patient_code =  '$code'

                    and controle = $controle

                    and (betr.genre = 'hulp' or betr.genre = 'orgpersoon')

                    and betr.persoon_id = hvl.id

                    and hvl.fnct_id = 1

                  order by aanwezig desc;";

    $resultHA = mysql_query($qryZoekHA) or die("KO: $qryZoekHA");

    if (mysql_num_rows($resultHA) > 0) {

      $rijHA = mysql_fetch_assoc($resultHA);

      if ($rijHA['aanwezig']==1) {

        return 9;

      }

      else {

        return 3;  // afwezige, maar betrokken huisarts

      }

    }

    return 1;

}

function huisartsStatusHuidig($code) {

    $qryZoekHA = "select aanwezig from huidige_betrokkenen betr,

                                       hulpverleners hvl

                  where patient_code = '$code'
                    and betr.overleggenre = 'gewoon'
                    and (betr.genre = 'hulp' or betr.genre = 'orgpersoon')

                    and betr.persoon_id = hvl.id

                    and hvl.fnct_id = 1

                  order by aanwezig desc;";

    $resultHA = mysql_query($qryZoekHA) or die("KO: $qryZoekHA");

    if (mysql_num_rows($resultHA) > 0) {

      $rijHA = mysql_fetch_assoc($resultHA);

      if ($rijHA['aanwezig']==1) {

        return 9;

      }

      else {

        return 3;  // afwezige, maar betrokken huisarts

      }

    }

    return 1;

}





print("<h1>Initialisatie subsidiestatus</h1>\n");



$qryAlleLege = "select * from patient where subsidiestatus = '' limit 0,10";



$resultAlleLege = mysql_query($qryAlleLege) or die($qryAlleLege);



for ($i=0;$i<mysql_num_rows($resultAlleLege); $i++) {

  $patient = mysql_fetch_assoc($resultAlleLege);

  $code = $patient['code'];



  $maxKatz = maximaleKatz($code);

  $minstatus = 1;

  // katz-score zit opgeslagen in minStatus

  if ($maxKatz >= 5) $minstatus = 4;

  else if ($maxKatz >= 1) $minstatus = 2;



  $nustatus = $minstatus;

  // op zoek naar een huisarts

  $huisartsMin = huisartsStatusAfgerond($code,1);

  $huisartsNu =  max(huisartsStatusAfgerond($code,0), huisartsStatusHuidig($code));

  if ($huisartsMin >= $huisartsNu) {

    $minstatus = $minstatus*$huisartsMin;

    $nustatus = $nustatus*$huisartsMin;

  }

  else {

    $minstatus = $minstatus*$huisartsMin;

    $nustatus = $nustatus*$huisartsNu;

  }



  // op zoek naar het aantal personen

  $aantalMin = aantalAanwezigenAfgerondOK($code, 1);

  $aantalNu = aantalAanwezigenAfgerondOK($code, 0) || aantalAanwezigenHuidigOK($code);

  

  if ($aantalMin) {

    $minstatus = $minstatus * 5;

    $nustatus = $nustatus * 5;

  }

  else if ($aantalNu) {

    $nustatus = $nustatus * 5;

  }



  if ($nustatus%180 == 0) {

    $subsidiestatus = "ok";

  }

  else if ($nustatus%30 == 0) {

    $subsidiestatus = "verdedigbaar";

  }

  else {

    $subsidiestatus = "niet-verdedigbaar";

  }

  

  mysql_query("update patient set minimum_subsidiestatus = $minstatus,

                                  subsidiestatus = '$subsidiestatus'

                              where code = '$code'") or die(mysql_error());

  print("<li>$code : numeriek $minstatus - tekst $subsidiestatus</li>");

}







// einde mainblock



      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/dbclose.inc");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>