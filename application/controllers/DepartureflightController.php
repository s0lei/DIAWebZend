<?php

class DepartureflightController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $departuresearchform = new Application_Form_Flightsearch();
        $departuresearchform->setAction('/DIAWebZend/public/index/displayarrivalflight')
                ->setMethod('post');
        $departuresearchform->arrangeOrder->setLabel('1. Show all departure flight in order of');
        $departuresearchform->submit->setLabel('Go');
        $this->view->departuresearchform = $departuresearchform;

        $departuresearchform02 = new Application_Form_FlightSearch02();
        $departuresearchform02->setAction('/DIAWebZend/public/index/displayarrivaltimeflight')
                ->setMethod('post');
        $departuresearchform02->submit->setLabel('Go');
        $this->view->departuresearchform02 = $departuresearchform02;
    }


}

