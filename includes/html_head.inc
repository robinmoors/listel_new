
<meta http-equiv="X-UA-Compatible" content="IE=8"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
<?php
$ie = 8;
if (strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 7")) {
  $ie = 7;
}
else if (strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 6")) {
  $ie = 6;
}
else if (strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 5")) {
  $ie = 5;
}


$url = $_SERVER['PHP_SELF'];
$speciaal = (strpos($url, "katz_invullen") > 0) || (strpos($url, "ingeven_evaluatie_instr") > 0);


if (($ie < 8) && !$speciaal) {
?>

<script type="text/javascript">
  alert("U gebruikt een oude browser, nl. Internet Explorer <?= $ie ?>.\nHet e-zorgplan ondersteunt deze browser niet.\nGelieve ofwel Firefox ofwel Internet Explorer 8 (of hoger) te gebruiken.\n\nIndien je al IE8 hebt, zorg er dan voor dat onder het menu \n'Extra' de optie 'Compatibiliteitsweergave' is uitgevinkt.");
</script>


<?php
die("Deze site werkt best in Firefox (gratis en open source op <a href='http://www.getfirefox.com/'>http://www.getfirefox.com</a>). <br/>Bij gebruik van Internet Explorer enkel in versie 8.<br/>Indien je al IE8 hebt, zorg er dan voor dat onder het menu 'Extra' de optie 'Compatibiliteitsweergave' is uitgevinkt.");
}
?>

<meta detected-browser="<?= $_SERVER['HTTP_USER_AGENT']  . " -- IE version = $ie ($speciaal)" ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>LISTEL vzw - <?php echo $paginanaam ?></title>

<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />

<link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />



<script type="text/javascript" src="../javascript/combo.js"></script>





<script type="text/javascript">



function createREQ() {

    try {

      req = new XMLHttpRequest(); // new XMLHttpRequest();  // firefox e.d.

    }

    catch (err1) { try {

      req = new ActiveXObject("Msxml2.XMLHTTP"); // sommige IE

    }

    catch (err2) { try {

      req = new ActiveXObject("Microsoft.XMLHTTP"); // meeste IE

    }

    catch (err3) {

      req = false;

    }}}

  return req;

}

</script>

