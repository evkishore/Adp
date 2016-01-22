<?php
namespace Multiple\Backend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class User extends Model{
    public function initialize(){
        $this->setSource("tbl_user");
    }
}
?>
