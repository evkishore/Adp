<?php
namespace Multiple\Frontend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;


class Product extends Model{
    public function initialize(){
        $this->setSource("tbl_product");        
    }
}
?>
