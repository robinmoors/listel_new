<?php

session_start();

$paginanaam="Aanvraag voor overname patient";







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

if (isset($_GET['code'])) {
  $_SESSION['pat_code'] = $_GET['code'];
  mysql_query("update aanvraag_overleg set status = 'overname_aangevraagd', id_organisator_user = {$_SESSION['usersid']}
                      where id = {$_GET['aanvraag']}") or die("kan status van aanvraag overleg niet aanpassen!");
}

    $qryOudeEigenaar = "select toegewezen_genre, toegewezen_id, gem_id from patient where code = '{$_SESSION['pat_code']}'";
    $rijOudeEigenaar = mysql_fetch_assoc(mysql_query($qryOudeEigenaar));

    switch ($rijOudeEigenaar['toegewezen_genre']) {
      case "gemeente":
          $qryEmail = "select logins.naam, voornaam, email from logins, gemeente
                       where profiel = 'OC' and overleg_gemeente = gemeente.zip
                         and gemeente.id = {$rijOudeEigenaar['gem_id']}
                         and logins.actief=1";
        break;
      case "rdc":
          $qryEmail = "select logins.naam, voornaam, email from logins
                       where profiel = 'rdc' and organisatie = {$rijOudeEigenaar['toegewezen_id']} and actief = 1";
        break;
      case "hulp":
          $qryEmail = "select naam, voornaam, email from hulpverleners
                       where id = {$rijOudeEigenaar['toegewezen_id']}
                       and actief = 1";
        break;
      case "psy":
          $qryEmail = "select logins.naam, voornaam, email from logins
                       where profiel = 'psy' and organisatie = {$rijOudeEigenaar['toegewezen_id']} and actief = 1";
        break;
    }
    $resultEmail = mysql_query($qryEmail) or die("$qryEmail is niet gelukt.");
    $rijEmail = mysql_fetch_assoc($resultEmail);

    $boodschap = "Beste {$rijEmail['voornaam']} {$rijEmail['naam']},<br/><br/><p>{$_SESSION['voornaam']} {$_SESSION['naam']}
      wil pati&euml;nt {$_SESSION['pat_code']} overnemen en het multi-disciplinair overleg organiseren.<br/>
      Je dient deze overdracht te bevestigen via het e-zorgplan op <a href=\"https://www.listel.be\">https://www.listel.be</a>.</p>
      <p>Als het laatste overleg niet afgerond is, dien je dit eerst af te ronden vooraleer je de pati&euml;nt kan overdragen.</p>
      <p><br/>Met vriendelijke groeten, <br/>Anick Noben</p>";
    
    if ($rijEmail['email']!="")
      htmlmail($rijEmail['email'],"Listel: Aanvraag tot overname patient",$boodschap);

    $deleteVorigeAanvragen = mysql_query("delete from aanvraag_overdracht where patient = '{$_SESSION['pat_code']}'") or die(mysql_error());

    preset($rijOudeEigenaar['toegewezen_id']);
    switch ($_SESSION['profiel']) {
       case "OC":
         $insertQry = "insert into aanvraag_overdracht (patient, van_genre, van_id, naar_genre)
                       values ('{$_SESSION['pat_code']}','{$rijOudeEigenaar['toegewezen_genre']}',{$rijOudeEigenaar['toegewezen_id']},
                                                         'gemeente')";
         break;
       case "rdc":
         $insertQry = "insert into aanvraag_overdracht (patient, van_genre, van_id, naar_genre, naar_id)
                       values ('{$_SESSION['pat_code']}','{$rijOudeEigenaar['toegewezen_genre']}',{$rijOudeEigenaar['toegewezen_id']},
                                                         'rdc',{$_SESSION['organisatie']})";
         break;
       case "hulp":
         $insertQry = "insert into aanvraag_overdracht (patient, van_genre, van_id, naar_genre, naar_id)
                       values ('{$_SESSION['pat_code']}','{$rijOudeEigenaar['toegewezen_genre']}',{$rijOudeEigenaar['toegewezen_id']},
                                                         'hulp',{$_SESSION['usersid']})";
         break;
       case "psy":
         $insertQry = "insert into aanvraag_overdracht (patient, van_genre, van_id, naar_genre, naar_id)
                       values ('{$_SESSION['pat_code']}','{$rijOudeEigenaar['toegewezen_genre']}',{$rijOudeEigenaar['toegewezen_id']},
                                                         'psy',{$_SESSION['organisatie']})";
         break;
    }
    $insertNieuweAanvraag = mysql_query($insertQry) or die($insertQry);
    

//----------------------------------------------------------



//----------------------------------------------------------



    print("<p>De aanvraag tot overname is geregistreerd. Zodra de vorige organisator de overdracht bevestigt, krijg je een email en kan je overleggen voor deze pati&euml;nt {$_SESSION['pat_code']} organiseren.");

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