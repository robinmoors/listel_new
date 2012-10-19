<?php





if (!function_exists('overleg_files')) {

function overleg_files($genre, $auteur, $overlegID, $readOnly, $overlegInfo) {

  global $hoogte;


  if ($genre == "verslag") {

    $genreTekst = "Bijlagen";

    $genreTekst2 = "Bijlage";

    $uitleg = "<p>Hier kan je een uitgebreid verslag of andere bijlagen toevoegen.</p>";

  }

  else  {

    $genreTekst = "Bijlagen";

    $genreTekst2 = "Bijlage";

  }



  if ($genre != "") {

     $hiddenGenre = "<input type=\"hidden\" name=\"genre\" value=\"$genre\" />";

     $genre = " genre = \"$genre\" AND ";

  }



  if ($_SESSION['profiel'] == "OC") {

    $genre = $genre . " auteurgenre = 'OC' AND ";
    if (issett($overlegID)) $file_res = mysql_query("SELECT * FROM overleg_files WHERE $genre overleg_id = $overlegID ");
  }
  else if ($_SESSION['profiel'] == "menos") {
    if (issett($overlegID)) $file_res = mysql_query("SELECT * FROM overleg_files WHERE overleg_id = $overlegID ");
  }
  else if ($_SESSION['profiel'] == "hoofdproject" || $_SESSION['profiel'] == "bijkomend project") {
    if (issett($overlegID)) $file_res = mysql_query("SELECT * FROM overleg_files WHERE overleg_id = $overlegID ");
  }
  else if ($_SESSION['profiel'] == "hulp") {
    if ($overlegInfo['toegewezen_genre']=="hulp" && $overlegInfo['toegewezen_id']==$_SESSION['usersid']) {
      $genre = $genre . " auteurgenre = 'OC' AND ";
      if (issett($overlegID)) $file_res = mysql_query("SELECT * FROM overleg_files WHERE $genre overleg_id = $overlegID ");
    }
    else {
      $genre = $genre . " auteurgenre = 'OC' AND ";
      if (issett($overlegID)) $file_res = mysql_query("SELECT * FROM overleg_files, overleg_files_rechten
                                 WHERE $genre overleg_id = $overlegID
                                   and overleg_files.filename = overleg_files_rechten.filename
                                   and overleg_files_rechten.genre ='hulp'
                                   and overleg_files_rechten.id = {$_SESSION['usersid']}
                                   and overleg_files_rechten.rechten = 1 ");
    }
  }
  else if ($_SESSION['profiel'] == "rdc") {
    if ($overlegInfo['toegewezen_genre']=="rdc" && $overlegInfo['toegewezen_id']==$_SESSION['organisatie']) {
      $genre = $genre . " auteurgenre = 'OC' AND ";
      if (issett($overlegID)) $file_res = mysql_query("SELECT * FROM overleg_files WHERE $genre overleg_id = $overlegID ");
    }
    else {
      if (issett($overlegID)) $file_res = mysql_query("SELECT * FROM overleg_files WHERE 1=0");// niks selecteren
    }
  }
  else if ($_SESSION['profiel'] == "psy") {
    if ($overlegInfo['toegewezen_genre']=="psy" && $overlegInfo['toegewezen_id']==$_SESSION['organisatie']) {
      $genre = $genre . " auteurgenre = 'OC' AND ";
      if (issett($overlegID)) $file_res = mysql_query("SELECT * FROM overleg_files WHERE $genre overleg_id = $overlegID ");
    }
    else {
      if (issett($overlegID)) $file_res = mysql_query("SELECT * FROM overleg_files WHERE 1=0");// niks selecteren
    }
  }

         // bestaande files weergeven


       if (isset($readOnly) ) {

           if (isZorgBemiddelaar()) {
                 $magVeranderen = true;
           }
           else if ($overlegInfo['afgerond']==1) {
             $magVeranderen = false;
           }
           else if (isNuOrganisator()){
             $magVeranderen = true;
           }
           else {
             $magVeranderen = false;
           }

         // scherm groter maken als er veel bijlagen zijn!
         if (issett($overlegID)) {if ($hoogte < 40+150*(mysql_num_rows($file_res))) $hoogte = 40+150*mysql_num_rows($file_res); }
         
         
         if (issett($overlegID) && mysql_num_rows($file_res)) {

             print("<li><p><strong>$genreTekst</strong><br />");

             print("<ul style=\"margin: 10px 0\">");

             while ($overleg_file = mysql_fetch_object($file_res)) {

                print("<li><a target=\"_blank\" href=\"/_download/" . $overleg_file->filename . "\">" . $overleg_file->alias . "</a>");
                toonRechten("overleg_files", "filename", $overleg_file->filename, $magVeranderen);
                print("</li>");
             }

             print("</ul>");

         }

       }

       else {

         print("<li><p><strong>$genreTekst</strong><br />");

         print("$uitleg");
         echo <<< EINDE

<script type="text/javascript">
function testFormBijlagen() {
  document.uploadform.submit.disabled='true';
  document.uploadform.submit.value='Bezig met versturen';
}

</script>

         <form action="overleg_alles.php?tab=Attesten" method="post" enctype="multipart/form-data" name="uploadform" onsubmit="testFormBijlagen();">
EINDE;
/* hier flipt internet explorer??? */

         print("$hiddenGenre");

         if (issett($overlegID) && mysql_num_rows($file_res)) {

           if (isZorgBemiddelaar()) {
                 $magVeranderen = true;
           }
           else if ($tabel=="afgeronde") {
             $magVeranderen = false;
           }
           else if (isNuOrganisator()){
             $magVeranderen = true;
           }
           else {
             $magVeranderen = false;
           }

             print("Een toegevoegd bestand kan verwijderd worden door het aan te vinken en vervolgens op de knop \"Bestand(en) verwijderen\" te klikken.<br />");

             print("<ul style=\"margin: 10px 0\">");

             while ($overleg_file = mysql_fetch_object($file_res)) {

                print("<li>");
                  print("<input type=\"checkbox\" name=\"delfiles[]\" value=\"" . $overleg_file->filename . "\">\n");
                  print("<a target=\"_blank\" href=\"/_download/" . $overleg_file->filename . "\">" . $overleg_file->alias . "</a>\n");
                  toonRechten("overleg_files", "filename", $overleg_file->filename, $magVeranderen);

                print("</li>");

             }

             print("</ul>\n");

             $verwijderknop = "<input type=\"submit\" name=\"submit2\" value=\"Bestand(en) verwijderen\"  />&nbsp;";

         }



         print("Toevoegen: <input type=\"file\" name=\"upload\"><br />$verwijderknop <input type=\"submit\" name=\"submit\" value=\"$genreTekst2 toevoegen\"  />



            </form>");

         print("</p></li>");

       }



}

}





      if (!isset($readOnly) || !$readOnly) {

         if ($overlegInfo['genre']=="TP") {

           if ($_SESSION['profiel']=="OC")

             $auteur = "OC";

           else

             $auteur = "TP";

           $velden = ", genre, auteurgenre, auteur ";

           $values = ", '{$_POST['genre']}', '$auteur', {$_SESSION['usersid']} ";

         }



         // yse - afsluiten upload docs

         // nieuwe files toevoegen

         if ($_FILES['upload']['tmp_name']) {

            $alias = pathinfo(strtolower($_FILES['upload']['name']));

            $filename = md5(uniqid(rand(), true)) . '.' . $alias["extension"];



            //toegelaten extensies

            $extensies_ok = array('pdf','xls','doc','docx','txt');

            if (in_array($alias["extension"],$extensies_ok)) {

                move_uploaded_file($_FILES['upload']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/_download/' . $filename);

                // insert query

                mysql_query("INSERT into overleg_files (overleg_id, filename, alias, created $velden)
                        VALUES ('$overlegID','" . $filename . "','" . $alias["basename"] . "',NOW() $values)");

           /************************************/
           // en nu de rechten voor dit bestand opslaan
           $qryRechtenOpvragen="
               SELECT *
               FROM huidige_betrokkenen
               WHERE overleggenre = 'gewoon'
                 and patient_code='".$_SESSION['pat_code']."'
                 and not (genre = 'org') order by id";

          if ($result1=mysql_query($qryRechtenOpvragen))
          {
              for ($i=0; $i < mysql_num_rows ($result1); $i++)
              {
                $records1= mysql_fetch_array($result1);
                /* als rechten dezelfde moeten zijn als die van het overleg
                $qryRechtenKopieren="
                     INSERT INTO
                       overleg_files_rechten (filename, genre, id, rechten)
                     VALUES (\"$filename\", \"{$records1['genre']}\",{$records1['persoon_id']},{$records1['rechten']})";
                */
                $qryRechtenKopieren="
                     INSERT INTO
                       overleg_files_rechten (filename, genre, id, rechten)
                     VALUES (\"$filename\", \"{$records1['genre']}\",{$records1['persoon_id']},0)";
                if (!mysql_query($qryRechtenKopieren)) {
                  print("<h1>begot: $qryRechtenKopieren lukt niet <br>" . mysql_error() . "</h1>");
                }
              }
          }
          else {
            print("<h1>begot: $qryRechtenOpvragen lukt niet <br>" . mysql_error() . "</h1>");
          }
           /************************************/
           // bijlagerechten zijn opgeslagen!


                $msg = "<p style='background-color:#8f8'>Bestand toegevoegd</p>";

            }

            else {

                $msg = '<span class="accentcel">Enkel .txt, PDF, Word-documenten en Excel documenten zijn toegestaan</span>';

                }





         }

         print($msg);



         // files verwijderen

         if (is_array($_POST['delfiles'])) {

            foreach ($_POST['delfiles'] as $bestand) {

                mysql_query("DELETE FROM overleg_files WHERE overleg_id = $overlegID AND filename = '" . $bestand . "'");
                unlink($_SERVER['DOCUMENT_ROOT'] . '/_download/' . $bestand);

                $qryRechtenWissen="
                     DELETE FROM
                       overleg_files_rechten
                     WHERE filename =  \"$bestand\"";
                if (!mysql_query($qryRechtenWissen)) {
                  print("<h1>begot: $qryRechtenWissen lukt niet <br>" . mysql_error() . "</h1>");
                }

            }

         }





      }

// aantal bijlagen tellen
    if (issett($overlegInfo['id'])) {
      $qryBijlageGevonden    = "select overleg_id from overleg_files where overleg_id = {$overlegInfo['id']}";
      $resultBijlageGevonden = mysql_query($qryBijlageGevonden) or die($qryBijlageGevonden . " is fout.");
      $aantalBijlagen = mysql_num_rows($resultBijlageGevonden);
    }
    else {
      $aantalBijlagen = 0;
    }
    print("<script type=\"text/javascript\">var aantalBijlagen = $aantalBijlagen;</script>\n");

print("<hr/>");



if ($overlegInfo['genre']=="TP") {

  if ($_SESSION['profiel']=="OC")

    $auteur = "OC";

  else

    $auteur = "TP";

  overleg_files("verslag", $auteur, $overlegInfo['id'], $readOnly, $overlegInfo);

//  overleg_files("gewoon", $auteur);

}

else {

  overleg_files("", "OC", $overlegInfo['id'], $readOnly, $overlegInfo);

}



?>
