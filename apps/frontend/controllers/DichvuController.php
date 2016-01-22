<?php
namespace Multiple\Frontend\Controllers;

class DichvuController extends ControllerBase {
    public function indexAction() {
        $parentMenu = $this->getParentMenuInfo();
        $this->view->setVar('root_menu_items', $parentMenu);
    }
    public function detailAction($type,$name)
    {
        $parentMenu = $this->getParentMenuInfo();
        $content = $this->getContentDetailByMenuId($type);
        $this->view->setVar('root_menu_items', $parentMenu);
        $this->view->content = $content;
        $listOther = $this->getContentList('status = 1 AND parent_id = 3', 'content_id DESC');
        $this->view->listOther = $listOther;
        $menu =  $this->getMenuDetail($type);
        $this->view->cate = $name;
        $this->view->title = $menu->name;
        $content->total_view = $content->total_view + 1;
        $content->save();
    }

}
?>
