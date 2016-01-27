<?php
namespace Multiple\Frontend\Controllers;
use Multiple\Frontend\Models\Product as Product;

class ProductController extends ControllerBase {
    public function indexAction() {
        $parentCate = $this->getParentCategory();
        $list = $this->getProductList('status = 1 ', 'product_id DESC ',10,1);        
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "productList"        => $list
                                  ));      
    }
    public function detailAction($cateId,$cateName,$productId,$productName) {
        $parentCate = $this->getParentCategory();
        $product = $this->getProductDetailById($productId);
        $productRelated = $this->getProductRelated($product->cate_id);
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "product"        => $product,
                                   "productRelated"        => $productRelated
                                  ));   
    }
    public function listAction($cateId,$cateName,$pageNum=1)
    {
        $parentCate = $this->getParentCategory();
        $list = $this->getProductList('status = 1 AND cate_id ='.$cateId, 'product_id DESC',10,$pageNum);    
        $cate = $this->getCategoryDetail($cateId);
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "productList"        => $list,
                                   "category"          => $cate,
                                   "curentPage" => $pageNum
                                  ));   
    }
     private function getProductRelated($cate_id){
        $conditions = "status = 1 AND cate_id = " + $cate_id;
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
