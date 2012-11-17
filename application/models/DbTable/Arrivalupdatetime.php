<?php

class Application_Model_DbTable_Arrivalupdatetime extends Zend_Db_Table_Abstract {

    protected $_name = 'arrivalupdatetime';

    public function updatearrivaltime() {
        //$this->delete();
        $id = 1;

        $currentTime = new Zend_Db_Expr('NOW()');
        $data = array('id' => $id,
            'updatedtime' => $currentTime,);
        //$this->insert($data);
        $this->update($data, 'id = '. (int)$id);
    }
    
    public function updatedeparturetime() {
        //$this->delete();
        $id = 2;

        $currentTime = new Zend_Db_Expr('NOW()');
        $data = array('id' => $id,
            'updatedtime' => $currentTime,);
        //$this->insert($data);
        $this->update($data, 'id = '. (int)$id);
    }

    public function updatearrivaltimeobtain() {
        $id = 1;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function updatedeparturetimeobtain() {
        $id = 2;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
}

