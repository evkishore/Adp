<?php
namespace Multiple\Frontend\Controllers;
use Multiple\Frontend\Models\Product as Product;

class BrandController extends ControllerBase {
    public function indexAction($id,$name,$page) {
        $parentCate = $this->getParentCategory();
        $list = $this->getProductList('status = 1 AND brand_id = ' + $id , 'product_id DESC ',10,$page);  
        $brand = $this->getBrandDetailById($id);
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "productList"        => $list,
                                   "brand"          => $brand,
                                   "curentPage" => $page
                                  ));      
    }
      
}
?>
