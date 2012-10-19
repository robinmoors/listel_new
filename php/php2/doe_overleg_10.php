<?php
session_start();
$paginanaam="Lijst overleggen";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
    {
    //----------------------------------------------------------
    /* Maak Dbconnectie */ include('../includes/dbconnect.inc');
    //----------------------------------------------------------

    //-----------------------------------------------------------------
    /* Haal patientgegevens */ include('../includes/patient_geg.php');
    //-----------------------------------------------------------------
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
        
    unset($_SESSION['overleg_dd']);
    unset($_SESSION['overleg_jj']);
    unset($_SESSION['overleg_mm']);

    //include("../includes/toonSessie.inc");
    
    $melding="";
    if (isset($_GET['wisoverleg_id']))
        {
        
        $doewisqry = mysql_query("delete from overleg where overleg_id =".$_GET['wisoverleg_id']);
        $doewisqry = mysql_query("delete from taakfiche where overleg_id =".$_GET['wisoverleg_id']);
        $doewisqry = mysql_query("delete from katz where overleg_id =".$_GET['wisoverleg_id']);
        $doewisqry = mysql_query("delete from aanweziglijsthvl where aanwhvl_overleg_id =".$_GET['wisoverleg_id']);
        $doewisqry = mysql_query("delete from aanweziglijstmz where aanwmz_overleg_id =".$_GET['wisoverleg_id']);
        $doewisqry = mysql_query("delete from aanweziglijstoc where aanwoc_overleg_id =".$_GET['wisoverleg_id']);
        $melding="Overleg succesvol gewist.";
        $overlegqry="
            select
                o.overleg_datum, 
                p.pat_id
            from 
                overleg o,
                patienten p
            where 
                o.overleg_pat_nr=".$_SESSION['pat_nr']." and 
                o.overleg_type=0 and
                o.overleg_pat_nr=p.pat_nr";
        $overleg=mysql_query($overlegqry);
        $overlegrecords=mysql_fetch_array($overleg);
//        $melding=$melding."+".$overlegrecords[0].$overlegqry;
        $overlegaantal=mysql_num_rows($overleg);
        if ($overlegaantal==0)
            {
            $nieuwid=substr($_SESSION['pat_id'],0,6)."xxxxxx".substr($_SESSION['pat_id'],12,7);
            $doewisqry = mysql_query("delete from overleg where overleg_pat_nr =".$_SESSION['pat_nr']);
            $doeqry=mysql_query("update patienten set pat_id='".$nieuwid."', pat_startdatum=0 where pat_nr=".$_SESSION['pat_nr']);
            $melding=$melding."Alle evaluaties van dit zijn ook verwijderd en het Zorgenplan_id ook aangepast: ".$nieuwid;
            }
        if ($overlegaantal==1)
            {
            $nieuwid=substr($_SESSION['pat_id'],0,6).substr($overlegrecords[0],2,6).substr($_SESSION['pat_id'],12,7);
            $doeqry=mysql_query("update patienten set pat_id='".$nieuwid."', pat_startdatum=0 where pat_nr=".$_SESSION['pat_nr']);
            $melding=$melding." Zorgenplan_id ook aangepast: ".$nieuwid;
            }
        }     
        
    $qry="
        SELECT
            o.overleg_datum,
            o.overleg_katzscore,
            o.overleg_id,
            o.overleg_type
            overleg_wilGDT
        FROM
            overleg o
        WHERE
            o.overleg_goedgekeurd=0 AND 
            (o.overleg_type = 0 OR o.overleg_type = 4) AND
            o.overleg_pat_nr=".$_SESSION['pat_nr']."
        ORDER BY
            o.overleg_datum";


/*if (!isset($_SESSION['pat_naam']) || $_SESSION['pat_naam']=="") {
  $queryPersoon = "select pat_naam, pat_voornaam from patienten
                   where pat_nr = {$_SESSION['pat_nr']};";
  if ($result = mysql_query($queryPersoon)) { // && mysql_num_rows($result) == 1) {
     $rij = mysql_fetch_array($result);
     $_SESSION['pat_naam'] = $rij['pat_naam'];
     $_SESSION['pat_voornaam'] = $rij['pat_voornaam'];
  }               
  else {
    print("dedju ik kan de naam van de patient niet ophalen en deze fout " . mysql_error() . " vanwege $queryPersoon zou je niet mogen zien!");
  }
}*/


        print("<h1>Overzicht overleggen</h1>
                uit zorgenplan ".$_SESSION['pat_id']."<br />
                van pati&euml;nt ".$_SESSION['pat_voornaam']." ".$_SESSION['pat_naam']."<br /><b>".$melding."</b><br />&nbsp;");
      print("<table width=\"100%\"><tr>
                    <th></th>
                    <th>Datum</th>
                    <th>Katz</th>
                    <th>Vergoeding</th>
                    </tr>");
      if ($result=mysql_query($qry))
         {
         for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
                $datum=substr($records[0],6,2)."/".substr($records[0],4,2)."/".substr($records[0],0,4);
            if ($records['overleg_wilGDT'] == 1) {
              $vergoeding = "aangevraagd";
            }
            else {
              $vergoeding = "";
            }
            if ($records['overleg_type'] == 0) { // actief overleg
              print ("<tr>
                 <td><a href=\"doe_overleg_10.php?wisoverleg_id=".$records['overleg_id']."\">Wis</a></td>
                 <td><a href=\"overleg.php?actie=afwerken&a_overleg_id=".$records['overleg_id']."\">".$datum."</a></td>
                 <td>".$records['overleg_katzscore']."</td>
                 <td>$vergoeding</td>
                    </tr>");
            }
            else {
              print ("<tr>
                 <td><a href=\"doe_overleg_10.php?wisoverleg_id=".$records['overleg_id']."\">Wis</a></td>
                 <td><a href=\"overleg_raadplegen.php?a_overleg_id=".$records['overleg_id']."\">".$datum."</a></td>
                 <td>".$records['overleg_katzscore']."</td>
                 <td>$vergoeding</td>
                    </tr>");
            }
           }
         }
      print("</table>");


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