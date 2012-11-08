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
        $arrivalsearchform->setAction('/DIAWebZend/public/index/displayarrivalflight')
                ->setMethod('post');
        $arrivalsearchform->submit->setLabel('Go');
        $this->view->arrivalsearchform = $arrivalsearchform;


        $arrivalsearchform02 = new Application_Form_FlightSearch02();
        $arrivalsearchform02->submit->setLabel('Add');
        $this->view->arrivalsearchform02 = $arrivalsearchform02;
    }

    public function displayarrivalflightAction() {
        $arrivalsearchform = new Application_Form_Flightsearch();
        $selectedOption = "";
        $arrangeOrder = "";

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($arrivalsearchform->isValid($formData)) {
                $selectedOption = $arrivalsearchform->getValue('arrangeOrder');
            }
        } else {
        }
        
        if ($selectedOption=== "airline"){
            $arrangeOrder = "Airline";
        }
        else if ($selectedOption=== "flightNumber"){
            $arrangeOrder = "FlightNumber";
        }
        else if ($selectedOption=== "cityState"){
            $arrangeOrder = "cityState";
        }
        else if ($selectedOption=== "dateTime"){
            $arrangeOrder = "DateTime";
        }
        else if ($selectedOption=== "status"){
            $arrangeOrder = "Status";
        }
        

        $arrivalflightschedule = new Application_Model_DbTable_Arrivalflightschedule();
        $select = $arrivalflightschedule->select()
                //->where('Airline = ?', 'United Airlines')//;
                ->order($arrangeOrder);
        
        $this->view->arrivalflightschedule = $arrivalflightschedule->fetchall($select);
    }

}

