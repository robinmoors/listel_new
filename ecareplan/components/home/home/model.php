<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_Home_Model {
    
    protected $app;
    
    
    public function __CONSTRUCT(){
        $this->app = ECPFactory::getApp();
    }
    
    public function showWelcome(){
        $this->app->setTemplate("listel");
        $content = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis enim orci, at gravida tellus. Nam ac lectus et mi vehicula accumsan. In et leo erat. Nulla eu turpis id mauris consequat ultricies in ac nunc. Suspendisse venenatis turpis eget lectus accumsan ut blandit nibh cursus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse eu velit et libero lobortis tristique.</p>
<p>Aliquam ut neque sed augue lacinia suscipit. Cras at lorem id elit lobortis dignissim in quis mi. Donec lacinia, lorem interdum bibendum posuere, orci turpis malesuada mauris, sit amet eleifend ipsum ipsum id erat. Mauris sit amet tortor non nunc laoreet facilisis. Vestibulum eget neque justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in mollis justo. Aenean at erat eu justo aliquet egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
<p>Nulla facilisi. Nulla et nisi a odio scelerisque fermentum in nec enim. Vestibulum purus orci, ultrices nec ullamcorper at, adipiscing vitae nisi. Sed ac urna a nibh faucibus aliquet sed a nisl. Vivamus tincidunt enim vitae tortor tempor commodo. Suspendisse eget tellus et nunc iaculis accumsan a eget quam. Quisque mollis aliquet purus, non consequat nibh tincidunt ut. In ac odio ac turpis cursus interdum ultrices sed erat. Cras bibendum vehicula mollis.</p>
<p>Donec vel enim justo, quis imperdiet purus. Donec sed leo risus. Sed felis quam, commodo iaculis vestibulum consequat, tempor ut est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque vehicula magna vel erat tincidunt faucibus mollis mi tincidunt. Vivamus enim massa, pulvinar sed tempus id, hendrerit at tortor. Pellentesque venenatis fermentum arcu, sit amet lacinia erat vulputate non. Suspendisse tristique accumsan tincidunt. Sed porttitor sodales massa, ac facilisis nisl pellentesque at. Maecenas ac felis leo.</p>
<p>Nulla molestie, nisl vel scelerisque aliquet, eros nulla scelerisque elit, vel eleifend ipsum justo a libero. Duis libero sem, tempus vel ullamcorper at, ullamcorper eget dui. Vivamus commodo, lacus at adipiscing egestas, urna massa ultricies nisl, nec rutrum dui felis eu metus. Nulla facilisi. Mauris vehicula, ipsum eget ornare interdum, libero turpis malesuada erat, et tempus ante urna id orci. Integer vulputate lectus eu ligula sodales et euismod risus placerat. Aliquam vel luctus lectus. Morbi viverra lacus ut dui luctus et fringilla orci tincidunt. Integer eleifend laoreet pharetra. Aliquam pulvinar dolor non est vehicula ac pharetra eros faucibus. Mauris urna dolor, posuere id ultricies ut, hendrerit et diam. Pellentesque semper quam at massa commodo at dapibus neque sodales.</p>";
    
        $this->app->setTemplateData(array("content" => $content,"content-title" => "Lorem Ipsum","content-sub-title" => "Dolor Sit Amet","title"=>"Ecareplan Home"));
    }
}

?>