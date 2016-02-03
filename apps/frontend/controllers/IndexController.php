<?php
namespace Multiple\Frontend\Controllers;
use Multiple\Frontend\Models\Brand as Brand;
use Multiple\Frontend\Models\Product as Product;
use Multiple\Frontend\Models\Advertise as Advertise;

class IndexController extends ControllerBase {
    public function indexAction() {
        $parentCate = $this->getParentCategory();
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "brand"        => $this->getBrand(),
                                   "product"        => $this->getProduct(),
                                   "adv"        => $this->getAdv()
                                  ));
    }   
     
    private function getProduct(){
        $conditions = "status = 1 AND price >0 ";
        $product = Product::find(
                array(
                    $conditions,
                    "order" => "product_id DESC",
                    'limit' => 6
                )                
            );
        return $product;        
    }
     private function getAdv(){
        $conditions = "status = 1 ";
        $adv = Advertise::find(
                array(
                    $conditions,
                    "order" => "adv_id DESC",
                    'limit' => 2
                )                
            );
        return $adv;        
    }
}
?>
