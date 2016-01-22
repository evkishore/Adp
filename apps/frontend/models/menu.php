<?php
namespace Multiple\Frontend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Menu extends Model{
    public function initialize(){
        $this->setSource("tbl_menu");
        //$this->hasMany("menu_id", "tbl_content", "menu_id");
    }
    public function getChilds()
    {
        $result = false;
        if($this->menu_id) {
            $childs = self::find("parent_id = $this->menu_id");
            if(count($childs)) {
                $result = $childs;
            }
        }

        return $result;
    }
}
?>
