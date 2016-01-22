<?php
namespace Multiple\Frontend\Controllers;

class VideoController extends ControllerBase {
    public function indexAction() {
        $parentMenu = $this->getParentMenuInfo();
        $this->view->setVar('root_menu_items', $parentMenu);
        $list = $this->getContentList('status = 1 AND parent_id = 5', 'content_id DESC',20);
        $this->view->videoList = $list;
        $this->view->seoUrl = '';
        if(count($list->items)){
             $this->view->seoUrl = $list->items[0]->Menu->seo_url;
        }
        $this->view->current=$pageNum;
    }
    public function listAction($cateId,$cateName,$pageNum=1)
    {
        $parentMenu = $this->getParentMenuInfo();
        $list = $this->getContentList('status = 1 AND menu_id ='.$cateId, 'content_id DESC',10,$pageNum);
        $this->view->setVar('root_menu_items', $parentMenu);
        $this->view->videoList = $list;
        $this->view->seoUrl = '';
        if(count($list->items)){
             $this->view->seoUrl = $list->items[0]->Menu->seo_url;
        }
        $this->view->current=$pageNum;
        
    }
    public function detailAction($cateId,$cateName,$videoId,$videoName)
    {
        $parentMenu = $this->getParentMenuInfo();
        $video = $this->getContentDetailById($videoId);
        $this->view->setVar('root_menu_items', $parentMenu);
        $this->view->videoDetail = $video;
        if(count($video))
        {
            $list = $this->getContentList('status = 1 AND menu_id ='.$video->menu_id, 'content_id DESC');
            $this->view->videoList = $list;  
            $video->total_view = $video->total_view + 1;
            $video->save();
        }
        
    }
}
?>
