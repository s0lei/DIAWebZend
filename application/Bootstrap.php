<?php
require_once 'Zend/Loader/Autoloader.php';

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload(){
        
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('FlightData_');
        
        return $autoloader;
    }

}

