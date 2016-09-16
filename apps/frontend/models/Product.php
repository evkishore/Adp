<?php
namespace Multiple\Frontend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Product extends Model{
    public function initialize(){
        $this->setSource("tbl_product");     
        $this->hasMany("product_id", "\Multiple\Frontend\Models\ProductImage", "product_id", array('alias' => 'ProductImage'));
        $this->belongsTo("cate_id", "\Multiple\Frontend\Models\Category", "cate_id", array('alias' => 'Category'));
        $this->belongsTo("brand_id", "\Multiple\Frontend\Models\Brand", "brand_id", array('alias' => 'Brand'));
        $this->hasManyToMany(
            "product_id",
            "\Multiple\Frontend\Models\ProductCate",
            "product_id",
            "cate_id",
            "\Multiple\Frontend\Models\Category",
            "cate_id",
            array(
                "alias"     => "Categories"
            )
        );
    }   
    public function getSEOCate()
    {
        $name = "";
        if(count($this->Categories)>0){
            $name = $this->Categories[0]->name;
        }
        else{
            $name = $this->Category->name;
        }
        return $this->seoTitle($name);
    }
    public function getCateId()
    {
        $id = 0;
        if(count($this->Categories)>0){
            $id = $this->Categories[0]->cate_id;
        }
        else{
            $id = $this->Category->cate_id;
        }
        return $id;
    }
    public function getCateName()
    {
        $name = "";
        if(count($this->Categories)>0){
            $name = $this->Categories[0]->name;
        }
        else{
            $name = $this->Category->name;
        }
        return $name;
    }
    public function getSEOTitle()
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
