<?php
namespace Multiple\Backend\Controllers;

use Multiple\Backend\Models\User as User;
use Multiple\Backend\Models\Contact as Contact;
use Phalcon\Image\Adapter\Imagick as Imagick;

class IndexController extends ControllerBase {
    public function indexAction() {
//        $image = new Imagick("/www/upmedia.com.vn/img/upload/2016/01/19/737175-020210andihien06.jpg");
//        echo "run here";
    }

    public function loginAction() {
        $this->view->setMainView("Login");
        $this->initializeLoginPage();
        // Check if request has made with POST
        if ($this->request->isPost() == true) {
            // Access POST data
            $userName = trim($this->request->getPost("username"));
            $password = trim($this->request->getPost("password"));
            $user = User::findFirst(
                array(
                    "(user_name = :username: OR email = :username:) AND  password = :password: ",
                    "bind" => array(
                                    "username" => $userName,
                                    "password" => sha1($password)
                                )
                )
            );
            if ($user != false) {
                $this->_registerSession($user);
                return  $this->response->redirect( "cpanel/");
            }

            $this->flash->error('Wrong email/password');
        }
    }
    public function logoutAction(){
        // Destroy the whole session
        $this->session->destroy();
//        global $config;
        $this->response->redirect("cpanel/login");
    }

    public function show404Action(){
        $this->view->setMainView("show404");
        $this->initializeErrorPage();
    }

    public function contactAction(){
        $this->tag->prependTitle("Edit Contact info - ");
        $contact = Contact::findFirst();
        $this->view->setVar("contact",$contact);
        if ($this->request->isPost() == true) {
            $contact = Contact::findFirst();
            if($contact == false){
                $contact = new Contact();
            }else{
                $contact->modify_date  = date('Y-m-d H:i');
            }

            $contact->name      = trim($this->request->getPost("name"));
            $contact->phone     = trim($this->request->getPost("phone"));
            $contact->email     = trim($this->request->getPost("email"));
            $contact->content   = trim($this->request->getPost("content"));
            $contact->status    = intval($this->request->getPost("status"));

            if ($contact->save() == false) {
                //echo $content->getMessage();exit;
                $this->flashSession->error("too bad! Save data unSuccessful");
            } else {
                $this->flashSession->success("yes!, Save data successful");
            }
            $this->response->redirect("cpanel/contact");
        }
    }
    /*
    PRIVATE FUNCTION
    */

     private function _registerSession($user){
        $this->session->set(
            'auth',
            array(
                'id'   => $user->user_id,
                'name' => $user->user_name
            )
        );
    }
}
?>
