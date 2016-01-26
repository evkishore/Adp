<?php
namespace Multiple\Frontend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class ProductImage extends Model{
    public function initialize(){
        $this->setSource("tbl_product_image");
    }
}
?>
