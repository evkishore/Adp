<?php
namespace Multiple\Backend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Category extends Model {
    public function initialize(){
        $this->setSource("tbl_category");
        $this->hasMany("cate_id", "Category", "parent_id");
        $this->hasMany("cate_id", "Product", "cate_id");
        $this->belongsTo("parent_id", "\Multiple\Backend\Models\Category", "cate_id", array('alias' => 'Cate'));
    }
}
?>
