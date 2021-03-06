<?php
namespace Multiple\Frontend\Controllers;
use Multiple\Frontend\Models\contact as Contact;

class ContactController extends ControllerBase {
    public function indexAction() {
        $parentCate = $this->getParentCategory();
        $this->view->setVar('root_cate_items', $parentCate);
       // $parentMenu = $this->getParentMenuInfo();
       // $this->view->setVar('root_menu_items', $parentMenu);
        
    }
    public function addAction() {
        $parentCate = $this->getParentCategory();
        $this->view->setVar('root_cate_items', $parentCate);
        if ($this->request->isPost() == true) {
            $contact = new Contact();
            $contact->name             = trim($this->request->getPost("name"));
            $contact->email       = trim($this->request->getPost("email"));
            $contact->phone           = trim($this->request->getPost("phone"));;
            $contact->content        = trim($this->request->getPost("message"));
            $contact->create_date           = date('Y-m-d H:i');            
            $contact->status            = 1;

            if ($contact->save() == false) {
                $this->response->redirect('contact');
            } else {
                $this->response->redirect('contact');
            }
        }
    }
}
?>
