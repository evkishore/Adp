<?php
namespace Multiple\Backend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Brand extends Model{
    public function initialize(){
        $this->setSource("tbl_brand");
        $this->belongsTo("parent_id", "\Multiple\Backend\Models\Brand", "brand_id", array('alias' => 'Brand'));
    }
}
?>
