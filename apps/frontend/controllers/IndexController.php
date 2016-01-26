<?php
namespace Multiple\Frontend\Controllers;

class IndexController extends ControllerBase {
    public function indexAction() {
        $parentCate = $this->getParentCategory();
        $this->view->setVar('root_cate_items', $parentCate);
//        $services = $this->getContentList('status = 1 AND parent_id = 3', 'content_id DESC', 3);
//        $this->view->serviceList = $services;
//        $news = $this->getContentList('status = 1 AND parent_id = 4', 'content_id DESC',6);
//        $this->view->newsList = $news;
//        $video = $this->getContentList('status = 1 AND parent_id = 5', 'total_view DESC', 10);
//        $this->view->videoList = $video;
//        $hot = $this->getContentList('status = 1 AND is_hot = 1 AND parent_id = 4', 'content_id DESC',6);
//        $this->view->hotList = $hot;
    }
}
?>
