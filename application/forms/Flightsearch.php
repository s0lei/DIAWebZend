<?php

class Application_Form_Flightsearch extends Zend_Form {

    public function init() {
        $this->setName('album');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $arrangeOrder = new Zend_Form_Element_Select('arrangeOrder');
        $arrangeOrder->setLabel('Order')
                ->setMultiOptions(array('airline' => 'Airline', 
                                        'flightNumber' => 'Flight Number',
                                        'cityState' => 'City & State', 
                                        'dateTime' => 'Date & Time', 
                                        'status' => 'Status'))
                ->setRequired(true)->addValidator('NotEmpty', true);


        $artist = new Zend_Form_Element_Text('artist');
        $artist->setLabel('Artist')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $arrangeOrder, $artist, $title, $submit));

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

        $artist->setDecorators(array(
            array('ViewHelper'),
            array('Errors'),
            array('Description'),
            array('Label', array('separator' => ' ')),
                //array('HtmlTag', array('tag' => 'li', 'class' => 'leis')),
        ));

        // buttons do not need labels

        $submit->setDecorators(array(
            array('ViewHelper'),
            array('Description'),
                //array('HtmlTag', array('tag' => 'li', 'class' => 'submit-group')),
        ));
    }

}

