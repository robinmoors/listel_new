<?php

session_start();

$paginanaam="Patientgegevens";







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

    $gem_id_string=(!isset($_POST['pat_gem_id']))?$_POST['h_pat_gem_id']:$_POST['pat_gem_id'];



//----------------------------------------------------------

// query om de patientgegevens aan te passen

    $mut_id_string=(!isset($_POST['pat_mut_id']))?$_POST['h_pat_mut_id']:$_POST['pat_mut_id'];

    if ($mut_id_string == "" || $mut_id_string == 0) $mut_id_string = 1;

    

   if ($_POST['pat_type']=="") {
     if ($_POST['pat_type_check']==1) {
       $_POST['pat_type'] = $_POST['pat_type_radio'];
     }
     else {
       $_POST['pat_type'] = $_POST['pat_type_hidden'];
     }
   }

    if (isset($_POST['pat_type']) && strlen($_POST['pat_type']) > 0 )
      $typeString = " type={$_POST['pat_type']}, ";



   $_POST['naam'] = str_replace("\n", "", $_POST['naam']);

   $_POST['naam'] = str_replace("\r", "", $_POST['naam']);

   $_POST['voornaam'] = str_replace("\n", "", $_POST['voornaam']);

   $_POST['voornaam'] = str_replace("\r", "", $_POST['voornaam']);

   if ($_POST['toestemming_zh']==1) {
     $toestemming_zh = 1;
   }
   else if ($_POST['toestemming_zh']==-1) {
     $toestemming_zh = -1;
   }
   else {
     $toestemming_zh = 0;
   }

//*****  historiek van zorgtrajecten opslaan
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

   $oudZorgtraject = getUniqueRecord("select zorgtraject_diabetes, zorgtraject_nieren, zorgtraject_datum from patient where code='{$_SESSION['pat_code']}'");
   if ($oudZorgtraject['zorgtraject_datum']!="0000-00-00"
       &&
          ($oudZorgtraject['zorgtraject_diabetes'] != $diabetes
            ||
           $oudZorgtraject['zorgtraject_nieren'] != $nieren)
       ) {
     // er bestond er een, en nu is het verschillend
     $insert = mysql_query("insert into patient_zorgtraject (patient, diabetes, nieren, datum)
                            values ('{$_SESSION['pat_code']}',
                                    {$oudZorgtraject['zorgtraject_diabetes']},
                                    {$oudZorgtraject['zorgtraject_nieren']},
                                    '{$oudZorgtraject['zorgtraject_datum']}')") or die("Kon oud zorgtraject niet bewaren.");
   }
   $zorgtraject = " zorgtraject_diabetes = $diabetes, zorgtraject_nieren = $nieren, zorgtraject_datum = '$datumZorgtraject',  ";

//*****


    $writePatientQry = "

        UPDATE

            patient

        SET

            naam='".$_POST['naam']."',

            voornaam='".$_POST['voornaam']."',

            tel='".$_POST['tel']."',

            gsm='".$_POST['gsm']."',

            adres='".$_POST['adres']."',

            email='".$_POST['email']."',

            mut_id=".$mut_id_string.",

            sex=".$_POST['sex'].",

            naam_echtg='".$_POST['naam_echtg']."',

            voornaam_echtg='".$_POST['voornaam_echtg']."',

            burgstand_id=".$_POST['burgstand_id'].",

            geboorteplaats = '{$_POST['geboorteplaats']}',

            $typeString

            alarm=".$_POST['alarm'].",

            gem_id=".$gem_id_string.",

            mutnr='".$_POST['mutnr']."',
            toestemming_zh = $toestemming_zh,
            $zorgtraject

            rijksregister='{$_POST['rijksregister']}'

        WHERE

            code='{$_SESSION['pat_code']}'";




    $doe=mysql_query($writePatientQry);

//----------------------------------------------------------



//----------------------------------------------------------

// Levende echtgenoot of samenwoner opslaan als mantelzorger en als betrokken MZ

// 31: ex_partner wanneer er een nieuwe partner gemaakt wordt

    if((isset($_POST['burgstand_id'])) && ($_POST['burgstand_id']==3 || $_POST['burgstand_id']==9))

        {

        if ($_POST['burgstand_id']==3) $verwantschap = 21; else $verwantschap = 22;

        if (($_POST['burgstand_id'] == $_POST['oud_burgstand_id'] ||

                  ($_POST['burgstand_id'] == 2 && $_POST['oud_burgstand_id'] == 3) ||

                  ($_POST['burgstand_id'] == 2 && $_POST['oud_burgstand_id'] == 9) ||

                  ($_POST['burgstand_id'] == 9 && $_POST['oud_burgstand_id'] == 2) ||

                  ($_POST['burgstand_id'] == 9 && $_POST['oud_burgstand_id'] == 3) ||

                  ($_POST['burgstand_id'] == 3 && $_POST['oud_burgstand_id'] == 2)||

                  ($_POST['burgstand_id'] == 3 && $_POST['oud_burgstand_id'] == 9))

            &&

            ($_POST['oud_naam_echtg'] != $_POST['naam_echtg'] ||

             $_POST['oud_voornaam_echtg'] != $_POST['voornaam_echtg'] ||

             $_POST['burgstand_id'] != $_POST['oud_burgstand_id'])) {

           // al getrouwd of van samenwonend naar getrouwd of van getrouwd naar samenwonend: we gaan dus de partner aanpassen

           // keuze: ofwel hertrouwen, ofwel oude partner overschrijven

               // we hebben niet meer gekozen voor hertrouwen.

               //$qryUpdateHertrouwe = "UPDATE mantelzorgers set  mzorg_verwsch_id = 31 where

               //   mzorg_naam = \"{$_POST['oud_naam_echtg']}\" and mzorg_voornaam = \"{$_POST['oud_voornaam_echtg']}\"";

               // $nieuweEchtgenoot = true;

               // als toch hertrouwen: ook if hieronder veranderen in if ($nieuweEchtgenoot || $_POST['burgstand_id'] != $_POST['oud_burgstand_id']) {

           $qryUpdate = "

               UPDATE mantelzorgers

               SET    naam = \"{$_POST['naam_echtg']}\",

                      voornaam = \"{$_POST['voornaam_echtg']}\",

                      verwsch_id = $verwantschap

               WHERE  naam = \"{$_POST['oud_naam_echtg']}\" and voornaam = \"{$_POST['oud_voornaam_echtg']}\"";

           if ($_POST['oud_naam_echtg']=="" && $_POST['oud_voornaam_echtg']=="") {

             $qry1="

              INSERT INTO

                  mantelzorgers

                  (naam,voornaam,verwsch_id)

              VALUES

                  ('".$_POST['naam_echtg']."','".$_POST['voornaam_echtg']."',$verwantschap)";

             $schrijfmz=mysql_query($qry1);

             $last_record_mz=mysql_insert_id();

             //print($qry1);

             if ($_SESSION["profiel"]=="menos") {
               $overlegGenre = 'menos';
             }
             else if ($_SESSION["profiel"]=="psy") {
               $overlegGenre = 'psy';
             }
             else {
               $overlegGenre = 'gewoon';
             }


             $qry2="

                INSERT INTO

                   huidige_betrokkenen

                   (persoon_id, genre, patient_code, aanwezig, overleggenre)

                VALUES

                   ($last_record_mz,'mantel','".$_SESSION['pat_code']."', 1, '$overlegGenre')";

             $schrijfmz=mysql_query($qry2);

           }

           else if (!mysql_query($qryUpdate))

             die($qryUpdate);

        }

        if (($_POST['oud_burgstand_id'] != 3) && ($_POST['oud_burgstand_id'] != 9) && ($_POST['oud_burgstand_id'] != 2)

             && ($_POST['naam_echtg']!="" || $_POST['voornaam_echtg']!="" )) { // van iets anders dan gewone partner, getrouwd of samenwonend

          $qry1="

            INSERT INTO 

                mantelzorgers 

                (naam,voornaam,verwsch_id)

            VALUES 

                ('".$_POST['naam_echtg']."','".$_POST['voornaam_echtg']."',$verwantschap)";

          $schrijfmz=mysql_query($qry1);

          $last_record_mz=mysql_insert_id();

          //print($qry1);


             if ($_SESSION["profiel"]=="menos") {
               $overlegGenre = 'menos';
             }
             else if ($_SESSION["profiel"]=="psy") {
                $overlegGenre = 'psy';
             }
             else {
               $overlegGenre = 'gewoon';
             }

          $qry2="

              INSERT INTO

                 huidige_betrokkenen

                 (persoon_id, genre, patient_code, aanwezig, overleggenre)
              VALUES

                 ($last_record_mz,'mantel','".$_SESSION['pat_code']."', 1, '$overlegGenre')";

          $schrijfmz=mysql_query($qry2);

          //print($qry2);

        }

        }



        // oude partner verwijderen als niet meer samenwonend of als van gehuwd naar weduwe of als van samenwonend naar weduwe

        $zonderPartnerGevallen = false;

        if ($_POST['oud_burgstand_id'] == 9 &&  $_POST['burgstand_id'] !=9 &&  $_POST['burgstand_id'] !=3)

           $zonderPartnerGevallen = true; // samenwonend en niet meer samenwonend noch gehuwd

        if ($_POST['oud_burgstand_id'] == 9 &&  $_POST['burgstand_id'] ==5)

           $zonderPartnerGevallen = true; // van samenwonend naar weduwe

        if ($_POST['oud_burgstand_id'] == 3 &&  $_POST['burgstand_id'] ==5)

           $zonderPartnerGevallen = true; // van gehuwd naar weduwe

        if ($_POST['oud_burgstand_id'] == 2 &&  $_POST['burgstand_id'] ==2 && $_POST['oud_naam_echtg'] != $_POST['naam_echtg'] && $_POST['naam_echtg'] == "")

           $zonderPartnerGevallen = true;   // gewone partner weggevallen

        

        if ($zonderPartnerGevallen) {

           $partnerIDQ =  "select id from mantelzorgers where naam = \"{$_POST['oud_naam_echtg']}\" and voornaam = \"{$_POST['oud_voornaam_echtg']}\"";

           if (!($partnerIDRes = mysql_query($partnerIDQ))) die($partnerIDQ);

           $partnerIDRij =mysql_fetch_array($partnerIDRes);

           $partnerID = $partnerIDRij['id'];

             if ($_SESSION["profiel"]=="menos") {
               $overlegGenre = 'menos';
             }
             else {
               $overlegGenre = 'gewoon';
             }

           $partnerWeg = "delete from huidige_betrokkenen where overleggenre = '$overlegGenre' and genre = 'mantel' and persoon_id = $partnerID and patient_code = '{$_SESSION['pat_code']}'";

           if (!mysql_query($partnerWeg)) die($partnerWeg);

        }



//----------------------------------------------------------

    preset($_POST['gdt2menosVraag']);
    preset($_POST['menos2gdtToestemming']);
    if (isset($_POST['menosVragen'])) {
      mysql_query("update patient_menos
                          set gdt2menos_vraag = {$_POST['gdt2menosVraag']},
                              menos2gdt_toestemming = {$_POST['menos2gdtToestemming']}
                          where patient =  '{$_SESSION['pat_code']}'");
    }
    if (isset($_POST['gdtVragen'])) {
      mysql_query("update patient_menos
                          set menos2gdt_vraag = {$_POST['menos2gdtVraag']},
                              gdt2menos_toestemming = {$_POST['gdt2menosToestemming']}
                          where patient =  '{$_SESSION['pat_code']}'");
    }



     print("<p>De gegevens zijn succesvol aangepast.");

    if ($_SESSION["profiel"] == "hoofdproject") {
      print("<p>Ga nu verder met <a href='patient_tp_vragen.php?code={$_SESSION['pat_code']}'>de project-gerelateerde vragen</a>.</p>");
    }
    else if ($_SESSION["profiel"] == "menos") {
      print("<p>Ga nu verder met het beantwoorden van <a href='patient_menos_vragen.php?code={$_SESSION['pat_code']}'>de menos-gerelateerde vragen</a>.</p>");
    }
    else if ($_POST["pat_type"] == 16 || $_POST["pat_type"] == 18) {
      print("<p>Ga nu verder met het beantwoorden van <a href='patient_psy_vragen.php?code={$_SESSION['pat_code']}&vanTP={$_POST['vanTP']}'>de opstartvragen voor psychiatrische pati&euml;nten</a>.</p>");
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