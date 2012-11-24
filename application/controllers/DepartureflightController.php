<?php

class DepartureflightController extends Zend_Controller_Action
{

    public function init()
    {
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('departureupdatingajax', 'html')->initContext('html');

        $ajaxContext01 = $this->_helper->getHelper('AjaxContext');
        $ajaxContext01->addActionContext('departureupdatedajax', 'html')->initContext('html');

        $ajaxContext02 = $this->_helper->getHelper('AjaxContext');
        $ajaxContext02->addActionContext('departuretimeupdateajax', 'html')->initContext('html');
        
        $ajaxContext03 = $this->_helper->getHelper('AjaxContext');
        $ajaxContext03->addActionContext('displaydepartureairlineflightnumberflight', 'html')->initContext('html');
        
        $ajaxContext04 = $this->_helper->getHelper('AjaxContext');
        $ajaxContext04->addActionContext('displaydepartureairlineandcityflight', 'html')->initContext('html');
    }

    public function indexAction()
    {
        $departuresearchform = new Application_Form_Flightsearch();
        $departuresearchform->setAction('/DIAWebZend/public/departureflight/displaydepartureflight')
                ->setMethod('post');
        $departuresearchform->arrangeOrder->setLabel('1. Show all departure flight in order of');
        $departuresearchform->submit->setLabel('Go');
        $this->view->departuresearchform = $departuresearchform;

        $departuresearchtimeform = new Application_Form_Departureflightsearchtime();
        $departuresearchtimeform->setAction('/DIAWebZend/public/departureflight/displaydeparturetimeflight')
                ->setMethod('post');
        $departuresearchtimeform->submit->setLabel('Go');
        $this->view->departuresearchtimeform = $departuresearchtimeform;
    }

    public function populatedeparturetableAction()
    {
        $departureTable = new Application_Model_DbTable_departureflightschedule();
        $departureTable->populateDepartureTable();

        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
    }

    public function departureupdatingajaxAction()
    {
        // action body
    }

    public function departureupdatedajaxAction()
    {
        // action body
    }

    public function displaydepartureflightAction()
    {
        $departuresearchform = new Application_Form_Flightsearch();
        $selectedOption = "";
        $arrangeOrder = "";

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($departuresearchform->isValid($formData)) {
                $selectedOption = $departuresearchform->getValue('arrangeOrder');
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

        $departureflightschedule = new Application_Model_DbTable_Departureflightschedule();
        $select = $departureflightschedule->select()
                //->where('Airline = ?', 'United Airlines')//;
                ->order($arrangeOrder);

        $this->view->departureflightschedule = $departureflightschedule->fetchall($select);
    }

    public function displaydeparturetimeflightAction()
    {
        $departuresearchtimeform = new Application_Form_Departureflightsearchtime();
        $airline = "";

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($departuresearchtimeform->isValid($formData)) {
                $airline = $departuresearchtimeform->getValue('airlineList');
                $startTime = $departuresearchtimeform->getValue('startTime');
                $ampmStart = $departuresearchtimeform->getValue('ampmStart');
                $endTime = $departuresearchtimeform->getValue('endTime');
                $ampmEnd = $departuresearchtimeform->getValue('ampmEnd');
            }
        } else {
            
        }

        $startTime = intval($startTime);
        if ($ampmStart === 'pm')
            $startTime = $startTime + 12;
        $endTime = intval($endTime);
        if ($ampmEnd === 'pm')
            $$endTime = $endTime + 12;

        $departureflightschedule = new Application_Model_DbTable_Departureflightschedule();
        if ($airline === 'Any Airlines') {
            $select = $departureflightschedule->select()
                    //->where('Airline = ?', 'United Airlines');
                    ->where('Time >= ?', $startTime)
                    ->where('Time < ?', $endTime)
                    ->order('Airline');
        } else {
            $select = $departureflightschedule->select()
                    ->where('Airline = ?', $airline)
                    ->where('Time >= ?', $startTime)
                    ->where('Time < ?', $endTime)
                    ->order('Time');
        }

        $this->view->departureflightschedule = $departureflightschedule->fetchall($select);
    }

    public function departuretimeupdateajaxAction()
    {
        $departureupdatetime = new Application_Model_DbTable_Arrivalupdatetime();
        $departureupdatetime->updatedeparturetime();
    }

    public function airlineandtimeAction()
    {
        $departuresearchtimeform = new Application_Form_Departureflightsearchtime();
        $departuresearchtimeform->setAction('/DIAWebZend/public/departureflight/displaydeparturetimeflight')
                ->setMethod('post');
        $departuresearchtimeform->submit->setLabel('Go');
        $this->view->departuresearchtimeform = $departuresearchtimeform;
    }

    public function airlineandcityAction()
    {
        //$departureairlinecityform = new Application_Form_Departureairlinecityform();
        //$departureairlinecityform->setAction('/DIAWebZend/public/departureflight/displaydepartureairlineandcityflight')
        //        ->setMethod('post');
        //$departureairlinecityform->submit->setLabel('Go');
        //$this->view->departureairlinecityform = $departureairlinecityform;
    }

    public function displaydepartureairlineandcityflightAction()
    {
        $airline = $_POST['airline'];
        $city = $_POST['city'];

        $departureflightschedule = new Application_Model_DbTable_Departureflightschedule();
         if ($airline === 'Any Airlines') {
            $select = $departureflightschedule->select()
                    ->where('CityState = ?', $city)
                    ->order('Airline');
        } else {
            $select = $departureflightschedule->select()
                    ->where('Airline = ?', $airline)
                    ->where('CityState = ?', $city)
                    ->order('Airline');
        } 
        
        $this->view->departureflightschedule = $departureflightschedule->fetchall($select);
    }

    public function airlineflightnumberAction()
    {
        
    }

    public function displaydepartureairlineflightnumberflightAction()
    {        
        $airline = $_POST['airline'];
        $flight = $_POST['flight'];

        $departureflightschedule = new Application_Model_DbTable_Departureflightschedule();
         if ($airline === 'Any Airlines') {
            $select = $departureflightschedule->select()
                    ->where('FlightNumber = ?', $flight)
                    ->order('Airline');
        } else {
            $select = $departureflightschedule->select()
                    ->where('Airline = ?', $airline)
                    ->where('FlightNumber = ?', $flight)
                    ->order('Airline');
        } 
        
        $this->view->departureflightschedule = $departureflightschedule->fetchall($select);
    }

}







