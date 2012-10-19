<?php

session_start();

$paginanaam="Aanvraag voor overname patient goedkeuren";







if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {



//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------



    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/pat_id.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

    //include("../includes/toonSessie.inc");

if (isset($_POST['genre'])) {

  $nogNietAfgerondeQry = "select * from overleg where patient_code = '{$_POST['patient']}' and afgerond= 0";
  $nogNietAfgerondeResult = mysql_query($nogNietAfgerondeQry) or die($nogNietAfgerondeQry);
   
  if (mysql_num_rows($nogNietAfgerondeResult) > 0) {
    print("<div style=\"background-color: #ffa0a0;\" ><p>De overdracht van {$_POST['patient']} is <strong>NIET</strong> geregistreerd
                omdat het laatste overleg nog niet afgerond is. Gelieve dit af te ronden en dan terug de goedkeuring te geven voor deze overdracht.</p></div>");
  }
  else {
    $qryNieuweEigenaar = "update patient set toegewezen_genre = '{$_POST['genre']}', toegewezen_id = {$_POST['id']} where code = '{$_POST['patient']}'";
    $rijNieuweEigenaar = mysql_query($qryNieuweEigenaar) or die($qryNieuweEigenaar);

    switch ($_POST['genre']) {
      case "gemeente":
          $qryEmail = "select logins.naam, logins.voornaam, logins.email from logins, gemeente, patient
                       where profiel = 'OC' and overleg_gemeente = gemeente.zip
                         and gemeente.id = patient.gem_id
                         and patient.code = '{$_POST['patient']}'
                         and logins.actief = 1";
        break;
      case "rdc":
          $qryEmail = "select logins.naam, voornaam, email from logins
                       where profiel = 'rdc' and organisatie = {$_POST['id']} and actief = 1";
        break;
      case "hulp":
          $qryEmail = "select naam, voornaam, email from hulpverleners
                       where id = {$_POST['id']}
                       and actief = 1";
      case "psy":
          $qryEmail = "select logins.naam, voornaam, email from logins
                       where profiel = 'rdc' and organisatie = {$_POST['id']} and actief = 1";
        break;
    }
    $resultEmail = mysql_query($qryEmail) or die("$qryEmail is niet gelukt. $qryEmail");
    for ($i=0; $i<mysql_num_rows($resultEmail); $i++) {
      $rijEmail = mysql_fetch_assoc($resultEmail);

      $boodschap = "Beste {$rijEmail['voornaam']} {$rijEmail['naam']},<br/><br/><p>De overdracht van
        pati&euml;nt {$_SESSION['pat_code']} is bevestigd. Je kan nu al het multidisciplinair overleg organiseren.<br/>
        <p><br/>Met vriendelijke groeten, <br/>Anick Noben</p>";

      if ($rijEmail['email']!="")
        htmlmail($rijEmail['email'],"Listel: Bevestiging overname patient",$boodschap);
    }

    $deleteVorigeAanvragen = mysql_query("delete from aanvraag_overdracht where patient = '{$_POST['patient']}'") or die(mysql_error());

    print("<div style=\"background-color: #80ff80;\" ><p>De overdracht van {$_POST['patient']} is geregistreerd.</p></div>");
    $andere = " andere ";
  }
}


    //*********************** Toon alle aanvragen
    switch ($_SESSION['profiel']) {
       case "listel":
         $qry = "select * from aanvraag_overdracht inner join patient on patient.code = patient";
         break;
       case "OC":
         $qry = "select distinct aanvraag_overdracht.*, patient.naam, patient.voornaam from aanvraag_overdracht, logins, patient, gemeente
                       where logins.id = {$_SESSION['usersid']}
                         and van_genre = 'gemeente' and overleg_gemeente = gemeente.zip
                         and gemeente.id = patient.gem_id
                         and patient.code = patient";
         break;
       case "rdc":
         $qry = "select * from aanvraag_overdracht inner join patient on patient.code = patient
                       where van_genre = 'rdc' and van_id = {$_SESSION['organisatie']}";
         break;
       case "hulp":
         $qry = "select * from aanvraag_overdracht inner join patient on patient.code = patient
                       where van_genre = 'hulp' and van_id = {$_SESSION['usersid']}";
         break;
       case "psy":
         $qry = "select * from aanvraag_overdracht inner join patient on patient.code = patient
                       where van_genre = 'psy' and van_id = {$_SESSION['organisatie']}";
         break;
    }

    $result = mysql_query($qry) or die("Opzoeken van alle aanvragen is niet gelukt omwille van " . mysql_error() . " in $qry");
    $aantal = mysql_num_rows($result);
    
    if ($aantal == 0) {
      print("<p>Er zijn geen $andere aanvragen om pati&euml;nten van u over te nemen.</p>");
    }
    else {
      print("<ul>");
      for ($i=0; $i<$aantal; $i++) {
        $rij = mysql_fetch_assoc($result);
        switch ($rij['naar_genre']) {
          case "gemeente":
                $info = getUniqueRecord("select gemeente.naam from gemeente inner join patient on code = \"{$rij['patient']}\" and gem_id = gemeente.id");
                $naam = "OC-TGZ OCMW van {$info['naam']}";
             break;
          case "rdc":
                $info = getUniqueRecord("select organisatie.naam from organisatie where id = \"{$rij['naar_id']}\"");
                $naam = "OC TGZ-RDC van {$info['naam']}";
             break;
          case "hulp":
                $info = getUniqueRecord("select naam, voornaam from hulpverleners where id = \"{$rij['naar_id']}\"");
                $naam = "OC TGZ-ZA {$info['voornaam']} {$info['naam']}";
             break;
          case "psy":
                $info = getUniqueRecord("select organisatie.naam from organisatie where id = \"{$rij['naar_id']}\"");
                $naam = "OC TGZ-PSY van {$info['naam']}";
//                $info = getUniqueRecord("select naam, voornaam from logins where id = \"{$rij['naar_id']}\"");
//                $naam = "OC TGZ-PSY {$info['voornaam']} {$info['naam']}";
             break;
        }
        
        print("<li style=\"text-align:left;\">{$rij['patient']}  - {$rij['voornaam']} {$rij['naam']} naar $naam <form style=\"display:inline\" method=\"post\">
                                   <input type=\"hidden\" name=\"id\" value=\"{$rij['naar_id']}\"/>
                                   <input type=\"hidden\" name=\"genre\" value=\"{$rij['naar_genre']}\"/>
                                   <input type=\"hidden\" name=\"patient\" value=\"{$rij['patient']}\"/>
                                   <input type=\"submit\" value=\"Keur overdracht goed\"/>
                                 </form></li>\n");
      }
      print("</ul>\n");
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