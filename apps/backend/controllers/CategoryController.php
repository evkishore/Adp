<?php
namespace Multiple\Backend\Controllers;

use Multiple\Backend\Models\Category as Cate;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class CategoryController extends ControllerBase {
    public function indexAction() {

        $this->tag->prependTitle("list Category - ");
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
                    'data' => Cate::find(
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
                    'data' => Cate::find(
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
        $this->tag->prependTitle("Edit Category - ");
        if ($this->request->isPost() == true) {
            $dataPost = $this->request->getPost();
           /* echo "<pre>";
            echo var_dump($dataPost);exit;*/
            if($id == 0){
                $object = new Cate();
                unset( $dataPost['cate_id'] );
            }else{
                $object = Cate::findFirst("cate_id={$id}");
                if($object == null){
                    $this->flash->error("too bad! The Category with id {$id} not exists in sytems!");
                    exit;
                }
                $dataPost['modify_date'] = date('Y-m-d H:i');
            }

            if ($object->save($dataPost) == false) {
                $this->flash->error("too bad! Save data unSuccessful");
            } else {
                // save seo_url
                $object = Cate::findFirst("cate_id=".$object->cate_id);
                $dataUpdate= array();
                if($id == 0){
                    $dataUpdate['seo_url']  = $this->seo_url($object->cate_id, $object->name, $object->parent_id );
                }else{
                   $dataUpdate['seo_url']   = trim($this->request->getPost("seo_url"));
                }
                if ($object->update($dataUpdate) == false) {
                    $this->flash->error("too bad! Save data unSuccessful");
                } else {
                    $this->flash->success("yes!, Save data successful");
                }
            }
        }
        $detail = Cate::findFirst("cate_id={$id}");
        $this->view->setVars(array(
            "id"        => $id,
            "detail"    => $detail == null ? array(): $detail,

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
                $result = array();
                if($id == 0 ){
                    $result = array('result' => 0 , 'message'=> "Parametr is invalid !");
                    $this->response->setJsonContent($result) ;
                    return $this->response;
                }else{
                    $detail = Cate::findFirst("menu_id={$id}");
                    if($detail != null){
                        $detail->$type = $value;
                        if ($detail->save() == true) {
                            $result = array('result' => 1 , 'message'=> "Successfull!");
                        } else {
                            $result = array('result' => 0 , 'message'=> "Unsuccessfull!");
                        }
                    }else{
                        $result = array('result'=>0 , 'message'=> "Category is not exists!!");
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
    private function seo_url($cate_id = 0, $name="", $parent_id = 0){
        $result ="";
        $name = $this->remove_accent($name);
        if($parent_id > 0){
            $parent = Cate::findFirst("cate_id={$parent_id}");
            $result = "{$parent->seo_url}/{$cate_id}/{$name}";
        }else{
            $result = "/{$name}";
        }
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
}
?>
