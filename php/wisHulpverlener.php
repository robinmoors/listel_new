<?php

// $_GET['naam'] en $_GET['voornaam']

session_start();


   require("../includes/dbconnect2.inc");
   
   if (!isset($_GET['nieuw']) && !isset($_GET['oud'])) die("zowel nieuw als oud moeten gezet zijn.");

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

  $update = "update huidige_betrokkenen set persoon_id = {$_GET['nieuw']}
             where persoon_id = {$_GET['oud']} and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update huidige_betrokkenen" . mysql_error());
  
  $update = "update afgeronde_betrokkenen set persoon_id = {$_GET['nieuw']}
             where persoon_id = {$_GET['oud']} and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update afgeronde_betrokkenen" . mysql_error());

  $update = "update aanvraag_overdracht set van_id = {$_GET['nieuw']}
             where van_id = {$_GET['oud']} and (van_genre = 'hulp' or van_genre='orgpersoon')";
  if (!mysql_query($update)) die("$update aanvraag_overdracht" . mysql_error());

  $update = "update aanvraag_overdracht set naar_id = {$_GET['nieuw']}
             where naar_id = {$_GET['oud']} and (naar_genre = 'hulp' or naar_genre='orgpersoon')";
  if (!mysql_query($update)) die("$update aanvraag_overdracht" . mysql_error());

  $update = "update berichten set auteur_id = {$_GET['nieuw']}
             where auteur_id = {$_GET['oud']} and (auteur_genre = 'hulp' or auteur_genre='orgpersoon')";
  if (!mysql_query($update)) die("$update berichten" . mysql_error());

  $update = "update berichten_to set persoon = {$_GET['nieuw']}
             where persoon = {$_GET['oud']} and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update berichten_to" . mysql_error());

  $update = "update evaluatie set uitvoerder_id = {$_GET['nieuw']}
              where uitvoerder_id = {$_GET['oud']} and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update evaluatie" . mysql_error());

  $update = "update evaluatie_rechten set id = {$_GET['nieuw']}
              where id = {$_GET['oud']} and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update evaluatie_rechten" . mysql_error());

  $update = "update katz set hvl_id = {$_GET['nieuw']}
              where hvl_id = {$_GET['oud']}";
  if (!mysql_query($update)) die("$update katz" . mysql_error());

  $update = "update katz_aanvraag set hvl = {$_GET['nieuw']}
              where hvl = {$_GET['oud']}";
  if (!mysql_query($update)) die("$update katz" . mysql_error());

  $update = "update omb_registratie set melderhvl_id = {$_GET['nieuw']}
              where melderhvl_id = {$_GET['oud']}";
  if (!mysql_query($update)) die("$update omb_registratie" . mysql_error());

  $update = "update overleg set toegewezen_id = {$_GET['nieuw']}
              where toegewezen_id = {$_GET['oud']} and toegewezen_genre = 'hulp'";
  if (!mysql_query($update)) die("$update overleg" . mysql_error());

  $update = "update overleg_files_rechten set id = {$_GET['nieuw']}
              where id = {$_GET['oud']} and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update overleg_files_rechten" . mysql_error());

  $update = "update overleg_tp_plan set persoon = {$_GET['nieuw']}
              where persoon = {$_GET['oud']} and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update overleg_tp_plan" . mysql_error());

  $update = "update patient set toegewezen_id = {$_GET['nieuw']}
              where toegewezen_id = {$_GET['oud']} and toegewezen_genre = 'hulp'";
  if (!mysql_query($update)) die("$update patient" . mysql_error());

  $update = "update taakfiche_mensen set mens_id = {$_GET['nieuw']}
              where mens_id = {$_GET['oud']} and mens_type = 'hvl'";
  if (!mysql_query($update)) die("$update taakfiche_mensen" . mysql_error());


  $update = "delete from hulpverleners where id = {$_GET['oud']}";
  if (!mysql_query($update)) die("$update hulpverleners" . mysql_error());

  print("OK");
      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>