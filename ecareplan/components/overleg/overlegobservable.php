<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author robindell
 */
interface ECP_OverlegObservable {
    public function attach(ECP_OverlegObserver $observer);
    public function detach(ECP_OverlegObserver $observer);
    
    public function notify($message);
}

?>
