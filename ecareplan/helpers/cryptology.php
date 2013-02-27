<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ECP_Cryptology extends ECP_Object{
     //secret sentence
    private static $secret = "ahorsecnbleadttwtrbutcannotbforcedtdrink";
     // blowfish  
    private static $algo = '$2a';
    // cost parameter  
    private static $cost = '$07$';
    
    public function __CONSTRUCT(){
        
    }
    /**
     * Generate a random integer (no leading 0)
     * @param int $length The length of the integer
     * @return string
     */
    public static function generateInteger($length){
        $int='';
        for($i=0; $i<$length; $i++){
            $int.=rand(0,9);
            if($i==0 && $int == 0){$int = ''; $i--;} //leading 0 must go away
        }
       return $int;
    }
    
    /**
     * Generates a key wih a hash and given id
     * @param int $tohash
     * @return hash
     */
    public static function generateHash($tohash){
        if($tohash){
            return self::hash($tohash.self::$secret);
        }
        return 0;
    }
    
    /**
     * Create unique salt for hashing passwords
     * @return salt
     */
    private static function unique_salt() {
        return substr(sha1(mt_rand()), 0, 22).sha1(date("H:i:s"));
    }

    /**
     * Create hashed password
     * @param string $password - the password the user submitted to store
     * @return hash
     */
    private static function hash($password) {

        return crypt($password, self::$algo.self::$cost.self::unique_salt().'$');
    }
}
?>
