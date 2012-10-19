<?php


//---------------------------------------------

// Sluit Dbconnectie

//---------------------------------------------

if ($connectieTeller == 1) {

  mysql_close($link);

}

$connectieTeller--;

?>

