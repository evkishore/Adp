<?php
namespace Multiple\Frontend\Controllers;
use Multiple\Frontend\Models\contact as Contact;

class ProductController extends ControllerBase {
    public function indexAction() {
        $parentCate = $this->getParentCategory();
        $this->view->setVar('root_cate_items', $parentCate);
       // $parentMenu = $this->getParentMenuInfo();
       // $this->view->setVar('root_menu_items', $parentMenu);
        
    }
    public function detailAction() {
        $parentCate = $this->getParentCategory();
        $this->view->setVar('root_cate_items', $parentCate);
       // $parentMenu = $this->getParentMenuInfo();
       // $this->view->setVar('root_menu_items', $parentMenu);
        
    }
    
}
?>
