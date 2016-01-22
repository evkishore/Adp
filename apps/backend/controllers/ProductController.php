<?php
namespace Multiple\Backend\Controllers;

use Multiple\Backend\Models\Product as Product;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Tag as Tag;

class ProductController extends ControllerBase {

    public function indexAction() {
        $this->tag->prependTitle("List of content - ");
        // Get parameter from request url
        $page           = 1;
        $page_size      = 10;
        $obj = array();
        $obj['name']                = $name                 = $this->request->get("name");
        $obj['code']                = $code                 = $this->request->get("code");
        $obj['cate_id']             = $cate_id              = $this->request->get("cate_id") == null ? -1 :  $this->request->get("cate_id");
        $obj['brand_id']            = $brand_id             = $this->request->get("brand_id") == null ? -1 :  $this->request->get("brand_id");
        $obj['status']              = $status               = $this->request->get("status") == null ? -1 :$this->request->get("status") ;
        $obj['price_from']          = $price_from           = $this->request->get("price_from");
        $obj['price_to']            = $price_to             = $this->request->get("price_to");
        $obj['size_from']           = $size_from            = $this->request->get("size_from");
        $obj['size_to']             = $size_to              = $this->request->get("size_to");
        $obj['create_date_from']    = $create_date_from     = $this->request->get("create_date_from");
        $obj['create_date_to']      = $create_date_to       = $this->request->get("create_date_to");

        $page                       = intval($this->request->get("page"));
        $page_size                  = intval($this->request->get("page_size"));

        $page       = $page         == null ? 1 : $page;
        $page_size  = $page_size    == null ? 10 : $page_size;


        $conditions="";
        $parameter = array();

        if(!empty($name)){
            $conditions = "name like :name:";
            $parameter['name'] = "%{$name}%" ;
        }

        if(!empty($code)){
            $conditions = "code like :code:";
            $parameter['code'] = "%{$code}%" ;
        }

        if($cate_id != -1){
            $conditions .= (!empty($conditions)? " AND " : "").  "cate_id = :cate_id:";
            $parameter['cate_id'] = "{$cate_id}" ;
        }

        if($brand_id != -1){
            $conditions .= (!empty($conditions)? " AND " : "").  "brand_id = :brand_id:";
            $parameter['brand_id'] = $brand_id;
        }

        if(!empty($price_from)){
            $conditions .= (!empty($conditions)? " AND " : "").  "price >= :price_from:";
            $parameter['price_from'] = "{$price_from}" ;
        }

        if(!empty($price_to)){
            $conditions .= (!empty($conditions)? " AND " : "").  "price <= :price_to:";
            $parameter['price_to'] = "{$price_to}" ;
        }


        if(!empty($size_from)){
            $conditions .= (!empty($conditions)? " AND " : "").  "size >= :size_from:";
            $parameter['size_from'] = "{$size_from}" ;
        }

        if(!empty($size_to)){
            $conditions .= (!empty($conditions)? " AND " : "").  "size <= :size_to:";
            $parameter['size_to'] = "{$size_to}" ;
        }

        if(!empty($create_date_from)){
            $conditions .= (!empty($conditions)? " AND " : "").  "create_date >= :create_date:";
            $parameter['create_date'] = "%{$create_date_from}%" ;
        }

        if(!empty($create_date_to)){
            $conditions .= (!empty($conditions)? " AND " : "").  "create_date <= :create_date:";
            $parameter['create_date'] = "%{$create_date_to}%" ;
        }

        if($status != -1){
            $conditions .= (!empty($conditions)? " AND " : "").  "status = :status:";
            $parameter['status'] = $status;
        }
        if($page_size > 0){
            $paginator   = new PaginatorModel(
                array(
                    'data' => Product::find(
                        array(
                            $conditions,
                            "bind"  => $parameter,
                            "order" => "name"
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
                            "bind"  => $parameter,
                            "order" => "name"
                        )
                    )
                )
            );
        }
        $product = $paginator->getPaginate();
        $obj['page']        = $page;
        $obj['page_size']   = $page_size;

        $this->view->setVars(array("product"    => $product,
                                   "obj"        => $obj
                                  ));

    }

    public function editAction($product_id = 0) {
        global $config;
        $this->tag->prependTitle("Edit of content - ");
        $product_detail = Product::findFirst("product_id={$product_id}");
        $this->view->setVars(array(
            "product_id"    => $product_id,
            'content'       => $product_detail,
            'baseImageURL'  => $config->app->image->baseURL
        ));
        if ($this->request->isPost() == true) {
            /* END PROCESS UPLOAD */
            if($content_id == 0){
                $content = new Content();
            }else{
                $content = Content::findFirst("product_id={$product_id}");
                $content->modify_date  = date('Y-m-d H:i');
            }

            $content->title             = trim($this->request->getPost("title"));
            $content->description       = trim($this->request->getPost("description"));
            $content->img_url           = $image_url;
            $content->video_link        = trim($this->request->getPost("video_link"));
            $content->content           = trim($this->request->getPost("content"));
            $content->type_id           = intval($this->request->getPost("type_id"));
            $content->menu_id           = intval($this->request->getPost("menu_id"));
            $content->parent_id         = intval($this->request->getPost("parent_id"));
            $content->is_hot            = intval($this->request->getPost("is_hot"));
            $content->status            = intval($this->request->getPost("status"));

            if ($content->save() == false) {
                $this->flashSession->error("too bad! Save data unSuccessful");
                //return  $this->response->redirect( "cpanel/{}/{}/{}");
            } else {
                $this->flashSession->success("yes!, Save data successful");
            }
        }
    }

    public function changeStatusAction(){
        $request = $this->request;
        if ($request->isPost() == true) {
            if ($request->isAjax() == true) {
                $value  = $request->getPost("value");
                $id     = $request->getPost("id");
                $type   = $request->getPost("type");
                $this->view->disable();
                if($id == 0 ){
                    $this->response->setJsonContent("Parametr is invalid ") ;
                    return $this->response;
                }else{
                    $content = Content::findFirst("content_id={$id}");
                    $result = array();
                    if($content != null){
                        $content->$type = $value;
                        if ($content->save() == true) {
                            $result = array('result' => 1 , 'message'=> "Successfull!");
                        } else {
                            $result = array('result' => 0 , 'message'=> "Unsuccessfull!");
                        }
                    }else{
                        $result = array('result'=>0 , 'message'=> "Content is not exists!!");
                    }
                    $this->response->setJsonContent($result) ;
                    return $this->response;
                }
            }
        }
    }

    public function getParentMenuAction(){
        $request =$this->request;
        if ($request->isPost() == true) {
            if ($request->isAjax() == true) {
                $menu_id  = $request->getPost("menu_id");
                $this->view->disable();

                $menu = Menu::findFirst("menu_id={$menu_id}");
                $result = array();
                if($menu != null){
                    $result = array('data' => $menu->parent_id ,'result' => 1 , 'message'=> "Successfull!");
                }else{
                    $result = array('data' => 0 ,'result'=>0 , 'message'=> "User is not exists!!");
                }
                $this->response->setJsonContent($result) ;
                return $this->response;
            }
        }
    }

    /**
     * Create Directory if not exist
     *
     * @param $directory
     * @param $presmission
     *
     * @return bool
     */
    public function checkDirectoryExist($directory,$presmission = 0777){
        if($directory && file_exists($directory) === FALSE){
            mkdir(rtrim($directory,'/').DIRECTORY_SEPARATOR,$presmission,TRUE);
        }
        return TRUE;
    }

    private function processUpload(){
        $flag = false;
        global $config;
        $image_url = "";
        if ($this->request->hasFiles() == true ) {
            $dir = date("Y/m/d/", time());
            // Code ftp image here
            $baseLocation ="../public/". $config->app->image->directory. $dir;
            $this->checkDirectoryExist($baseLocation);
            foreach ($this->request->getUploadedFiles() as $file) {
                if (!empty($file->getName())){
                    $flag= true;
                    //Move the file into the application
                    $ran = rand(100000, 999999);
                    $file->moveTo($baseLocation . $ran ."-" . $file->getName());
                    $image_url = $config->app->image->directory. $dir . $ran ."-" . $file->getName();
                }
            }
        }
        if(!$flag){
            $image_url = trim($this->request->getPost("himage_url"));
        }
        return $image_url;
    }
}
?>
