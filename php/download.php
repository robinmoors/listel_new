<?php
	session_start();
	// ----------------------
	/*	 anti-leech systeem : gebruiker moet ingelogd zijn om de files in de download map te downloaden */
	//----------------------- 
	   
	if (!IsSet($_SESSION["toegang"]) ||($_SESSION["toegang"]!="toegestaan"))  {
		echo 'Error - geen toegang';
		exit();
	}
	
	$file = $_GET['file'];
	
	if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/_download/' . $file)) {
		echo 'Error - bestand niet gevonden';
		exit();
	}
	
	
	//----------------------------------------------------------
	/* Maak Dbconnectie */ include('../includes/dbconnect.inc');
	//----------------------------------------------------------
	$result = mysql_query("SELECT alias FROM overleg_files WHERE filename = '" . $file . "'");
	$newfile = mysql_fetch_object($result);
	
	//---------------------------------------------------------
	/* Sluit Dbconnectie */ include('../includes/dbclose.inc');
	//---------------------------------------------------------
	   
    header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");

	if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")) {
	   header('Content-Disposition: attachment; filename="'.basename($newfile->alias) . '"'); // For IE  
	} else { 
	   header("Content-type: application/octet-stream"); 
	   header('Content-Disposition: attachment; filename="'.basename($newfile->alias) . '"'); // For Other browsers 
	}
	
	readfile($_SERVER['DOCUMENT_ROOT'] . '/_download/' . $file) or die ("File not found");
	
	exit;
?>