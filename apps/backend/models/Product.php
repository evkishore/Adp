<?php
namespace Multiple\Backend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Product extends Model{
    public function initialize(){
        $this->setSource("tbl_product");
          $this->hasMany("product_id", "ProductColor", "product_id");
          $this->hasMany("product_id", "ProductImage", "product_id");
          $this->hasMany("cate_id", "Category", "cate_id");
          $this->hasMany("brand_id", "Brand", "brand_id");
    }
}
?>
