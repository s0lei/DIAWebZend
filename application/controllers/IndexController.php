<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
        $arrivalTable = new Application_Model_DbTable_Arrivalflightschedule();
        $arrivalTable->populateArrivalTable();
    }

    public function populatearrivaltableAction() {
        $arrivalTable = new Application_Model_DbTable_Arrivalflightschedule();
        $arrivalTable->populateArrivalTable();
    }
}

