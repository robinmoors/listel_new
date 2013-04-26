<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/Sit.class.php';
require_once '../database/Patient.class.php';
require_once '../database/Gemeente.class.php';
require_once '../database/Logins.class.php';
require_once '../database/Overlegbasis.class.php';

require_once '../database/util/DSC.class.php';

/*
 * database connectie
 */
try {
    $db = new PDO('mysql:host=localhost;dbname=listel5', 'root');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


$overleg = new Overlegbasis();
$overleg->assignDefaultValues();
$overleg->setPatientCode('06/HA-07-331104-O') ->setLocatie('Tongeren') ->setKeuzeVergoeding(1);
//$overleg->insertIntoDatabase($db);

$pat = $overleg->fetchPatient($db);
foreach ($pat as $p) {
		// @var $p Patient
    echo  $p->getNaam() . "\t-\t" . $p->getVoornaam() . "\n";
}
/*
 * example to use SIT.class.php
 */

$sit=  Sit::findById($db, '3');
echo $sit->getNaam();

$newSit = new Sit();
$newSit->setNaam('Gent')
        ->setNr(50)
        ->setId(-1);
$newSit->insertIntoDatabase($db);



$gem = new Gemeente();
$gem->setNaam('Tongeren');
$gems = Gemeente::findByExample($db, $gem);
listGem($gems);


$sort=array(
    new DSC(Patient::FIELD_NAAM, DSC::ASC),
    new DSC(Patient::FIELD_VOORNAAM, DSC::ASC)
);

/*
$example = new Patient();
$example->setSex(0);
$patientList = Patient::findByExample($db, $example, true, $sort);
listPatients($patientList);

function listPatients($patients) {
	foreach ($patients as $p) {
		// @var $p Patient
		echo  $p->getNaam() . "\t-\t" . $p->getVoornaam() . "\n";
	}
}

*/

/*
function listGem($gems){
    foreach ($gems as $g) {
		// @var $p Gemeente
		echo  $g->getNaam() . "\t-\t" . $g->getTaal() . "\n";
	}

}

*/
/*
$log = new Logins();
$log->setVoornaam('Hilde');
$logs = Logins::findByExample($db, $log);
foreach ($logs as $l) {
    echo $l->getNaam();
}
    
*/

?>
