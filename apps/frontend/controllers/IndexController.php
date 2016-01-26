<?php
namespace Multiple\Frontend\Controllers;
use Multiple\Frontend\Models\Brand as Brand;
use Multiple\Frontend\Models\Product as Product;

class IndexController extends ControllerBase {
    public function indexAction() {
        $parentCate = $this->getParentCategory();
        $this->view->setVar('root_cate_items', $parentCate);
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "brand"        => $this->getBrand(),
                                   "product"        => $this->getProduct()
                                  ));
    }
    private function getBrand(){
        $conditions = "status = 1";
        $brand = Brand::find(
                array(
                    $conditions,
                    "order" => "order_id ASC"
                )
            );
        return $brand;
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
}
?>
