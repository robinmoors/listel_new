<?php

   session_start();

   $paginanaam="";

   if ($_SESSION['binnenViaCode'] || (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")))

      {

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



//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------

switch(true)

    {

    case(!(isset($_POST['action']))):

        //------------------------------

            $Var_ei_09_01_t="";

 // Reset values

        //------------------------------



        if((isset($_SESSION['action']))AND($_SESSION['action']=="Aanpassen"))

            {

            //---------------------------

            $qry="

                SELECT

                    ei_09_01_t

                FROM

                    evalinstr

                WHERE

                    ei_id = {$_SESSION['evalinstr_id']}";

//          print($qry);

            $result=mysql_query($qry);

            $records=mysql_fetch_array($result); // Get record

            //---------------------------

            //-------------------------------------------------

            $Var_ei_09_01_t=$records['ei_09_01_t']; // Update values according to dbase

            //-------------------------------------------------

            }

?>

<!-- Start Formulier -->

<form action="ingeven_evaluatie_instr_09.php" method="post" name="evaluatieInstrForm">

   <fieldset>

      <div class="legende">9. Bijkomende aandachtspunten</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <textarea rows="4" wrap="soft" cols="50" name="ei_09_01_t"><?php print($Var_ei_09_01_t);?></textarea>

      </div>

      <div>&nbsp;</div>

   </fieldset>

    <fieldset>

        <div class="inputItem" id="IIButton">

         <div class="label220">Deze gegevens</div>

         <div class="waarde">

         <input type="submit" value="Opslaan" name="action" />

         </div> 

      </div><!--action-->

    </fieldset>

</form>

<!-- Einde Formulier -->

<?php

        break;

    case((isset($_POST['action']))AND($_POST['action']=="Opslaan")):

        //-------------------------------

        $qry="

                UPDATE evalinstr

                SET

                    ei_09_01_t='".$_POST['ei_09_01_t']."'

                WHERE

                    ei_id = {$_SESSION['evalinstr_id']}";

            $result=mysql_query($qry); // Update record

        //-------------------------------

        // evaluatie-instrument helemaal ingevuld, dus toevoegen aan overleg!

       $qryCode = "select * from overleg

                   where patient_code = \"{$_SESSION['pat_code']}\"

                   AND afgerond = 0;";

       if ($codeResult = mysql_query($qryCode)) {

          if (mysql_num_rows($codeResult) == 1) {

            $codeRij = mysql_fetch_array($codeResult);

            $overlegID = $codeRij['id'];

          }

       }

       else {

         die("stomme code-query  $qryCode");

       }



              $updateOverleg = "update overleg

                                set evalinstr_id = {$_SESSION['evalinstr_id']}

                                where id = $overlegID";

              if (!mysql_query($updateOverleg)) {die("<h1>Overleg niet geupdate met evalInstrID. mag niet</h1>");}



        /************ begin email sturen naar organisator van het overleg ***********************/
           $overlegInfo = getFirstRecord("select * from overleg where id = $overlegID");
           $organisator = organisatorRecordVanOverleg($overlegInfo);



           $msg = "Het evaluatieinstrument bij patient {$_SESSION['pat_code']} is ingevuld. Je kan nu verder met het overleg af te ronden.";

           htmlmail($organisator['email'],"Listel: evaluatie-instrument {$_SESSION['pat_code']} ingevuld.","Beste overlegco&ouml;rdinator<br/>$msg \n<br /><p>Met dank voor uw medewerking, <br />Het LISTEL e-zorgplan www.listel.be </p>");

        



        //--------------------------------------

        if (isset($_SESSION['vanuitPatientOverzicht'])) {

           $verder = "patientoverzicht.php";

        }

        else {

           $verder = "overleg_alles.php?tab=Attesten";

        }

        

        if ($_SESSION['binnenViaCode']) {

          $_SESSION['binnenViaCode'] = false;

          unset($_SESSION['binnenViaCode']);

          print("<h1>Het evaluatie-instrument is succesvol opgeslagen.</h1><p>Bedankt.<br/><br/><br/><br/><br/><br/><br/><br/>&nbsp;</p>");

        }

        else {

          print("<script type=\"text/javascript\">

          document.location=\"$verder\"

          </script>"); // Redirect to next page

          //--------------------------------------

        }

        break;

    case (true):

        print("<p>Foute toegang van deze pagina</p>");

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

/* Geen Toegang */

  if (!isset($_SESSION['binnenViaCode']) || !$_SESSION['binnenViaCode'])

     include("../includes/check_access.inc");

//---------------------------------------------------------

?>