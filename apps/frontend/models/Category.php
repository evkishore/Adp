<?php
namespace Multiple\Frontend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;


class Category extends Model{
    public function initialize(){
        $this->setSource("tbl_category");
        $this->hasMany("cate_id", "\Multiple\Frontend\Models\Product", "cate_parent_id", array('alias' => 'Product'));
        $this->hasMany("cate_id", "\Multiple\Frontend\Models\Product", "cate_id", array('alias' => 'Products'));
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
    public function getSEOName()
    {  
        return $this->seoTitle($this->name);
    }
    
    private function seoTitle($str){
       
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
       $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
       $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
       $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
       $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
       $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
       $str = preg_replace("/(đ)/", 'd', $str);
       $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
       $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
       $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
       $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
       $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
       $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
       $str = preg_replace("/(Đ)/", 'D', $str);

       return strtolower(preg_replace('/[^a-zA-Z0-9]+/','-',$str));
    }

}
?>
