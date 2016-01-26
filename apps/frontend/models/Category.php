<?php
namespace Multiple\Frontend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;


class Category extends Model{
    public function initialize(){
        $this->setSource("tbl_category");
        $this->hasMany("cate_id", "\Multiple\Frontend\Models\Product", "cate_id", array('alias' => 'Product'));
    }
    
    public function getChilds()
    {
        $result = false;
        if($this->cate_id) {
            $childs = self::find("parent_id = $this->cate_id");
            if(count($childs)) {
                $result = $childs;
            }
        }

        return $result;
    }
}
?>
