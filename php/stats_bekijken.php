<?php

if ($_POST['beginjaar']<100) $_POST['beginjaar']="20".$_POST['beginjaar'];

if ($_POST['eindjaar']<100) $_POST['eindjaar']="20".$_POST['eindjaar'];

if ($_POST['sep']==",")

  $sep = ",";

else

  $sep = ";";

switch($_POST['stat']) {

  case "GDT_jaarverslag":

  case "aanwezigheden_nietvergoedbaar":

  case "zorgplan":

  case "zorgplan_oplijsting";

  //case "zorgplan_met_overleg":

  case "zorgplan_mutualiteit":

  case "overleg":

  case "overleg_hulpverleners":

  case "overleg_functies":

  case "overleg_contact_hulpverleners":

  case "overleg_mantelzorgers":

  case "overleg_contact_mantelzorgers":

  case "evaluatie":

  case "aanwezigheden":

  case "betalingen":

  case "betaling_TP":
  case "betaling_TP_per_project":

  case "TP":

    require("stats_{$_POST['stat']}.php");

    break;

  default:

    die("U hebt in de linkse kolom niks geselecteerd. Denk eraan: je moet zowel op zijn minst in de linkse kolom, en eventueel in de rechtse kolom een keuze maken.");

}



?>