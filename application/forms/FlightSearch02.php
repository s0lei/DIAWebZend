<?php

class Application_Form_FlightSearch02 extends Zend_Form {

    public function init() {
        $this->setName('album');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $airlineList = new Zend_Form_Element_Select('airlineList');
        $arrivalflightschedule = new Application_Model_DbTable_Arrivalflightschedule();
        $result = $arrivalflightschedule->airlineList();
        $options = array();
        $options['Any Airlines'] = 'Any Airlines';
        foreach ($result as $value) {
            $options[$value['Airline']] = $value['Airline'];
        }
        $airlineList->setLabel('')
                ->setRequired(true)->addValidator('NotEmpty', true);
        $airlineList->setMultiOptions($options);

        $startTime = new Zend_Form_Element_Select('startTime');
        $startTime->setLabel('From')
                ->setMultiOptions(array('0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12'))
                ->setRequired(true)->addValidator('NotEmpty', true);
        
        $ampmStart = new Zend_Form_Element_Select('ampmStart');
        $ampmStart->setLabel('')
                ->setMultiOptions(array('am' => 'am',
                    'pm' => 'pm'))
                ->setRequired(true)->addValidator('NotEmpty', true);
        
        $endTime = new Zend_Form_Element_Select('endTime');
        $endTime->setLabel('To')
                ->setMultiOptions(array('0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12'))
                ->setRequired(true)->addValidator('NotEmpty', true);
        
        $ampmEnd = new Zend_Form_Element_Select('ampmEnd');
        $ampmEnd->setLabel('')
                ->setMultiOptions(array('am' => 'am',
                    'pm' => 'pm'))
                ->setRequired(true)->addValidator('NotEmpty', true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $airlineList, $startTime,$ampmStart, $endTime, $ampmEnd, $submit));

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

