<?php

class Application_Form_Departureairlinecityform extends Zend_Form
{

    public function init()
    {
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
 
        
        
        $cityList = new Zend_Form_Element_Select('cityList');
        //$departureflightschedule = new Application_Model_DbTable_Departureflightschedule();
        $cityresult = $departureflightschedule->cityList();
        $cityoptions = array();
        //$cityoptions['Any Airlines'] = 'Any Airlines';
        foreach ($cityresult as $value) {
            $cityoptions[$value['CityState']] = $value['CityState'];
        }
        $cityList->setLabel('Departute to city')
                ->setRequired(true)->addValidator('NotEmpty', true);
        $cityList->setMultiOptions($cityoptions);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $airlineList, $cityList, $submit));

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

