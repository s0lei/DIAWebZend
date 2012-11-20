<?php

class Application_Form_Departureairlineflightnumberform extends Zend_Form {

    public function init() {
        $this->setName('album');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $airlineList = new Zend_Form_Element_Select('airlineList');
        $departureflightschedule = new Application_Model_DbTable_Departureflightschedule();
        $result = $departureflightschedule->airlineList();
        $options = array();
        $options['Any Airlines'] = 'Any Airlines';
        foreach ($result as $value) {
            $options[$value['Airline']] = $value['Airline'];
        }
        $airlineList->setLabel('')
                ->setRequired(true)->addValidator('NotEmpty', true);
        $airlineList->setMultiOptions($options);

        $flightnumber = new Zend_Form_Element_Text('flightnumber');
        $flightnumber->setLabel('Departure flight number')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $airlineList, $flightnumber, $title, $submit));

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
            //array('HtmlTag', array('tag' => 'div', 'id' => 'timesubmit')),
        ));
    }

}

