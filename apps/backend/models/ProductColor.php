<?php
namespace Multiple\Backend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class ProductColor extends Model{
    public function initialize(){
        $this->setSource("tbl_product_color");
        $this->belongsTo("product_id", "\Multiple\Backend\Models\Product", "product_id", array('alias' => 'Product'));
    }
}
?>
