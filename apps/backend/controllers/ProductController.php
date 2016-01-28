<?php
namespace Multiple\Backend\Controllers;

use Multiple\Backend\Models\Product as Product;

use Multiple\Backend\Models\Category as Cate;
use Multiple\Backend\Models\ProductImage as ProductImage;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Tag as Tag;

class ProductController extends ControllerBase {

    const slag = "@#@";
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
        $items = $paginator->getPaginate();
        $obj['page']        = $page;
        $obj['page_size']   = $page_size;

        $this->view->setVars(array("items"    => $items,
                                   "obj"        => $obj
                                  ));

    }

    public function editAction($id = 0) {
        global $config;
        $this->tag->prependTitle("Edit of product - ");
        if ($this->request->isPost() == true) {
            $dataPost = $this->request->getPost();
            if($id == 0){
                $object = new Product();
                unset( $dataPost['product_id']);
            }else{
                $object = Product::findFirst("product_id={$id}");
                $dataPost['modify_date'] = date('Y-m-d H:i');
            }
            // Get list Images upload for product
            $arr_images = trim($this->request->getPost("himages")) !== "" ?
                                explode(self::slag,trim($this->request->getPost("himages"))): array();
            if ($object->save($dataPost) == false) {
                $this->flashSession->error("too bad! Save data unSuccessful");
            } else {

                if(!empty( $arr_images)){
                     // Save Image for productImages
                    //Deleting Product Image olde before inser New
                    if($object->ProductImage->delete() == false){
                        $this->flashSession->error("too bad! Delete product Images fail.");
                    }

                    $c_success = 0;
                    $index = 0;
                    foreach($arr_images as $img){
                        if($img !=""){
                            $p_img = new ProductImage();
                            $arr_basic = array(
                                'img_url'       => $img,
                                'status'        => 1,
                                'order_id'      => $index,
                                'product_id'    => $object->product_id,
                            );
                            if($p_img->save($arr_basic) == true){
                                $c_success ++ ;
                                unset($arr_images[$index]);
                            }
                        }
                        $index ++;
                    }
                    //unlink old image
                    $arr_images_old = explode(self::slag,trim($this->request->getPost("himages_old")));
                    $this->deleteImages(array_merge($arr_images_old,$arr_images));

                    $this->flashSession->success("yes!, Save Product successful - {$c_success} Images product effected!");
                }else{
                    $this->flashSession->success("yes!, Save Product successful ");
                }
            }
        }
        $detail         = Product::findFirst("product_id={$id}");
        $this->view->setVars(array(
            "id"            => $id,
            'detail'        => $detail,
            'baseImageURL'  => $config->app->image->baseURL,
            'obj'           => array('images' => $detail && count($detail->ProductImage) > 0 ? $detail->ProductImage : array()),
            'slag'          => self::slag
        ));
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

    public function uploadImageAction(){
        $this->view->disable();
        $request = $this->request;
        if ($request->isPost() == true && $request->isAjax() == true) {
            global $config;
            $image_url = "";
            $name = "";
            if ($this->request->hasFiles() == true ) {
                $dir = date("Y/m/d/", time());
                // Code ftp image here
                $baseLocation = "../public/". $config->app->image->directory. $dir;
                $this->checkDirectoryExist($baseLocation);
                foreach ($this->request->getUploadedFiles() as $file) {
                    $name = $file->getName();
                    if (!empty($name)){
                        //Move the file into the application
                        $ran = rand(100000, 999999);
                        $file->moveTo($baseLocation . $ran ."-" . $name);
                        $image_url = $config->app->image->directory. $dir . $ran ."-" . $name;

                    }
                }
            }
            echo json_encode(array('path' => $image_url,'name' => $name ));
        }
    }

    public function getParentCateAction(){
        $request =$this->request;
        if ($request->isPost() == true) {
            if ($request->isAjax() == true) {
                $id  = $request->getPost("id");
                $this->view->disable();

                $detail = Cate::findFirst("cate_id={$id}");
                $result = array();
                if($detail != null){
                    $result = array('data' => $detail->parent_id ,'result' => 1 , 'message'=> "Successfull!");
                }else{
                    $result = array('data' => 0 ,'result'=>0 , 'message'=> "Category is not exists!!");
                }
                $this->response->setJsonContent($result) ;
                return $this->response;
            }
        }
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

    private function deleteImages($array_images= array())
    {
        foreach($arr_images as $img){
            unlink("../public/".$img);
        }
    }
}
?>
