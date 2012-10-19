<?php

session_start();

$paginanaam="zorgenplannummer aanpassen";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------



    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");





    //-----------------------------------------------------------------------------

    /* Controle numerieke velden */ include("../includes/checkForNumbersOnly.inc");

    //-----------------------------------------------------------------------------



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

    

// update!



function pasAan($query, $naam) {

   if (mysql_query($query)) {

       print("<li>" . mysql_affected_rows() . "x een $naam aangepast</li>");

   }

   else  {

     print("<li>DEDOEMME. De query voor $naam is fout.</li>");

   }

}



if (!empty($_POST) && ($_POST['geboortedag'])==1) {

  $oude = trim($_POST['oud']);

  print("<h3>Aanpassing geboortedag</h3>");

  // eerst geboortedag aanpassen

  $patient = "update patient set gebdatum = \"{$_POST['jaar']}{$_POST['maand']}{$_POST['dag']}\" where code = \"$oude\"";

  pasAan($patient, "geboortedag van een patient");



  // en dan zorgplannummer aanpassen

  $_POST['nieuw'] = substr($oude,0,9) . substr($_POST['jaar'],2) . "{$_POST['maand']}{$_POST['dag']}" . substr($oude,15);

}



if (!empty($_POST) && strlen(trim($_POST['nieuw']))==17) {

  $oude = trim($_POST['oud']);

  $nieuwe = trim($_POST['nieuw']);

  print("<h3>Aanpassing zorgplannummer</h3>");



  print("<ol>");

  $patient = "update patient set code = \"$nieuwe\" where code = \"$oude\"";
  pasAan($patient, "patient");

  $patientTP = "update patient_tp set patient = \"$nieuwe\" where patient = \"$oude\"";
  pasAan($patientTP, "patient_tp");

  $patientPSY = "update patient_psy set code = \"$nieuwe\" where code = \"$oude\"";
  pasAan($patientPSY, "patient_psy");

  $patientPSY2 = "update psy_comorbiditeit set patient = \"$nieuwe\" where patient = \"$oude\"";
  pasAan($patientPSY2, "psy_comorbiditeit");

  $patientPSY3 = "update psy_domeinen set code = \"$nieuwe\" where code = \"$oude\"";
  pasAan($patientPSY3, "psy_domeinen");

  $evaluatie = "update evaluatie set patient = \"$nieuwe\" where patient = \"$oude\"";
  pasAan($evaluatie, "evaluatie");

  $betrokkenen = "update huidige_betrokkenen set patient_code = \"$nieuwe\" where patient_code = \"$oude\"";
  pasAan($betrokkenen, "betrokkene");

  $overleg = "update overleg set patient_code = \"$nieuwe\" where patient_code = \"$oude\"";
  pasAan($overleg, "overleg");

  $berichten = "update berichten set patient = \"$nieuwe\" where patient = \"$oude\"";
  pasAan($berichten, "berichten");

  print("</ol>");

}

    

    

?>

    

    <h1>Update zorgplannummer</h1>

    

    <form method="post" name="f" onsubmit="if (f.oud.value.length != 17 || f.oud.value.substr(9) != f.nieuw.value.substr(9) || f.oud.value.substr(0,5) != f.nieuw.value.substr(0,5)) {return confirm('zorgplannummers komen niet overeen\nBen je zeker dat je dit zorgplannummer wil veranderen?');} else {return true;}">

       <label for="oud" class="label160">Oud zorgplannummer&nbsp;</label><input type="text" name="oud" id="oud" />

       <br />

       <label for="nieuw" class="label160">Nieuw zorgplannummer&nbsp;</label><input type="text" name="nieuw" id="nieuw" />

       <br />

       <input type="submit" value="verander!" />

    </form>



    <h1>Update Geboortedag en bijhorend zorgplannummer</h1>



    <form method="post" name="g" onsubmit="var nieuwzp = g.oud.value.substr(0,9) + g.jaar.value.substr(2) + g.maand.value + g.dag.value + g.oud.value.substr(15);return confirm('Het nieuwe zorgplannnumer wordt ' + nieuwzp + '\nIs dit OK?');">

       <label for="oud2" class="label160">Oud zorgplannummer&nbsp;</label><input type="text" name="oud" id="oud2" />

       <br />

       <label for="geboortedag" class="label160">Nieuwe geboortedag&nbsp;</label>

          <input type="text" name="dag" id="geboortedatum" size="3" onchange="if (this.value.length != 2) alert('2 cijfers graag!');" />/

            <input type="text" name="maand" size="3" onchange="if (this.value.length != 2) alert('2 cijfers graag!');" />/

            <input type="text" name="jaar" size="5" onchange="if (this.value.length != 4) alert('4 cijfers graag!');" />

       <br />

       <input type="hidden" name="geboortedag" value="1" />

       <input type="submit" value="verander!" />

    </form>





<?php 

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