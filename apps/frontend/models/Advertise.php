<?php
namespace Multiple\Frontend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Advertise extends Model{
    public function initialize(){
        $this->setSource("tbl_advertise");
    }    
}
?>

