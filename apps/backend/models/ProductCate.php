<?php
namespace Multiple\Backend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class ProductCate extends Model{
    public function initialize(){
        $this->setSource("tbl_product_cate");
        $this->belongsTo("product_id", "\Multiple\Backend\Models\Product", "product_id", array('alias' => 'Product'));
        $this->belongsTo("cate_id", "\Multiple\Backend\Models\Category", "cate_id", array('alias' => 'Cate'));
    }
}
?>
