<?php
namespace Multiple\Backend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Product extends Model{
    public function initialize(){
        $this->setSource("tbl_product");
        $this->hasMany("product_id", "\Multiple\Backend\Models\ProductColor", "product_id", array('alias' => 'ProductColor'));
        $this->hasMany("product_id", "\Multiple\Backend\Models\ProductImage", "product_id", array('alias' => 'ProductImage'));

        $this->belongsTo("cate_id", "\Multiple\Backend\Models\Category", "cate_id", array('alias' => 'Cate'));
        $this->belongsTo("brand_id", "\Multiple\Backend\Models\Brand", "brand_id", array('alias' => 'Brand'));
    }
}
?>
