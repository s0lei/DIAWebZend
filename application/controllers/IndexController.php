<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
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
        $arrivalsearchform->arrangeOrder->setLabel('1. Show all arrival flight in order of');
        $arrivalsearchform->submit->setLabel('Go');
        $this->view->arrivalsearchform = $arrivalsearchform;


        $arrivalsearchform02 = new Application_Form_FlightSearch02();
        $arrivalsearchform02->setAction('/DIAWebZend/public/index/displayarrivaltimeflight')
                ->setMethod('post');
        $arrivalsearchform02->submit->setLabel('Go');
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

        if ($selectedOption === "airline") {
            $arrangeOrder = "Airline";
        } else if ($selectedOption === "flightNumber") {
            $arrangeOrder = "FlightNumber";
        } else if ($selectedOption === "cityState") {
            $arrangeOrder = "cityState";
        } else if ($selectedOption === "dateTime") {
            $arrangeOrder = "DateTime";
        } else if ($selectedOption === "status") {
            $arrangeOrder = "Status";
        }

        $arrivalflightschedule = new Application_Model_DbTable_Arrivalflightschedule();
        $select = $arrivalflightschedule->select()
                //->where('Airline = ?', 'United Airlines')//;
                ->order($arrangeOrder);

        $this->view->arrivalflightschedule = $arrivalflightschedule->fetchall($select);
    }

    public function displayarrivaltimeflightAction() {
        $arrivalsearchtimeform = new Application_Form_FlightSearch02();
        $airline = "";

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($arrivalsearchtimeform->isValid($formData)) {
                $airline = $arrivalsearchtimeform->getValue('airlineList');
                $startTime = $arrivalsearchtimeform->getValue('startTime');
                $ampmStart = $arrivalsearchtimeform->getValue('ampmStart');
                $endTime = $arrivalsearchtimeform->getValue('endTime');
                $ampmEnd = $arrivalsearchtimeform->getValue('ampmEnd');
            }
        } else {
            
        }

        $startTime = intval($startTime);
        if ($ampmStart === 'pm')
            $startTime = $startTime + 12;
        $endTime = intval($endTime);
        if ($ampmEnd === 'pm')
            $$endTime = $endTime + 12;

        $arrivalflightschedule = new Application_Model_DbTable_Arrivalflightschedule();
        if ($airline === 'Any Airlines') {
            $select = $arrivalflightschedule->select()
                    //->where('Airline = ?', 'United Airlines');
                    ->where('Time >= ?', $startTime)
                    ->where('Time < ?', $endTime)
                    ->order('Airline');
        } else {
            $select = $arrivalflightschedule->select()
                    ->where('Airline = ?', $airline)
                    ->where('Time >= ?', $startTime)
                    ->where('Time < ?', $endTime)
                    ->order('Time');
        }

        $this->view->arrivalflightschedule = $arrivalflightschedule->fetchall($select);
    }

}

