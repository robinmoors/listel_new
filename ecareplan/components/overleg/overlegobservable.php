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
    public function getObservers();
    
    public function notify();
    public function setState($state);
    public function getState();
}

?>
