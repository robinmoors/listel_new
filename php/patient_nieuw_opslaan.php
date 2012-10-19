<?php

session_start();

$paginanaam="Patientgegevens toevoegen";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {

//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------

   $_POST['naam'] = str_replace("\n", "", $_POST['naam']);

   $_POST['naam'] = str_replace("\r", "", $_POST['naam']);

   $_POST['voornaam'] = str_replace("\n", "", $_POST['voornaam']);

   $_POST['voornaam'] = str_replace("\r", "", $_POST['voornaam']);



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

// Creatie van een zorgplannummer





    $queryAantal = "select count(id) from patient";

    $resultAantal = mysql_query($queryAantal);

    $rijAantal = mysql_fetch_array($resultAantal);

    $codeLetter = substr("ABCDEFGHIJKLMNOPQRSTUVWXYZ",$rijAantal[0]%26,1);



    $query = "

        SELECT

            sit.nr as sit_nr,

            sit.naam as sit_naam,

            gemeente.naam as gem_naam

        FROM

            sit, gemeente

        WHERE

            gemeente.id = {$_POST['pat_gem_id']}

            and gemeente.sit_id = sit.id

            ";

    $result = mysql_query($query);

    if (mysql_num_rows($result)<>0 )

        { // een correcte record gevonden

        $records= mysql_fetch_array($result);

        if (strlen($_POST['opstartjaar']) == 4) {

          $startjaar = substr($_POST['opstartjaar'],2,2);

        }

        else {

          $startjaar = $_POST['opstartjaar'];

        }

        $patientCode=$records['sit_nr']."/".strtoupper(substr($records['gem_naam'],0,2)).

                    "-$startjaar-".substr($_POST['pat_gebdatum_jjjj'],2,2).

                    $_POST['pat_gebdatum_mm'].$_POST['pat_gebdatum_dd'].

                    "-$codeLetter";

        }

    else if ($_SESSION['profiel']=="hoofdproject" || ($_SESSION['profiel']!="OC")) {

       // een patient die niet tot een sit behoort, en niet door OC behandeld wordt, krijg sit-nummer "aa"
       // een patient van buiten limburg krijgt sit-nummer "aa"

    $query = "

        SELECT

            gemeente.naam as gem_naam

        FROM

            gemeente

        WHERE

            gemeente.id = {$_POST['pat_gem_id']}

            ";

    $result = mysql_query($query);

    $records= mysql_fetch_array($result);

        if (strlen($_POST['opstartjaar']) == 4) {

          $startjaar = substr($_POST['opstartjaar'],2,2);

        }

        else {

          $startjaar = $_POST['opstartjaar'];

        }

        $patientCode="aa/".strtoupper(substr($records['gem_naam'],0,2)).

                    "-$startjaar-".substr($_POST['pat_gebdatum_jjjj'],2,2).

                    $_POST['pat_gebdatum_mm'].$_POST['pat_gebdatum_dd'].

                    "-$codeLetter";

    }

    else

        { // GEEN correcte record gevonden

        print("Deze gemeente neemt niet deel aan de werking van LISTEL vzw, en dus kunnen wij hiervoor geen zorgplan aanmaken.");

        mysql_close();

        die("<br />Neem contact op met de overlegco&ouml:rdinator TGZ van de gemeente waartoe de pati&euml;nt behoort voor ingave en verdere verwerking.");

        }



//----------------------------------------------------------

//----------------------------------------------------------

// Query om een nieuwe patient toe te voegen

   if ($_POST['pat_mut_id'] == "" || $_POST['pat_mut_id'] == 0) $_POST['pat_mut_id'] = 1;

   if ($_POST['pat_alarm'] == "") $_POST['pat_alarm'] = 2;

   if ($_SESSION['profiel']=="hoofdproject") {
     $actief = -1;
   }
   else if ($_SESSION['profiel']=="menos") {
     $actief = 0;
     $menosVeld = " ,menos ";
     $menosValue = " ,1 ";
   }
   else {
     $actief = 1;
   }

   if ($_SESSION['profiel']=="OC") {
     $toegewezenGenre = "gemeente";
     $toegewezenID = 0;
   }
   else if ($_SESSION['profiel']=="rdc") {
     $toegewezenGenre = "rdc";
     $toegewezenID = $_SESSION['organisatie'];
   }
   else if ($_SESSION['profiel']=="menos") {
     $toegewezenGenre = "gemeente";
     $toegewezenID = 0;
   }
   else if ($_SESSION['profiel']=="hoofdproject" || $_SESSION['profiel']=="bijkomend project") {
     $toegewezenGenre = "gemeente";
     $toegewezenID = 0;
   }
   else if ($_SESSION['profiel']=="psy") {
     $toegewezenGenre = "psy";
     $toegewezenID = $_SESSION['organisatie'];
   }
   else  { //hulp
     $toegewezenGenre = "hulp";
     $toegewezenID = $_SESSION['usersid'];
   }

   if ($_POST['toestemming_zh']==1) {
     $toestemming_zh = 1;
   }
   else if ($_POST['toestemming_zh']==-1) {
     $toestemming_zh = -1;
   }
   else {
     $toestemming_zh = 0;
   }
   
   if ($_POST['diabetes']==1) {
     $diabetes = 1;
   }
   else {
     $diabetes = 0;
   }
   if ($_POST['nieren']==1) {
     $nieren = 1;
   }
   else {
     $nieren = 0;
   }
   if ($_POST['geen_zorgtraject']==1) {
     $diabetes = 0;
     $nieren = 0;
   }
   $datumZorgtraject = date("Y-m-d");

   if ($_POST['pat_type']=="" || $_POST['pat_type']==16 || $_POST['pat_type']==18) {
     if ($_POST['pat_type_check']==1) {
       $_POST['pat_type'] = $_POST['pat_type_radio'];
     }
     else {
       $_POST['pat_type'] = $_POST['pat_type_hidden'];
     }
   }

    $writePatientQry = "

        INSERT INTO

            patient

                (

                code,

                naam,

                voornaam,

                tel,

                gsm,

                adres,

                gem_id,

                email,

                mut_id,

                sex,

                naam_echtg,

                voornaam_echtg,

                gebdatum,
                geboorteplaats,
                burgstand_id,

                type,

                alarm,

                mutnr,

                rijksregister,

                actief,
                toegewezen_genre,
                toegewezen_id,
                toestemming_zh,
                zorgtraject_diabetes,
                zorgtraject_nieren,
                zorgtraject_datum
                $menosVeld
                )

        VALUES

                (

                '".$patientCode."',

                '".$_POST['pat_naam']."',

                '".$_POST['pat_voornaam']."',

                '".$_POST['pat_tel']."',

                '".$_POST['pat_gsm']."',

                '".$_POST['pat_adres']."',

                ".$_POST['pat_gem_id'].",

                '".$_POST['pat_email']."',

                ".$_POST['pat_mut_id'].",

                ".$_POST['pat_sex'].",

                '".$_POST['pat_naam_echtg']."',

                '".$_POST['pat_voornaam_echtg']."',

                ".$_POST['pat_gebdatum_jjjj'].$_POST['pat_gebdatum_mm'].$_POST['pat_gebdatum_dd'].",
                '".$_POST['pat_geboorteplaats']."',

                ".$_POST['pat_burgstand_id'].",

                ".$_POST['pat_type'].",

                ".$_POST['pat_alarm'].",

                '".$_POST['pat_mutnr']."',

                '{$_POST['rijksregister']}',

                $actief,
                \"$toegewezenGenre\",
                $toegewezenID,
                $toestemming_zh,
                $nieren,
                $diabetes,
                '$datumZorgtraject'
                $menosValue

                )";

                

    //echo $writePatientQry;

    $doe=mysql_query($writePatientQry) or die(" $writePatientQry   " . mysql_error());

    $last_record_pat=mysql_insert_id();

    if ($doe) {

           print("<p>De patient is succesvol toegevoegd.</p>");

    }

    else {

           print("De patient is <b>niet</b> toegevoegd omwille van $writePatientQry.");

    }

    if ($_SESSION["profiel"]=="menos") {
      $overlegGenre = 'menos';
    }
    else {
      $overlegGenre = 'gewoon';
    }

    mysql_query("insert into huidige_betrokkenen (patient_code, genre, persoon_id, aanwezig, overleggenre)
                  values ('$patientCode','patient',0,0,'$overlegGenre')") or print("Ik heb de patient niet kunnen toevoegen als betrokkene.");



//----------------------------------------------------------

// Levende echtgenoot opslaan als mantelzorger en als betrokken MZ



    if((isset($_POST['pat_burgstand_id'])) &&

          ($_POST['pat_burgstand_id']==3 || $_POST['pat_burgstand_id']==9)

        && ($_POST['pat_naam_echtg']!="" || $_POST['pat_voornaam_echtg']!="" ))

        {

        if ($_POST['pat_burgstand_id']==3) $verwantschap = 21; else $verwantschap = 22;

        $qry1="

            INSERT INTO 

                mantelzorgers 

                (naam,voornaam,verwsch_id) 

            VALUES 

                ('".$_POST['pat_naam_echtg']."','".$_POST['pat_voornaam_echtg']."',$verwantschap)";

        $schrijfmz1=mysql_query($qry1);

        $last_record_mz=mysql_insert_id();

//        print($qry1);
             if ($_SESSION["profiel"]=="menos") {
               $overlegGenre = 'menos';
             }
             else {
               $overlegGenre = 'gewoon';
             }

        $qry2="

            INSERT INTO 

                huidige_betrokkenen

                (patient_code,genre, persoon_id, overleggenre)

            VALUES 

                ('$patientCode','mantel',$last_record_mz, '$overlegGenre')";

        $schrijfmz2=mysql_query($qry2);

//        print($qry2);

         if ($schrijfmz1 && $schrijfmz2) {

           print("<p>De partner werd in de lijst van mantelzorgers van de pati&euml;nt opgenomen.</p>");

         }

         else {

           print("De mantelzorger is <b>niet</b> toegevoegd omwille van $qry1 en $qry2.");

         }

        }



    if ($_SESSION["profiel"] == "hoofdproject") {

       $qryTP = "insert into patient_tp (patient, project, begindatum) values (\"$patientCode\", {$_SESSION['tp_project']}, NOW())";

       if (mysql_query($qryTP)) {

          $qryUpdatePatient = "update patient set tp_record = " . mysql_insert_id() . " where code = '$patientCode'";

          if (!(mysql_query($qryUpdatePatient))) {

            print("<p>Kan geen verwijzing naar het tp-record opslaan.</p>");

          }



          // de partners van het project toevoegen in huidige_betrokkenen

          $ok = true;

          $qryPrefix = "insert into huidige_betrokkenen (patient_code, genre, overleggenre, persoon_id) values (\"$patientCode\", 'org', 'gewoon', ";

          $qryPartners = "select * from tp_partner where tp = {$_SESSION['tp_project']}";

          $resultPartners  = mysql_query($qryPartners);

          for ($i=0; $i<mysql_num_rows($resultPartners); $i++) {

              $partner = mysql_fetch_assoc($resultPartners);

              $qryInsert = $qryPrefix . " {$partner['partner']});";

              $ok = $ok && mysql_query($qryInsert);

          }



         if ($ok)

           print("<p>Ga nu verder met het beantwoorden van <a href='patient_tp_vragen.php?code=$patientCode'>de project-gerelateerde vragen</a>.</p>");

         else

           print("allez seg: kan partners niet koppelen: $qryInsert " . mysql_error());

       }

    }
    else if ($_SESSION["profiel"] == "menos") {
       if (bestaatInMenos($patientCode)) {
         print("<p>Ga nu verder met het beantwoorden van <a href='patient_menos_vragen.php?code=$patientCode'>de menos-gerelateerde vragen</a>.</p>");
       }
       else {
         $qryTP = "insert into patient_menos (patient, begindatum) values (\"$patientCode\", NOW())";
         if (mysql_query($qryTP)) {
           print("<p>Ga nu verder met het beantwoorden van <a href='patient_menos_vragen.php?code=$patientCode'>de menos-gerelateerde vragen</a>.</p>");
         }
       }
    }
    else if ($_POST["pat_type"] == 16 || $_POST["pat_type"] == 18) {
      print("<p>Ga nu verder met het beantwoorden van <a href='patient_psy_vragen.php?code={$patientCode}'>de opstartvragen voor psychiatrische pati&euml;nten</a>.</p>");
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