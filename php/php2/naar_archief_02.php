<?php
session_start();

//include("../includes/toonSessie.inc");

$paginanaam="Dossier wegschrijven in archief";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
{


    //----------------------------------------------------------
    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
    //----------------------------------------------------------

    include("../includes/html_html.inc");
    print("<head>");
    include("../includes/html_head.inc");
?>

<script type="text/javascript">
 function printLogo() {
   document.images[2].width=0;document.images[2].height=0;
   document.images[2].src='/images/logo_top_pagina_klein.gif';
 }
</script>

<?php
    print("</head>");
    print("<body onLoad=\"if (magPrinten) {printLogo();print();}\">");
    print("<div align=\"center\">");
    print("<div class=\"pagina\">");
    include("../includes/header.inc");
    include("../includes/kruimelpad.inc");
    print("<div class=\"contents\">");
    include("../includes/menu.inc");
    print("<div class=\"main\">");
    print("<div class=\"mainblock\">");
    if (strlen($_POST['einde_jj']) == 2) {
       $_POST['einde_jj'] = "20" . $_POST['einde_jj'];
    }
    if ($_POST['stopzetting'] == 'zorgenplan') {
      $writePatientQry = "
        UPDATE
            patient
        SET
            actief = 0,
            stopzetting_text='".$_POST['pat_stopzetting_text']."',
            stopzetting_cat='".$_POST['pat_stopzetting_cat']."',
            einddatum=".$_POST['einde_jj'].$_POST['einde_mm'].$_POST['einde_dd']."
        WHERE
            code='{$_SESSION['pat_code']}'";
      $doe=mysql_query($writePatientQry) or die("zorgenplanstopzettingsprobleem dankzij $writePatientQry <br/>" . mysql_error());
    }
    else if ($_POST['stopzetting'] == 'tp') {
      require("../includes/tp_exclusie_sturen.inc.php");
      $writePatientQry = "
        UPDATE
            patient_tp
        SET
            actief = 0,
            stopzetting_text='".$_POST['pat_stopzetting_text']."',
            stopzetting_cat='".$_POST['pat_stopzetting_cat']."',
            einddatum='".$_POST['einde_jj']."-".$_POST['einde_mm']."-".$_POST['einde_dd']."'
        WHERE
            patient='{$_SESSION['pat_code']}'
            and actief=1";
      $writePatientQry2 = "
        UPDATE
            patient
        SET
            actief = 1,
            tp_record = NULL
        WHERE
            code='{$_SESSION['pat_code']}'";
      $doe=(mysql_query($writePatientQry) && mysql_query($writePatientQry2))
               or die("tpstopzettingsprobleem dankzij $writePatientQry of $writePatientQry2<br/>" . mysql_error());
    }
    else if ($_POST['stopzetting'] == 'alles') {
      require("../includes/tp_exclusie_sturen.inc.php");
      $writePatientQry = "
        UPDATE
            patient_tp
        SET
            actief = 0,
            stopzetting_text='".$_POST['pat_stopzetting_text']."',
            stopzetting_cat='".$_POST['pat_stopzetting_cat']."',
            einddatum='".$_POST['einde_jj']."-".$_POST['einde_mm']."-".$_POST['einde_dd']."'
        WHERE
            patient='{$_SESSION['pat_code']}' and actief=1";
      $writePatientQry2 = "
         UPDATE
            patient
        SET
            actief = 0,
            stopzetting_text='".$_POST['pat_stopzetting_text']."',
            stopzetting_cat='".$_POST['pat_stopzetting_cat']."',
            einddatum=".$_POST['einde_jj'].$_POST['einde_mm'].$_POST['einde_dd']."
        WHERE
            code='{$_SESSION['pat_code']}'";
      $doe=(mysql_query($writePatientQry) && mysql_query($writePatientQry2))
               or die("allesstopzettingsprobleem dankzij $writePatientQry of $writePatientQry2<br/>" . mysql_error());
    }
    switch ($_POST['pat_stopzetting_cat']) {
       case 1:
         $reden = "De patient is voldoende hersteld (dus katz &lt; 5)";
         break;
       case 2:
         $reden = "Overlijden";
         break;
       case 3:
         $reden = "Opname in rustoord";
         break;
       case 4:
         $reden = "Verhuis buiten Limburg";
         break;
       case 6:
         $reden = "Verhuis buiten gemeente";
         break;
       case 5:
         $reden = "Andere";
         break;
    }
    if ($doe) {
      echo <<< EINDE
      <table><tr><td><div class="hidden" style="float:left;"><img src="../images/logo_top_pagina_klein.gif" width="100" height="120">&nbsp;</div></td>
    <td><h1>Archivering zorgenplan<br /> {$_SESSION['pat_code']}</h1>
      <h2>op naam van {$_SESSION['pat_naam']} {$_SESSION['pat_voornaam']}</h2> </td></tr></table>

      <p>Met ingang van {$_POST['einde_dd']}/{$_POST['einde_mm']}/{$_POST['einde_jj']} werd dit
      dossier gearchiveerd om volgende reden:</p>

      <ul>
      <li><p>$reden</p></li>
EINDE;
      if ($_POST['pat_stopzetting_text'] !="") print("<li><p><em>{$_POST['pat_stopzetting_text']}</em></p> </li>");
      print("</ul>");
      $boodschap="<h3>Dit dossier is succesvol gearchiveerd.</h3></div>";
      $magPrinten = true;

    }
    else {
      $boodschap="We hebben dit dossier niet kunnen archiveren.";

    }
    print($boodschap);
    if ($magPrinten) print("<script type=\"text/javascript\">magPrinten = true;</script>");

    //---------------------------------------------------------
    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");
    //---------------------------------------------------------

    print("</div>");
    print("</div>");
    print("</div>");
    include("../includes/footer.inc");
//    print("<div class=\"hidden\" style=\"float:left;\"><img src=\"../images/logo_top_pagina_klein.gif\" width=\"100\" height=\"120\"></div> ");
    print("</div>");
    print("</div>");
    print("</body>");
    print("</html>");
    }

//---------------------------------------------------------
/* Geen Toegang */ include("../includes/check_access.inc");
//---------------------------------------------------------
?>