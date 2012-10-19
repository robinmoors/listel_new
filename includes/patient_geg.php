<?php
if (isset($_POST['a_pat_nr'])) $_SESSION['pat_nr']=$_POST['a_pat_nr'];
if (isset($_POST['pat_nr'])) $_SESSION['pat_nr']=$_POST['pat_nr'];
$pat_geg=mysql_fetch_array(mysql_query("SELECT pat_nr,pat_id,pat_naam,pat_voornaam FROM patienten WHERE pat_nr=".$_SESSION['pat_nr']));
$_SESSION['pat_nr']=$pat_geg['pat_nr'];
$_SESSION['pat_id']=$pat_geg['pat_id'];
$_SESSION['pat_naam']=$pat_geg['pat_naam'];
$_SESSION['pat_voornaam']=$pat_geg['pat_voornaam'];
?>