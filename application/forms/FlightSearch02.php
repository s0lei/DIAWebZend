<?php

class Application_Form_FlightSearch02 extends Zend_Form {

    public function init() {
        $this->setName('album');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $arrangeOrder = new Zend_Form_Element_Select('arrangeOrder');
        $arrivalflightschedule = new Application_Model_DbTable_Arrivalflightschedule();
        $result = $arrivalflightschedule->airlineList();
        $options = array();
        $options['Any Airlines'] = 'Any Airlines';
        foreach ($result as $value) {
            $options[$value['Airline']] = $value['Airline'];
        }
        $arrangeOrder->setLabel('1. Show all arrival flight in order of')
                ->setRequired(true)->addValidator('NotEmpty', true);
        $arrangeOrder->setMultiOptions($options);

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $arrangeOrder, $title, $submit));

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

