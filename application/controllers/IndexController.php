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
        
        return $arrivalsearchform;
    }

    public function displayarrivalflightAction() {
        $arrivalsearchform = $this->arrivalsearchAction();
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($arrivalsearchform->isValid($formData)) {
                //$id = (int) $form->getValue('id');
                $arrangeOrder = $arrivalsearchform->getValue('arrangeOrder');
                echo $arrangeOrder;
                //$title = $form->getValue('title');
                //$albums = new Application_Model_DbTable_Albums();
                //$albums->updateAlbum($id, $artist, $title);
                //$this->_helper->redirector('index');
            //} else {
                //$form->populate($formData);
            }
        } else {
            //$id = $this->_getParam('id', 0);
            //if ($id > 0) {
            //    $albums = new Application_Model_DbTable_Albums();
            //    $form->populate($albums->getAlbum($id));
            //}
        }
    }

}

