<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('arrivalupdatingajax', 'html')->initContext('html');

        $ajaxContext01 = $this->_helper->getHelper('AjaxContext');
        $ajaxContext01->addActionContext('arrivalupdatedajax', 'html')->initContext('html');
    }

    public function indexAction() {
        // action body
    }

    public function populatearrivaltableAction() {
        $arrivalTable = new Application_Model_DbTable_Arrivalflightschedule();
        $arrivalTable->populateArrivalTable();

        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
    }

    public function arrivalupdatingajaxAction() {
        // action body
    }

    public function arrivalupdatedajaxAction() {
        // action body
    }

    public function arrivalsearchAction() {
        $arrivalsearchform = new Application_Form_Flightsearch();
        $arrivalsearchform->setAction('/DIAWebZend/public/index/')
                ->setMethod('post');
        $arrivalsearchform->submit->setLabel('Go');
        $this->view->arrivalsearchform = $arrivalsearchform;


        $arrivalsearchform02 = new Application_Form_FlightSearch02();
        $arrivalsearchform02->submit->setLabel('Add');
        $this->view->arrivalsearchform02 = $arrivalsearchform02;
    }

}

