<?php

session_start();

$paginanaam="Zorgteam bewerken";



if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------

    

//    require('../includes/patientoverleg_geg.php');



    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");



//include("../includes/toonSessie.inc");



if (isset($_POST['pat_code'])) {
  $_SESSION['pat_code']=$_POST['pat_code'];
}

else if (isset($_GET['pat_code']) && strlen($_GET['pat_code'])>0) {
  $_SESSION['pat_code']=$_GET['pat_code'];
}


require('../includes/patientoverleg_geg.php');

$patientToegewezen = getFirstRecord("SELECT * FROM patient WHERE code = '{$_SESSION['pat_code']}' order by actief desc");

$patientInfo['type']=$patientToegewezen['type'];
$patientInfo['toegewezen_genre']=$patientToegewezen['toegewezen_genre'];
$patientInfo['toegewezen_id']=$patientToegewezen['toegewezen_id'];
//---------------------------------------------------------?>









<?php

$baseURL = "zorgteam_bewerken.php";

if ($_SESSION['profiel']=="menos" || $_GET['menos']==1) {
  $overlegGenre = "menos";
  $overlegGenreVoorwaarde = " overleggenre = 'menos' AND ";
  $extraParameterSelectPersonen = "?menos=1";
  $extraParameterSelectPersonen2 = "&menos=1";
  
  $naarMenosGegevens = "<p>Ga naar <a href=\"patient_menos_vragen.php\">menos vragen</a>.</p>";

  print("<h2>Bewerk het menos-zorgteam voor {$_SESSION['pat_code']} {$patientInfo['naam']} {$patientInfo['voornaam']}</h2>\n");
  print('<p>Druk deze lijst <a href="print_zorgenplan_02.php?huidige=1&menos=1" target="_blank">Betrokkenen in de thuiszorg</a> af.</p>' . "\n");
}
else if ($_SESSION['profiel']=="psy" || $_GET['psy']==1 || $patientInfo['type']==16 || $patientInfo['type']==18) {
  $overlegGenre = "psy";
  $overlegGenreVoorwaarde = " overleggenre = 'gewoon' AND ";
  $extraParameterSelectPersonen = "?psy=1";
  $extraParameterSelectPersonen2 = "&psy=1";


  print("<h2>Bewerk het psychiatrisch zorgteam voor {$_SESSION['pat_code']} {$patientInfo['naam']} {$patientInfo['voornaam']}</h2>\n");
  print('<p>Druk deze lijst <a href="print_zorgenplan_02.php?huidige=1&menos=1" target="_blank">Betrokkenen in de thuiszorg</a> af.</p>' . "\n");
}
else {
  $overlegGenre = "gewoon";
  $overlegGenreVoorwaarde = " overleggenre = 'gewoon' AND ";
  print("<h2>Bewerk het zorgteam voor {$_SESSION['pat_code']} {$patientInfo['naam']} {$patientInfo['voornaam']}</h2>\n");
  print('<p>Druk deze lijst <a href="print_zorgenplan_02.php?huidige=1" target="_blank">Betrokkenen in de thuiszorg</a> af.</p>' ."\n");
}
require("../includes/deelnemers_ophalen_ajax.php");


  /********** nog niet geregistreerde gebruikers ******************/
    $niemandGevonden = true;
    $qryPersonen = "
         SELECT
                concat(h.naam, ' ', h.voornaam) as naam,
                h.id
            FROM
                {$tabel}_betrokkenen bl,
                hulpverleners h
            WHERE
                $overlegGenreVoorwaarde
                (bl.genre = 'orgpersoon' or bl.genre = 'hulp') AND
                bl.persoon_id = h.id AND
                (h.validatiestatus is null or h.validatiestatus = 'geenkeuze') and
                $voorwaarde
                $beperking";
     $resultPersonen = mysql_query($qryPersonen) or die("problemen met $qryPersonen " . mysql_error());
     if ($niemandGevonden && mysql_num_rows($resultPersonen) > 0) {
       $niemandGevonden = false;
       print("\n<p>Volgende deelnemers hebben nog geen toegang tot het platform.<br/>Klik op de link om hun registratieformulier af te drukken.<ul>");
     }


     for ($p=0; $p<mysql_num_rows($resultPersonen); $p++) {
       $persoon = mysql_fetch_assoc($resultPersonen);
       print("   <li><a target=\"_blank\" href=\"$siteadresPDF/php/print_registratiepdf.php?id={$persoon['id']}&tabel=hulpverleners\">{$persoon['naam']}</a></li>\n");
     }

/*  MANTELZORGERS EN PATIENT VOORLOPIG NOG NIET LATEN REGISTREREN!
    $qryPersonen = "
         SELECT
                concat(h.naam, ' ', h.voornaam) as naam,
                h.id
            FROM
                {$tabel}_betrokkenen bl,
                mantelzorgers h
            WHERE
                $overlegGenreVoorwaarde
                (bl.genre = 'mantel') AND
                bl.persoon_id = h.id AND
                (h.validatiestatus is null or h.validatiestatus = 'geenkeuze') and
                $voorwaarde
                $beperking";
     $resultPersonen = mysql_query($qryPersonen) or die("problemen met $qryPersonen " . mysql_error());
     if ($niemandGevonden && mysql_num_rows($resultPersonen) > 0) {
       $niemandGevonden = false;
       print("\n<p>Volgende deelnemers hebben nog geen toegang tot het platform.<br/>Klik op de link om hun registratieformulier af te drukken.<ul>");
     }

     for ($p=0; $p<mysql_num_rows($resultPersonen); $p++) {
       $persoon = mysql_fetch_assoc($resultPersonen);
       print("  <li><a target=\"_blank\" href=\"$siteadresPDF/php/print_registratiepdf.php?id={$persoon['id']}&tabel=mantelzorgers\">{$persoon['naam']}</a></li>\n");
     }


    $qryPatient = "
         SELECT
                concat(h.naam, ' ', h.voornaam) as naam,
                h.id, h.code
            FROM
                patient h
            WHERE
                (h.validatiestatus is null or h.validatiestatus = 'geenkeuze') and
                h.code = '{$_SESSION['pat_code']}' ";
     $resultPersonen = mysql_query($qryPatient) or die("problemen met $qryPatient " . mysql_error());
     if ($niemandGevonden && mysql_num_rows($resultPersonen) > 0) {
       $niemandGevonden = false;
       print("\n<p>Volgende deelnemers hebben nog geen toegang tot het platform.<br/>Klik op de link om hun registratieformulier af te drukken.<ul>");
     }

     for ($p=0; $p<mysql_num_rows($resultPersonen); $p++) {
       $persoon = mysql_fetch_assoc($resultPersonen);
       print("  <li><a target=\"_blank\" href=\"$siteadresPDF/php/print_registratiepdf.php?id={$persoon['id']}&tabel=patient\">Pati&euml;nt zelf</a></li>\n");
     }
*/
     if ($niemandGevonden) {
       print("<p>Alle deelnemers aan dit overleg hebben toegang tot het platform, of hebben dit aangevraagd of geweigerd.</p>\n");
     }
     else {
       print("</ul></p>\n");
     }

  /********** nog niet geregistreerde gebruikers ******************/

if ($_SESSION['profiel']=="menos" || $_GET['menos']==1) {
  print("<p>Ga naar <a href=\"patient_menos_vragen.php?code={$_SESSION['pat_code']}\">de (andere) gegevens ivm Menos</a>.</p>");
}


   //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }

//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>