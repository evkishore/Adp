<?php
namespace Multiple\Frontend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Product extends Model{
    public function initialize(){
        $this->setSource("tbl_product");     
         $this->hasMany("product_id", "\Multiple\Frontend\Models\ProductImage", "product_id", array('alias' => 'ProductImage'));
    }
}
?>
