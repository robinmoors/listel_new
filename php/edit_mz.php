<?php

session_start();

$paginanaam="Mantelzorger";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------

    {

    if ( ((isset($_POST['mzorg_naam'])&&($_POST['mzorg_naam']!=""))
            ||
          (isset($_POST['mzorg_voornaam'])&&($_POST['mzorg_voornaam']!=""))
         )
         &&($_SESSION['pat_code']!=""))
    {

        //---------------------------------------------------------

        if (isset($_POST['mzorg_gem_id']) && $_POST['mzorg_gem_id'] != 9999)

          $postcode = "gem_id={$_POST['mzorg_gem_id']},";

        else

          $postcode = "";

        $sql7 = "

            UPDATE

                mantelzorgers

            SET

               naam = '".$_POST['mzorg_naam']."',

               voornaam = '".$_POST['mzorg_voornaam']."',

               verwsch_id = '".$_POST['mzorg_verwsch_id']."',

               tel = '".$_POST['mzorg_tel']."',

               gsm = '".$_POST['mzorg_gsm']."',

               adres = '".$_POST['mzorg_adres']."',

               $postcode

               email = '".$_POST['mzorg_email']."',

               actief = 1

            WHERE id = {$_POST['id']}";

        if ($result=mysql_query($sql7))  

            { // succesvolle toevoeging aan dbase

            $melding="Gegevens van deze mantelzorger werden <b>succesvol aangepast</b>.<br />";

            }

            else

                {$melding="MZgegevens zijn <b>NIET succesvol ingevoegd</b>,<br>".$sql7;}

            }

     }



        //----------------------------------------------------------

        print("<script type=\"text/javascript\">");

        $query = "

            SELECT

                dlzip,dlnaam,id

            FROM

                gemeente

            ORDER BY

                dlzip";

        if ($result=mysql_query($query))

            {

            print ("var gemeenteList = Array(");

            for ($i=0; $i < mysql_num_rows ($result); $i++)

                {

                $records= mysql_fetch_array($result);

                print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");

                }

            print ("\"9999 onbekend\",\"9999\");");

            }

        print("</script>"); // Postcodelijst Opstellen voor javascript

        //----------------------------------------------------------



        include("../includes/html_html.inc");

        print("<head>");

        include("../includes/html_head.inc");

        print("</head>");

        print("<body onload=\"hideCombo('IIPostCodeS')\">");

        print("<div align=\"center\">");

        print("<div class=\"pagina\">");

        include("../includes/header.inc");

        include("../includes/pat_id.inc");

        print("<div class=\"contents\">");

        include("../includes/menu.inc");

        print("<div class=\"main\">");

        print("<div class=\"mainblock\">");

        if (!isset($melding)) $melding = "Pas de gegevens van de mantelzorger aan.";

        print("<h1>Gegevens mantelzorger aanpassen</h1>

            <p>$melding</p>");



        $qryMZ = "select * from mantelzorgers where id = {$_GET['a_mzorg_id']}";

        $mz = mysql_fetch_array(mysql_query($qryMZ));

        if (isset($mz['gem_id'])) {

           $qryGem = "select dlzip, dlnaam from gemeente where id = {$mz['gem_id']}";

           $gem = mysql_fetch_array(mysql_query($qryGem));

           $mz['dlzip'] = $gem['dlzip'];

           $mz['dlnaam'] = $gem['dlnaam'];

        }

        //print_r($mz);



        //---------------------------------------------------------------------------

        /* Toon form MZ selecteren */ include('../forms/edit_mz.php');

        //---------------------------------------------------------------------------





?>

   <fieldset>

      <div class="label160">

         <a href="overleg_plannen_select_mz_twee.php">Terug naar het overleg</a>

      </div>

   </fieldset>



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



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>