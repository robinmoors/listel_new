<?
// functies yoeri
// include in patientenoverzicht en print - voor het weergeven van de verantwoordelijken

function getVerantwoordelijken($taakficheID) {
    $mensen = array();
	    
    //
    // Patienten
    // --------------
    
       $res = mysql_query("SELECT DISTINCT code as pat_code,
                                           naam as pat_naam,
                                           voornaam as pat_voornaam,
                                           mens_id
						FROM patient INNER JOIN taakfiche_mensen
						ON (mens_id = patient.id AND mens_type = 'pat' AND taakfiche_id = '" . $taakficheID . "' ) WHERE pat_code = '" . $_SESSION['pat_code'] . "' ");
    
    
    while ($pat = mysql_fetch_object($res)) {
    
        if ($pat->mens_id)  {
            $mensen[] = '<h4>Pati&euml;nt</h4>';
            $mensen[] = '<ul class="list">';
            $mensen[] = '<li>' . $pat->pat_naam . ' ' . $pat->pat_voornaam . '</li>';
            $mensen[] = '</ul>';        
    		}
    }
    
    
    
    //
    // Hulpverleners
    // --------------
    if (!$overlegType) {
    $res = mysql_query("SELECT DISTINCT hvl_id, hvl_naam, hvl_voornaam,mens_id
                        FROM betroklijsthvl,hulpverleners INNER JOIN taakfiche_mensen 
                        ON (mens_id = hvl_id AND mens_type = 'hvl' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "'  ) 
                        WHERE betrokhvl_pat_nr = '" . $_SESSION['pat_nr'] . "' AND hvl_id = betrokhvl_hvl_id  AND betrokhvl_temp = '1' ");
    } else {
        $res = mysql_query("SELECT DISTINCT hvl_id, hvl_naam, hvl_voornaam,mens_id
                        FROM aanweziglijsthvl,hulpverleners INNER JOIN taakfiche_mensen 
                        ON (mens_id = hvl_id AND mens_type = 'hvl' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "'  ) WHERE aanwhvl_overleg_id = '" . $overlegID . "' AND hvl_id = aanwhvl_hvl_id  ");
   }
    
    if (mysql_num_rows($res)) {
        $mensen[] = '<h4>Hulpverleners</h4>';
        $mensen[] = '<ul class="list">';
    while ($hvl = mysql_fetch_object($res)) {
    
        if (!is_null($hvl->mens_id)) 
            $mensen[] = '<li>' . $hvl->hvl_naam . ' ' . $hvl->hvl_voornaam . '</li>';
    }
        $mensen[] = '</ul>';
    }
    
    // -----------------
    // Mantelzorgers
    // -----------------
    if (!$overlegType) {
        $res = mysql_query("SELECT DISTINCT mzorg_id, mzorg_naam, mzorg_voornaam,mens_id
                        FROM betroklijstmz,mantelzorgers INNER JOIN taakfiche_mensen 
                        ON (mens_id = mzorg_id AND mens_type = 'mz' AND taak = '" . $taak . "'  AND taakfiche_id = '" . $taakficheID . "' ) WHERE betrokmz_pat_nr = '" . $_SESSION['pat_nr'] . "' AND mzorg_id = betrokmz_mz_id AND betrokmz_temp = '1'"); } else {
            $res = mysql_query("SELECT DISTINCT mzorg_id, mzorg_naam, mzorg_voornaam,mens_id
                        FROM aanweziglijstmz,mantelzorgers INNER JOIN taakfiche_mensen 
                        ON (mens_id = mzorg_id AND mens_type = 'mz' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "') WHERE aanwmz_overleg_id = '" . $overlegID . "' AND mzorg_id = aanwmz_mz_id");       
    }
    
    if (mysql_num_rows($res)) {
        $mensen[] = '<h4>Mantelzorgers</h4>';
        $mensen[] = '<ul class="list">';
    while ($mz = mysql_fetch_object($res)) {
    
        if (!is_null($mz->mens_id)) 
            $mensen[] = '<li>' .$mz->mzorg_naam . ' ' . $mz->mzorg_voornaam . '</li>';
    }
        $mensen[] = '</ul>';
    }
    
    // -----------------
    // Overlegcoordinatoren
    // -----------------
    if (!$overlegType) {
        $res = mysql_query("SELECT DISTINCT overlcrd_id, overlcrd_naam, overlcrd_voornaam,mens_id
                        FROM betroklijstoc,logins INNER JOIN taakfiche_mensen
                        ON (mens_id = overlcrd_id AND mens_type = 'oc' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "'  ) 
                        WHERE profiel = 'OC' AND betrokoc_pat_nr = '" . $_SESSION['pat_nr'] . "' AND overlcrd_id = betrokoc_oc_id and logins.actief=1");
    } else {
        $res = mysql_query("SELECT DISTINCT overlcrd_id, overlcrd_naam, overlcrd_voornaam,mens_id
                        FROM aanweziglijstoc,logins INNER JOIN taakfiche_mensen
                        ON (mens_id = overlcrd_id AND mens_type = 'oc' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "') 
                        WHERE profiel = 'OC' AND aanwoc_overleg_id = '" . $overlegID . "' AND overlcrd_id =aanwoc_oc_id and logins.actief=1 ");
    }
    
    if (mysql_num_rows($res))  {                 
        $mensen[] = '<h4>Overlegco&ouml;rdinatoren</h4>';
        $mensen[] = '<ul class="list">';
    while ($oc = mysql_fetch_object($res)) {
        if (!is_null($oc->mens_id)) 
            $mensen[] = '<li>' . $oc->overlcrd_naam . ' ' . $oc->overlcrd_voornaam . '</li>';
    }
        $mensen[] = '</ul>';
        
    }
    
    $string = '';
    
    if (count($mensen)) {
        $string = implode("\n",$titel);
        $string .= implode("\n",$mensen);  
    }
    
    return $string;
    
    }
    function getTaakFiche($overlegID) {
    
     $info = array();
    
     // haal teksten op
     $res = mysql_query("SELECT taakf_verzorging_text as verzorging,
                            taakf_mobiliteit_text as mobiliteit,
                            taakf_huishouden_text as huishouden, 
                            taakf_sociaal_text as sociaal, 
                            taakf_financien_text as financien, 
                            taakf_diverse_text as diverse ,
							taakf_id as id
                            FROM taakfiche WHERE taakf_overleg_id = '" . $overlegID . "'");
     $obj = mysql_fetch_object($res);
     
     return $obj;
    }
?>