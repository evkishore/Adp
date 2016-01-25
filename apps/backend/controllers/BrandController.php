<?php
namespace Multiple\Backend\Controllers;

use Multiple\Backend\Models\Brand as  Brand;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class BrandController extends ControllerBase {
    public function indexAction() {

        $this->tag->prependTitle("list Brand - ");
        // Get parameter from request url
        $page           = 1;
        $page_size      = 10;

        $obj = array();
        $obj['name']                = $name         = $this->request->get("name");
        $obj['seo_url']             = $seo_url      = $this->request->get("seo_url");
        $obj['parent_id']           = $parent_id    = intval($this->request->get("parent_id"));
        $obj['status']              = $status       = $this->request->get("status") == null ? -1 : $this->request->get("status") ;
        $page                       = intval($this->request->get("page"));
        $page_size                  = intval($this->request->get("page_size"));

        $page       = $page == 0 ? 1 : $page;
        $page_size  = $page_size == 0 ? 10 : $page_size;

        $conditions="";
        $parameter = array();

        if(!empty($name)){
            $conditions = "name like :name:";
            $parameter['name'] = "%{$name}%" ;
        }
        if(!empty($seo_url)){
            $conditions .= (!empty($conditions)? " AND " : "").  "seo_url like :seo_url:";
            $parameter['seo_url'] = "%{$seo_url}%" ;
        }

        if($status != -1){
            $conditions .= (!empty($conditions)? " AND " : "").  "status = :status:";
            $parameter['status'] = $status;
        }
         if($parent_id > 0){
            $conditions .= (!empty($conditions)? " AND " : "").  "parent_id = :parent_id:";
            $parameter['parent_id'] = $parent_id;
        }

        if($page_size > 0){
            $paginator   = new PaginatorModel(
                array(
                    'data' => Brand::find(
                        array(
                            $conditions,
                            "bind"  => $parameter,
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
                    'data' => Brand::find(
                        array(
                            $conditions,
                            "bind"  => $parameter,
                            "order" => $order
                        )
                    )
                )
            );
        }
        $items = $paginator->getPaginate();
        $obj['page']        = $page;
        $obj['page_size']   = $page_size;

        $this->view->setVars(array("items"   => $items,
                                   "obj"    => $obj
                                  ));

    }

    public function editAction($id = 0) {
        global $config;
        $this->tag->prependTitle("Edit Brand - ");
        $detail = Brand::findFirst("brand_id={$id}");
        $this->view->setVars(array(
            "id"            => $id,
            "detail"        => $detail == null ? array(): $detail,
            "baseImageURL"  => $config->app->image->baseURL

        ));
        if ($this->request->isPost() == true) {
            if($id == 0){
                $object = new Brand();
            }else{
                $object = Brand::findFirst("cate_id={$id}");
                if($object == null){
                    $this->flash->error("too bad! The Brand with id {$id} not exists in sytems!");
                    exit;
                }
                $object->modify_date  = date('Y-m-d H:i');
            }
            /* BEGIN PROCESS UPLOAD */
            // Check if the user has uploaded files
            $image_url = $this->processUpload();

            $object->name         = trim($this->request->getPost("name"));
            $object->status       = intval($this->request->getPost("status"));
            $object->order_id     = intval($this->request->getPost("order_id"));
            $object->parent_id    = intval($this->request->getPost("parent_id"));
            $object->seo_url      = "";
            if ($object->save() == false) {
                // Show validation messages
                $error = array();
                foreach ($object->getMessages() as $message) {
                   $error[] = $message;
                }
                $this->flash->error("too bad! Save data unSuccessful! ". implode($error," <br/>") );
            } else {
                // save seo_url
                if($id == 0){
                    $object->seo_url = $this->seo_url($object->brand_id, $object->name, $object->parent_id );
                }else{
                    $object->seo_url = trim($this->request->getPost("seo_url"));
                }
                if ($object->save() == false) {
                    $this->flash->error("too bad! Save data unSuccessful");
                } else {
                    $this->flash->success("yes!, Save data successful");
                }
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
                    $result = array('result' => 0 , 'message'=> "Parameter is invalid !");
                    $this->response->setJsonContent($result) ;
                    return $this->response;
                }else{
                    $detail = Brand::findFirst("brand_id={$id}");
                    $result = array();
                    if($detail != null){
                        $detail->$type = $value;
                        if ($detail->save() == true) {
                            $result = array('result' => 1 , 'message'=> "Successfull!");
                        } else {
                            $result = array('result' => 0 , 'message'=> "Unsuccessfull!");
                        }
                    }else{
                        $result = array('result'=>0 , 'message'=> "Brand is not exists!!");
                    }
                    $this->response->setJsonContent($result) ;
                    return $this->response;
                }
            }
        }
    }


    /*
        PRIVATE FUNCTION
    */
    private function seo_url($id =0, $name="", $parent_id = 0){
        $result ="";
        $name = $this->remove_accent($name);
        if($parent_id > 0){
            $parent = Brand::findFirst("brand_id={$parent_id}");
        }
        $result = $parent_id == 0 ? "/{$name}" :"{$parent->seo_url}/{$id}/{$name}";
        return $result;
    }

    private function remove_accent($str){
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
