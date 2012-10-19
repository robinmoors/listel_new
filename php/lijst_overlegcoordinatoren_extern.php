<?php
  $pdfdoc = file_get_contents("/var/www/html/Overzicht_OC_TGZ.pdf");

  header("Content-type: application/pdf; charset=utf-8");

  header("Content-Length: ".strlen(ltrim($pdfdoc)));

  $fileName = 'Overzicht_OC_TGZ.pdf';

  header("Content-Disposition: inline; filename=".$fileName);


  print($pdfdoc);

?>