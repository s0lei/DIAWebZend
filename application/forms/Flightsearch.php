<?php

class Application_Form_Flightsearch extends Zend_Form {

    public function init() {
        $this->setName('arrivalflight');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $arrangeOrder = new Zend_Form_Element_Select('arrangeOrder');
        $arrangeOrder->setMultiOptions(array('airline' => 'Airline', 
                                        'flightNumber' => 'Flight Number',
                                        'cityState' => 'City & State', 
                                        'dateTime' => 'Date & Time', 
                                        'status' => 'Status'))
                ->setRequired(true)->addValidator('NotEmpty', true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $arrangeOrder, $submit));

        $this->clearDecorators();
        $this->addDecorator('FormElements')
                //->addDecorator('HtmlTag', array('tag' => '<ul>'))
                ->addDecorator('Form');

        $this->setElementDecorators(array(
            array('ViewHelper'),
            array('Errors'),
            array('Description'),
            array('Label', array('separator' => ' ')),
                //array('HtmlTag', array('tag' => 'li', 'class' => 'element-group')),
        ));

        // buttons do not need labels

        $submit->setDecorators(array(
            array('ViewHelper'),
            array('Description'),
                //array('HtmlTag', array('tag' => 'li', 'class' => 'submit-group')),
        ));
    }

}

