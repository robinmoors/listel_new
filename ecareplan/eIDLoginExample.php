<?php
include "includes/lightopenid/openid.php";

$openid = new LightOpenID('localhost');
//$openid->returnUrl is by default current url


//Step 1: verifcation with openid_mode
//true if the user has authenticated
if ($openid->mode) {
        echo $openid->validate() ? 'Logged in.' : 'Failed';
                
        //TO DO: ophalen object in DB
        //manier van info ophalen
        $userinfo = $openid->getAttributes();
        $firstName = $userinfo['namePerson/first'];
        $lastName = $userinfo['namePerson/last'];
        $surName = $userinfo['namePerson'];
        $gender = $userinfo['person/gender'];
        $postalcode= $userinfo['contact/postalCode/home'];
        $address = $userinfo['contact/postalAddress/home'];
        $city = $userinfo['contact/city/home'];
        $nationality = $userinfo['eid/nationality'];
        $pob = $userinfo['eid/pob'];
        $birthdate= $userinfo['birthDate'];
        $cardNumber= $userinfo['eid/card-number'];
        $cardValidityBegin = $userinfo['eid/card-validity/begin'];
        $cardValidityEnd = $userinfo['eid/card-validity/end'];
        
        include 'index.php';
        
} else {
    //Step 2: Authentication, with requirements
        $openid->identity = 'https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident';
        $openid->required = array('namePerson/first', 'namePerson/last',
                'namePerson', 'person/gender', 'contact/postalCode/home',
                'contact/postalAddress/home', 'contact/city/home', 'eid/nationality',
                'eid/pob', 'birthDate', 'eid/card-number', 'eid/card-validity/begin',
                'eid/card-validity/end');
        
        //Alle variabele van de eID staan al bij required
        //$openid->optional = array('');
        header('Location: ' . $openid->authUrl());
}
?>