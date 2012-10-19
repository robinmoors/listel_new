<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

    //----------------------------------------------------------



$paginanaam="Dossier wegschrijven in archief";

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

    print ("<h1>Lijst gearchiveerde zorgplannen</h1>");

if (isset($_POST['startjaar'])) {
   $qry = "select patient.naam, patient.voornaam, code, patient_menos.einddatum, reden
             from patient inner join patient_menos on code = patient
                                 and menos = 0
                                 and patient_menos.einddatum >= '{$_POST['startjaar']}'
                                 and patient_menos.einddatum <= '{$_POST['eindjaar']}'
                                 order by naam asc, voornaam asc";
   print("<table><tr><th>Pati&euml;nt</th><th>Einddatum</th><th>Reden</th></tr>");
   $result = mysql_query($qry) or die(mysql_error() . $qry);
   for ($i=0; $i < mysql_num_rows($result); $i++) {
     $records = mysql_fetch_assoc($result);
     $mooieDatum = substr($records['einddatum'],8,2) . "/" . substr($records['einddatum'],5,2) . "/" . substr($records['einddatum'],0,4);
     print("
       <tr>
         <td>{$records['naam']} {$records['voornaam']} (<a href=\"patientoverzicht.php?pat_code={$records['code']}\">{$records['code']}</a>)</td>
         <td>{$mooieDatum}</td>
         <td>{$records['reden']}</td>
       </tr>");
   }
   print("</table>");
}


?>

<!-- Start FORMULIER -->

<form action="lijst_archief_menos.php" method="post" name="archiefform">

   <fieldset>

      <div class="legende">Stopzetting lag tussen:</div>

      <div>&nbsp;</div>

      <div class="inputItem" id="IIStartjaar">

         <div class="label160">Startjaar&nbsp;: </div>

         <div class="waarde">

            <select size="1" name="startjaar" >
                    <option value="2011-00-00">2011</option>
<?php
  for ($i = 12; $i < 33; $i++)
    print("                <option value=\"20$i-00-00\">20$i</option>\n");
?>

            </select>

         </div> 

      </div><!--pat_startjaar-->

      <div class="inputItem" id="IIEindjaar">

         <div class="label160">Eindjaar&nbsp;: </div>

         <div class="waarde">

            <select size="1" name="eindjaar" >
                    <option value="2011-99-99">2011</option>

<?php

  for ($i = 12; $i < 33; $i++)

    print("                <option value=\"20" . "{$i}-99-99\">20" . "$i</option>\n");

?>


            </select>

         </div> 

      </div><!--pat_eindjaar-->

    </fieldset>

    <fieldset>

        <div class="inputItem" id="IIButton">

         <div class="label220">Dossier &nbsp;</div>

         <div class="waarde">

         <input type="submit" value="openen" name="action" />

         </div> 

      </div><!--action-->

   </fieldset>

</form>

<?php

                

    //---------------------------------------------------------

    /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

    //---------------------------------------------------------



    print("</div>");

    print("</div>");

    print("</div>");

    require("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>