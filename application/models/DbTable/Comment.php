<?php

class Application_Model_DbTable_Comment extends Zend_Db_Table_Abstract {

    protected $_name = 'comment';

    public function insertCommentTable($newComment) {
        $data = array(
            'Comment' => $newComment,
        );
        $this->insert($data);
    }

}

