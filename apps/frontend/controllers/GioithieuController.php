<?php
namespace Multiple\Frontend\Controllers;

class GioithieuController extends ControllerBase {
    public function indexAction() {
        $parentMenu = $this->getParentMenuInfo();
        $content = $this->getContentDetailByType(1);
        $this->view->setVar('root_menu_items', $parentMenu);
        $this->view->content = $content;
        $listOther = $this->getContentList('status = 1 AND parent_id = 3', 'content_id DESC');
        $this->view->listOther = $listOther;
        $this->view->cate = '';
        $this->view->title = '';
        //echo var_dump($content->Menu->name); exit();
     
    }

}
?>
