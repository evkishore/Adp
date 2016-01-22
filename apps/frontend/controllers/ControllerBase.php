<?php
namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Multiple\Frontend\Models\menu as Menu;
use Multiple\Frontend\Models\content as Content;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class ControllerBase extends Controller {
    public function initialize() {
      $this->assets
          ->collection('css')
          ->addCss('frontend/css/bootstrap.css')
          ->addCss('frontend/css/responsive.css')
          //->addCss('frontend/css/camera.css')
          ->addCss('frontend/css/style.css')
          //->addCss('frontend/css/flexslider.css')
          ->addCss('frontend/css/owl.carousel.css')
          ->addCss('frontend/css/owl.theme.css')
          ->addCss('frontend/css/font-awesome.css')
          //->addCss('frontend/css/cherry-plugin.css')
          //->addCss('frontend/css/lazy-load.css')
          ->addCss('frontend/css/styles.css')
          ->addCss('frontend/css/main-style.css')
          //->addCss('frontend/css/magnific-popup.css')
          ;
      $this->assets
          ->collection('js-header')
            ->addJs('frontend/js/jquery-1.7.2.min.js')
            ->addJs('frontend/js/jquery-migrate-1.2.1.min.js')
            //->addJs('frontend/js/swfobject.js')
            //->addJs('frontend/js/modernizr.js')
            //->addJs('frontend/js/jflickrfeed.js')
            //->addJs('frontend/js/jquery.easing.1.3.js')
            //->addJs('frontend/js/jcustom.js')
            ->addJs('frontend/js/bootstrap.min.js');
            //->addJs('frontend/js/jquery.elastislide.js');

          $this->assets
              ->collection('js-footer')
              //->addJs('frontend/js/comment-reply.min.js')
              //->addJs('frontend/js/cherry.lazy-load.js')
              ->addJs('frontend/js/device.min.js')
              //->addJs('frontend/js/jquery.form.min.js')
              //->addJs('frontend/js/scripts.js')
              ->addJs('frontend/js/superfish.js')
              ->addJs('frontend/js/jquery.mobilemenu.js')
              //->addJs('frontend/js/jquery.magnific-popup.min.js')
              //->addJs('frontend/js/jquery.flexslider-min.js')
              //->addJs('frontend/js/jplayer.playlist.min.js')
              //->addJs('frontend/js/jquery.jplayer.min.js')
              ->addJs('frontend/js/tmstickup.js')
              ->addJs('frontend/js/device.min(1).js')
              //->addJs('frontend/js/jquery.zaccordion.min.js')
              //->addJs('frontend/js/camera.min.js')
              //->addJs('frontend/js/jquery.debouncedresize.js')
              //->addJs('frontend/js/jquery.ba-resize.min.js')
              ->addJs('frontend/js/jquery.isotope.js')
              //->addJs('frontend/js/cherry-plugin.js')
              ;
        }
    
    public function getParentMenuInfo() {
        $conditions = "status = 1 AND parent_id =0 ";
        $menu = Menu::find(
                array(
                    $conditions,
                    "order" => "order_id ASC"
                )
            );
        return $menu;
    }
    
    public function getContentList($conditions,$order,$page_size=10,$page=0) {      
        if($page > 0){
            $paginator   = new PaginatorModel(
                array(
                    'data' => Content::find(
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
                    'data' => Content::find(
                        array(
                            $conditions,
                            "order" => $order
                        )
                    ),
                    'limit' => $page_size
                )
            );
        }
        $content = $paginator->getPaginate();
        return $content;
    }
    
    public function getContentDetailByType($type_id) {      
       
        $content = Content::findFirst("type_id={$type_id}");
        return $content;
    }
    
    public function getContentDetailById($content_id) {      
       
        $content = Content::findFirst("content_id={$content_id}");
        return $content;
    }
    
    public function getMenuDetail($menu_id) {      
       
        $menu = Menu::findFirst("menu_id={$menu_id}");
        return $menu;
    }
    
    public function getContentDetailByMenuId($menu_id) {      
       
        $content = Content::findFirst("menu_id={$menu_id}");
        return $content;
    }
    
    public function getSEOTitle($str)
    {  
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
