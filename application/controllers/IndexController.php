<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('arrivalupdatingajax', 'html')->initContext('html');

        $ajaxContext01 = $this->_helper->getHelper('AjaxContext');
        $ajaxContext01->addActionContext('arrivalupdatedajax', 'html')->initContext('html');

        $ajaxContext02 = $this->_helper->getHelper('AjaxContext');
        $ajaxContext02->addActionContext('arrivaltimeupdateajax', 'html')->initContext('html');
        
        $ajaxContext03 = $this->_helper->getHelper('AjaxContext');
        $ajaxContext03->addActionContext('displayarrivaltimeflight', 'html')->initContext('html');
        
        $ajaxContext04 = $this->_helper->getHelper('AjaxContext');
        $ajaxContext04->addActionContext('displayarrivalcityflight', 'html')->initContext('html');
        
        $ajaxContext05 = $this->_helper->getHelper('AjaxContext');
        $ajaxContext05->addActionContext('displayarrivalflightnumberflight', 'html')->initContext('html');
    }

    public function indexAction()
    {
        // action body
    }

    public function populatearrivaltableAction()
    {
        $arrivalTable = new Application_Model_DbTable_Arrivalflightschedule();        
        $arrivalTable->populateArrivalTable();

        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
    }

    public function arrivalupdatingajaxAction()
    {
        // action body
    }

    public function arrivalupdatedajaxAction()
    {
        // action body
    }

    public function arrivalsearchAction()
    {
        $arrivalsearchform = new Application_Form_Flightsearch();
        $arrivalsearchform->setAction('/DIAWebZend_Afternoon/public/index/displayarrivalflight')
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

    public function displayarrivalflightAction()
    {
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
        $this->view->arrangeOrder = $arrangeOrder;
    }

    public function displayarrivaltimeflightAction()
    {
         $airline = $_POST['airline'];
        $starthour = $_POST['starthour'];
        $startampm = $_POST['startampm'];
        $endhour = $_POST['endhour'];
        $endampm = $_POST['endampm'];

        if ($startampm === "pm")
            $starthour = $starthour + 12;
        if ($endampm === "pm")
            $endhour = $endhour + 12;
        
        $arrivalflightschedule = new Application_Model_DbTable_Arrivalflightschedule();
        if ($airline === 'Any Airlines') {
            $select = $arrivalflightschedule->select()
                    ->where('Time >= ?', $starthour)
                    ->where('Time <= ?', $endhour)
                    ->order('Time');
        } else {
            $select = $arrivalflightschedule->select()
                    ->where('Airline = ?', $airline)
                    ->where('Time >= ?', $starthour)
                    ->where('Time < ?', $endhour)
                    ->order('Time');
        }

        $this->view->arrivalflightschedule = $arrivalflightschedule->fetchall($select);
    }

    public function arrivaltimeupdateajaxAction()
    {
        $arrivalupdatetime = new Application_Model_DbTable_Arrivalupdatetime();
        $arrivalupdatetime->updatearrivaltime();
    }

    public function arrivaltimeflightAction()
    {
        // action body
    }

    public function arrivalcityflightAction()
    {
        // action body
    }

    public function displayarrivalcityflightAction()
    {
        $airline = $_POST['arrivalairline'];
        $city = $_POST['arrivalcity'];

        $arrivalflightschedule = new Application_Model_DbTable_Arrivalflightschedule();
         if ($airline === 'Any Airlines') {
            $select = $arrivalflightschedule->select()
                    ->where('CityState = ?', $city)
                    ->order('Airline');
        } else {
            $select = $arrivalflightschedule->select()
                    ->where('Airline = ?', $airline)
                    ->where('CityState = ?', $city)
                    ->order('Airline');
        } 
        
        $this->view->arrivalflightschedule = $arrivalflightschedule->fetchall($select);
    }

    public function arrivalflightnumberflightAction()
    {
        // action body
    }

    public function displayarrivalflightnumberflightAction()
    {
        $airline = $_POST['arrivalairline'];
        $flightnumber= $_POST['arrivalflightnumber'];

        $arrivalflightschedule = new Application_Model_DbTable_Arrivalflightschedule();
         if ($airline === 'Any Airlines') {
            $select = $arrivalflightschedule->select()
                    ->where('FlightNumber = ?', $flightnumber)
                    ->order('Airline');
        } else {
            $select = $arrivalflightschedule->select()
                    ->where('Airline = ?', $airline)
                    ->where('FlightNumber = ?', $flightnumber)
                    ->order('Airline');
        } 
        
        $this->view->arrivalflightschedule = $arrivalflightschedule->fetchrow($select);
    }

    public function aboutAction()
    {
        // action body
    }

    public function commentAction()
    {
        // action body
    }

    public function sentcommentAction()
    {
        $commentDB = new Application_Model_DbTable_Comment();
        $comment = $_POST["comment"];
        $commentDB->insertCommentTable($comment);
        
        $this->view->comment = $comment;
    }


}



















