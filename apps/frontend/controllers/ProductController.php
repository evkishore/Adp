<?php
namespace Multiple\Frontend\Controllers;
use Multiple\Frontend\Models\Product as Product;

class ProductController extends ControllerBase {
    public function indexAction($pageNum=1) {
        $parentCate = $this->getParentCategory();
        $list = $this->getProductList('status = 1 ', 'product_id DESC ',10,$pageNum);        
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "productList"        => $list,
                                   "curentPage" => $pageNum,
                                    "childCate" => $parentCate,
                                   "type"   => 1
                                  ));      
    }
    public function detailAction($cateId,$cateName,$productId,$productName) {
        $parentCate = $this->getParentCategory();
        $product = $this->getProductDetailById($productId);
        $productRelated = $this->getProductRelated($product->cate_id);
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "product"            => $product,
                                   "productRelated"     => $productRelated
                                  ));   
    }
    public function listAction($cateId,$cateName,$pageNum=1)
    {
        $parentCate = $this->getParentCategory();
        $cate = $this->getCategoryDetail($cateId);
        if($cate->parent_id>0){
            $list = $this->getProductList('status = 1 AND cate_id ='.$cateId, 'product_id DESC',10,$pageNum);  
             $childCate = $this->getCategoryByParentId($cate->parent_id);  
        }            
        else{
            $list = $this->getProductList('status = 1 AND cate_parent_id ='.$cateId, 'product_id DESC',10,$pageNum);  
           $childCate = $this->getCategoryByParentId($cate->cate_id);  
        }
          
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "productList"        => $list,
                                   "category"          => $cate,
                                   "curentPage" => $pageNum,
                                   "childCate" => $childCate,
                                   "type"   => 2
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
