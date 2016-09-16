<?php
namespace Multiple\Frontend\Controllers;

use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Multiple\Frontend\Models\Product as Product;
use Multiple\Frontend\Models\Brand as Brand;

class ProductController extends ControllerBase {
    public function indexAction($pageNum=1,$order='date') {
        $parentCate = $this->getParentCategory();
        
        $list = $this->getProductList('status = 1', $this->buildOrderby($order),12,$pageNum);        
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "productList"        => $list,
                                   "curentPage" => $pageNum,
                                    "childCate" => $parentCate,
                                   "type"   => 1,
                                   "brandList"   => $this->getBrand(),
                                   "order"   => $order
                                  ));      
    }
    public function detailAction($cateId,$cateName,$productId,$productName) {
        $parentCate = $this->getParentCategory();
        $product = $this->getProductDetailById($productId);
        $productRelated = $this->getProductRelated($cateId);
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "product"            => $product,
                                   "productRelated"     => $productRelated
                                  ));   
    }
    public function listAction($cateId,$order,$cateName,$pageNum=1)
    {        
        $parentCate = $this->getParentCategory();
        $cate = $this->getCategoryDetail($cateId);
       
        $paginator   = new PaginatorModel(
                array(
                    'data' => $cate->getProducts(),
                     "order" => $order,
                    'page'  => $pageNum,
                    'limit' => 12
                )
            );
        $list = $paginator->getPaginate();           
        $childCate = $this->getCategoryByParentId($cate->cate_id);  
        
        if (count($childCate)==0) {
            $childCate = $this->getCategoryByParentId($cate->parent_id); 
        }
          
        $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "productList"        => $list,
                                   "category"          => $cate,
                                   "curentPage" => $pageNum,
                                   "childCate" => $childCate,
                                   "type"   => 2,
                                   "brandList"   => $this->getBrand(),
                                   "order"   => $order
                                  ));   
    }
    public function searchAction(){
        $parentCate = $this->getParentCategory();        
        $key = trim($this->request->getQuery("key","string"));           
        $conditions = "status = 1 AND name LIKE '%". $key . "%'";
       
        $list = $this->getProductList($conditions, 'product_id DESC ',12,$pageNum); 
        
            $this->view->setVars(array("root_cate_items"    => $parentCate,
                                   "productList"        => $list,
                                   "curentPage" => 1,
                                    "childCate" => $parentCate,
                                   "type"   => 1,
                                   "brandList"   => $this->getBrand(),
                                   "order"   => 'date'
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
