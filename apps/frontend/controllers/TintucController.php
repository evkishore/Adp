<?php
namespace Multiple\Frontend\Controllers;

class TintucController extends ControllerBase {
    public function indexAction() 
    {
         $parentMenu = $this->getParentMenuInfo();
        $list = $this->getContentList('status = 1 AND parent_id =4', 'content_id DESC',10);
        $this->view->setVar('root_menu_items', $parentMenu);
        $this->view->contentList = $list;
        $listOther = $this->getContentList(' status = 1 AND parent_id = 4', 'total_view DESC',3);
        $this->view->listOther = $listOther;
        $this->view->title = 'Tin tức mới';
        $this->view->current=1;
        
    }
    public function detailAction($cateId,$cateName,$contentId,$contentName)
    {
        $parentMenu = $this->getParentMenuInfo();
        $content = $this->getContentDetailById($contentId);
        $this->view->setVar('root_menu_items', $parentMenu);
        $listOther = $this->getContentList(' status = 1 AND menu_id ='.$cateId, 'total_view DESC',5);
        $this->view->content = $content;
        $this->view->listOther = $listOther;  
        $content->total_view = $content->total_view + 1;
        $content->save();
    }
    public function listAction($cateId,$cateName,$pageNum =1)
    {
        $parentMenu = $this->getParentMenuInfo();
        $list = $this->getContentList('status = 1 AND menu_id ='.$cateId, 'content_id DESC',10,$pageNum);
        $listOther = $this->getContentList(' status = 1 AND menu_id ='.$cateId, 'total_view DESC',3);
        $this->view->setVar('root_menu_items', $parentMenu);
        $this->view->contentList = $list;      
        $this->view->title = '';
        $this->view->seoUrl = '';
        if(count($list->items)){
             $this->view->title = $list->items[0]->Menu->name;
             $this->view->seoUrl = $list->items[0]->Menu->seo_url;
        }
        $this->view->listOther = $listOther;
        $this->view->current=$pageNum;
        
    }    
}
?>
