<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author robindell
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");
interface ECP_OverlegObservable {
    public function attach(ECP_OverlegObserver $observer);
    public function detach(ECP_OverlegObserver $observer);
    public function getObservers();
    
    public function notify();
    public function setState($state);
    public function getState();
}

?>
