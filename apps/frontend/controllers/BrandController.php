<?php
namespace Multiple\Frontend\Controllers;
use Multiple\Frontend\Models\Product as Product;

class BrandController extends ControllerBase {
    public function indexAction($id,$name,$page=1,$order='date') {
        $parentCate = $this->getParentCategory();
        $list = $this->getProductList('status = 1 AND brand_id = '. $id , $this->buildOrderby($order),12,$page);  
        $brand = $this->getBrandDetailById($id);
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "productList"        => $list,
                                   "brand"          => $brand,
                                   "curentPage" => $page,
                                   "childCate" => $parentCate,
                                   "type"   => 3,
                                   "brandList"   => $this->getBrand(),
                                   "order"   => $order
                                  ));      
    }
   
}
?>
