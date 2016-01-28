<?php
namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Multiple\Frontend\Models\Category as Category;
use Multiple\Frontend\Models\Product as Product;
use Multiple\Frontend\Models\Brand as Brand;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class ControllerBase extends Controller {
    public function initialize() {
      $this->assets
          ->collection('css')
          ->addCss('frontend/lib/slick/slick.css')
          ->addCss('frontend/lib/slick/slick-theme.css')
          ->addCss('frontend/lib/rs-plugin/css/settings.css')
          ->addCss('frontend/lib/chosen/chosen.min.css')
          ->addCss('frontend/lib/styleswitch/styleswitcher.css')
          ->addCss('frontend/lib/ntm/collapse.css')
          ->addCss('frontend/css/cache.skin.css')
          ->addCss('frontend/css/language-selector.css')
          ->addCss('frontend/css/bootexpert.css')
          ->addCss('frontend/css/megamenu_style.css')
          ->addCss('frontend/css/font-awesome.min.css')
          ->addCss('frontend/css/bootstrap.min.css')
          ->addCss('frontend/css/icomoon.css')
          ->addCss('frontend/css/bootexpert-compose.css')
          ->addCss('frontend/css/style.css')
          ->addCss('frontend/css/css/accessories/theme1.css')
          ->addCss('frontend/css/accessories/accessories.css')
          ;
            
      $this->assets
          ->collection('js')
            ->addJs('frontend/js/jquery-2.1.1.min.js')
            ->addJs('frontend/lib/jquary-ui/jquery-ui.js')
            ->addJs('frontend/js/bootstrap.min.js')
            ->addJs('frontend/lib/styleswitch/styleswitcher.js')
            ->addJs('frontend/lib/styleswitch/styleswitch_custom.js')
            ->addJs('frontend/lib/slick/slick.min.js')
            ->addJs('frontend/lib/rs-plugin/js/jquery.themepunch.tools.min.js')
            ->addJs('frontend/lib/rs-plugin/js/jquery.themepunch.revolution.min.js')
            ->addJs('frontend/lib/rs-plugin/rs.home.js')
            ->addJs('frontend/lib/chosen/chosen.jquery.js')
            ->addJs('frontend/lib/chosen/chosen.proto.min.js')
            ->addJs('frontend/lib/prettyPhoto/js/jquery.prettyPhoto.js')
            ->addJs('frontend/lib/countdown/jquery.countdown.min.js')
            ->addJs('frontend/lib/ntm/jquery.ntm.js')
            ->addJs('frontend/js/saharan.js')
              ;       
        }
    
    public function getParentCategory() {
        $conditions = "status = 1 AND parent_id =0 ";
        $cate = Category::find(
                array(
                    $conditions,
                    "order" => "order_id ASC"
                )
            );
        return $cate;
    }
    
    public function getCategoryByParentId($parent_id) {
        $conditions = "status = 1 AND parent_id = ". $parent_id;
        $cate = Category::find(
                array(
                    $conditions,
                    "order" => "order_id ASC"
                )
            );
        return $cate;
    }
    
    public function getProductList($conditions,$order,$page_size=10,$page=0) {      
        if($page > 0){
            $paginator   = new PaginatorModel(
                array(
                    'data' => Product::find(
                        array(
                            $conditions,
                            "order" => $order
                        )
                    ),
                    'limit' => $page_size,
                    'page'  => $page
                )
            );
        }else{
            $paginator   = new PaginatorModel(
                array(
                    'data' => Product::find(
                        array(
                            $conditions,
                            "order" => $order
                        )
                    ),
                    'limit' => $page_size
                )
            );
        }
        $product = $paginator->getPaginate();
        return $product;
    }    
     
    public function getProductDetailById($product_id) {      
        $product = Product::findFirst("product_id={$product_id}");
        return $product;
    }
    
    public function getBrandDetailById($brand_id) {      
       
        $brand = Brand::findFirst("brand_id={$brand_id}");
        return $brand;
    }
    
    public function getCategoryDetail($cate_id) {      
       
        $cate = Category::findFirst("cate_id={$cate_id}");
        return $cate;
    }
    
}
?>
