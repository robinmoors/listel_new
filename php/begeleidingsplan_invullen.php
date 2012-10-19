<?php

$magAltijd = true;
//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------

    session_start();

    $paginanaam="Begeleidingsplan invullen";







//include("../includes/toonSessie.inc");



    // eerst nakijken of er een code is meegegeven én of die code bestaat
    // als er geen code ingegeven is, kijken we naar toegang
    if (isset($_GET['code'])) {
       $qryCode = "select * from overleg where logincode = \"{$_GET['code']}\" and contact_hvl = {$_GET['hvl_id']}";
       if ($codeResult = mysql_query($qryCode)) {
          if (mysql_num_rows($codeResult) == 1) {
            $overlegInfo = mysql_fetch_array($codeResult);
            $overlegID = $overlegInfo['id'];
            $_SESSION['pat_code'] = $overlegInfo['patient_code'];
            $binnenViaCode = true;
          }
          else if (mysql_num_rows($codeResult) == 0) {
            die("Je hebt geen toegang tot dit begeleidingsplan!");
          }
          else {
            die("er is meer dan 1 overleg met deze code");
          }
       }
       else {
         die("stomme code-query  $qryCode");
       }
    }

    if ($overlegInfo['afgerond']==1) {
        //---------------------------------------------------------
        /* Sluit Dbconnectie */ include("../includes/dbclose.inc");
        //---------------------------------------------------------
        die("Dit overleg is ondertussen afgerond en daarom mag je het begeleidingsplan niet meer aanpassen.");
    }
    if ($binnenViaCode)
        {
          $tabel = "overleg";
          $patientInfo = mysql_fetch_assoc(mysql_query("select patient.*, deelvzw from patient inner join gemeente on gem_id = gemeente.id
                                                        where code = \"{$_SESSION['pat_code']}\""));
          $patientPsy = mysql_fetch_assoc(mysql_query("select * from patient_psy
                                                        where code = \"{$_SESSION['pat_code']}\"")) ;//or die("problemen met patientPsy" . mysql_error());

        //print_r($overlegInfo);

        if ($patientInfo['deelvzw']=="") $patientInfo['deelvzw']="H";



        include("../includes/html_html.inc");
        print("<head>");
        include("../includes/html_head.inc");
?>
     <script type="text/javascript" src="../javascript/functies.js"></script>
     <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
<?php
        print("</head>");
        print("<body>");
        print("<div align=\"center\">");

        print("<div class=\"pagina\">");

          include("../includes/header.inc");

          include("../includes/kruimelpad.inc");

          print("<div class=\"contents\">");


          print("<div class=\"main\">");

          print("<div class=\"mainblock\">");

  $mensenGlobaal = "";
  $domeinQuery = "select * from psy_domeinen where code = \"{$patientInfo['code']}\" and datum <= {$overlegInfo['datum']} order by datum desc, id desc";
  $domeinResult = mysql_query($domeinQuery) or die("kan de de domeinen op datum van $datum niet ophalen.");
  if (mysql_num_rows($domeinResult) == 0) {
    $domein2Query = "select domeinen from patient_psy where code = \"{$patientInfo['code']}\"";
    $domein2Result = mysql_query($domein2Query) or die("kan de basisdomeinen van de patient niet ophalen.");
    $domein2 = mysql_fetch_assoc($domein2Result);
    if ($domein2['domeinen']==0) {
      $domeinen = Array();
    }
    else {
      $domeinQuery = "select * from psy_domeinen where id = {$domein2['domeinen']}";
      $domeinResult = mysql_query($domeinQuery) or die("kan de de domeinen op datum van $datum niet ophalen.");
      if (mysql_num_rows($domeinResult) == 0) {
        $domeinen = Array();
      }
      else {
        $domeinen = mysql_fetch_assoc($domeinResult);
      }
    }
  }
  else {
    $domeinen = mysql_fetch_assoc($domeinResult);
  }
  print("<h1>Vul het begeleidingsplan van {$patientInfo['voornaam']} {$patientInfo['naam']} ({$patientInfo['code']}) in.</h1>");

  require("../includes/psy_begeleidingsplan.php");


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

/* Geen Toegang */

if (!$_SESSION['binnenViaCode'] && !$binnenViaCode) {
  require("../includes/check_access.inc");
}
//---------------------------------------------------------

?>