<?php

ob_start();

session_start();



function toonRangorde($n) {

  global $csvOutput, $jaar, $sep;



  $query= "select overleg.id from overleg, omb_registratie reg

         where reg.jaar = $jaar

           and overleg.omb_id = reg.id

           and omb_rangorde = $n";



  $result=mysql_query($query) or die(mysql_error() . "<br /> $query");



  $csvOutput .= "\n\n\nAantal overleggen met rangorde $n $sep" . mysql_num_rows($result);

  $csvOutput .= "\n";



  for ($j=0; $j<mysql_num_rows($result); $j++) {

    $rij = mysql_fetch_assoc($result);

    toonOverleg($rij['id']);

  }

}



function toonOverleg($overlegID) {

  global $csvOutput, $sep;



    $querypat = "

         SELECT

                p.naam,

                p.voornaam,

                p.adres,

                g.dlzip,

                g.dlnaam,

                p.gebdatum,

                p.id, p.code,

                p.mutnr,

                overleg.*

            FROM

                patient p,

                gemeente g,

                overleg

            WHERE

                overleg.id = $overlegID AND

                p.code= overleg.patient_code AND

                p.gem_id=g.id"; // Query

      if ($resultpat=mysql_query($querypat))

        {

            $alleInfo= mysql_fetch_array($resultpat);

        }

      else {

        die("dieje query $querypat alles van het patient en het overleg op te halen toch..." .mysql_error());

      }



    $datum = $alleInfo['datum'];

    $alleInfo['mooieDatum'] = substr($datum, 6,2) . "/" . substr($datum, 4,2) . "/" . substr($datum, 0,4);



     $qryZVL="

      	SELECT

         h.*,

         gemeente.dlzip,

         gemeente.dlnaam,

         org.id as orgid

	      FROM

		      afgeronde_betrokkenen bl,

		      overleg,

		      gemeente,

		      hulpverleners h left join organisatie org on (h.organisatie = org.id)

	      WHERE

          overleg.id = $overlegID AND

          overleg.id = bl.overleg_id AND

          (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND

          bl.persoon_id=h.id AND

          gemeente.id = h.gem_id AND

          org.genre = 'ZVL' AND

		      bl.aanwezig=1

     ";



  $ontvanger = Array();

  $aantalOntvangers = 0;



  $resultMensen = mysql_query($qryZVL) or die(mysql_error());

  for ($i=0; $i<mysql_num_rows($resultMensen); $i++) {

    $persoon = mysql_fetch_assoc($resultMensen);

      // desnoods adres van organisatie opzoeken

      if ($persoon['organisatie'] > 0 && ($persoon['gem_id'] == 0  || $persoon['gem_id'] == 9999) ) {

                 $qry8="SELECT dlzip,dlnaam, adres, reknr, iban, bic, hoofdzetel FROM gemeente, organisatie WHERE gemeente.id=organisatie.gem_id and organisatie.id = {$persoon['organisatie']}";

                  $orgInfo=mysql_fetch_array(mysql_query($qry8)) or die($qry8 . mysql_error());

                  $persoon['adres'] = $orgInfo['adres'];

                  $persoon['dlzip'] = $orgInfo['dlzip'];

                  $persoon['dlnaam'] = $orgInfo['dlnaam'];

                  $persoon['reknr'] = $orgInfo['reknr'] . "\nIBAN {$orgInfo['iban']}\nBIC {$orgInfo['bic']}";

                  if ($orgInfo['iban'] == "" && $orgInfo['hoofdzetel'] > -1) {
                     $qry9="SELECT reknr, iban, bic FROM organisatie WHERE id = {$orgInfo['hoofdzetel']}";
                     $orgInfo=mysql_fetch_array(mysql_query($qry8)) or die($qry8 . mysql_error());
                     foreach ($orgInfo as $key => $value) {
                       $orgInfo[$key] = utf8_decode($orgInfo[$key]);
                     }
                     $persoon['reknr'] = $orgInfo['reknr'] . "\nIBAN {$orgInfo['iban']}\nBIC {$orgInfo['bic']}";
                  }

    }

    $ontvanger[$i] = $persoon;

  }

  $aantalOntvangers=$i;





     $qryProfnietZVL="

      	SELECT

		      h.naam as hnaam, h.voornaam,

          org.*

	      FROM

		      afgeronde_betrokkenen bl,

		      overleg,

		      hulpverleners h left join organisatie org on (h.organisatie = org.id)

	      WHERE

          overleg.id = $overlegID AND

          overleg.id = bl.overleg_id AND

          (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND

          bl.persoon_id=h.id AND

          org.genre in ('HVL', 'XVLP') AND

		      bl.aanwezig=1

        ORDER BY org.id, bl.id

     ";





  $huidigeOrg = -1;

  $resultMensen = mysql_query($qryProfnietZVL) or die(mysql_error());

  for ($i=0; $i<mysql_num_rows($resultMensen); $i++) {

    $persoon = mysql_fetch_assoc($resultMensen);

    if ($huidigeOrg != $persoon['id']) {

      $huidigeOrg = $persoon['id'];

      $ontvanger[$aantalOntvangers] = $persoon;

      $ontvanger['orgnaam']=$persoon['naam'];

      $ontvanger['naam']=$persoon['hnaam'];

      $aantalOntvangers++;

    }

  }



  $csvOutput .= "\nOverleg van {$alleInfo['code']} {$alleInfo['naam']} {$alleInfo['voornaam']} op {$alleInfo['mooieDatum']}\n";



  for ($i=0; $i<$aantalOntvangers; $i++) {

    $csvOutput .= "$sep{$ontvanger[$i]['naam']} {$ontvanger[$i]['voornaam']}";

    $csvOutput .= "$sep{$ontvanger[$i]['dlzip']} {$ontvanger[$i]['dlnaam']}";

    $csvOutput .= "$sep{$ontvanger[$i]['orgnaam']}";

    $csvOutput .= "$sep{$ontvanger[$i]['reknr']}\n";

  }



}





if ($_GET['sep']==",")

  $sep = ",";

else

  $sep = ";";





   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel"))

      {



$bestandsnaam = "omb_extra_vergoedbare";



if (isset($_GET['jaar'])) {

  $jaar = $_GET['jaar'];

}

else if (date("m")<=2) {

  $jaar= date("Y")-1;

}

else {

  $jaar= date("Y");

}







$csvOutput = "Overzicht van OMB-overleggen in $jaar met een rangorde groter dan 1 (dus afhankelijk van de pot)\n";



$query= "select count(*) as aantal, max(omb_rangorde) as grootste from overleg, omb_registratie reg

         where reg.jaar = $jaar

           and overleg.omb_id = reg.id

           and omb_rangorde > 1";



$result=mysql_query($query) or die(mysql_error() . "<br /> $query");

$rij= mysql_fetch_assoc($result);



$huidigePot = getFirstRecord("select pot from omb_pot where jaar = $jaar");



$csvOutput .= "\n\n\nAantal overleggen:$sep{$rij['aantal']}";

$csvOutput .= "\nResterende pot:$sep{$huidigePot['pot']}";



for ($i=2; $i<= $rij['grootste']; $i++) {

  toonRangorde($i);

}



















header("Content-Type: text/csv");

header("Cache-Control: must-revalidate, post-check=0,pre-check=0");

header("Content-Transfer-Encoding: binary");

header("Content-Disposition: attachment; filename=\"{$bestandsnaam}.csv\"");

header("Content-length: " . strlen($csvOutput));

print($csvOutput);



      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>