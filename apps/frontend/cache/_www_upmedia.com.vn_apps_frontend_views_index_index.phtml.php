<div class="row">
    <div class="span12">
        <div class="row">
            <div class="span12" data-motopress-type="static">
                <div class="slider_off"> </div>
            </div>
        </div>
        <div class="row">
            <div class="span12" data-motopress-type="loop">
                <div id="post-203" class="post-203 page type-page status-publish hentry">
                    <div class="row ">
                        <div class="span8 ">
                            <section class="lazy-load-box effect-fade">
                                <ul class="posts-list list_1">
                                    <?php $i =0;?>
                                    <?php foreach ($hotList->items as $h) { ?>
                                    
                                    <li class="row-fluid list-item-<?php echo $i; ?>">
                                        <figure class="featured-thumbnail thumbnail ">
                                            <a href="/tin-tuc/<?php echo $h->menu_id; ?>/<?php echo $h->getSEOCate(); ?>/<?php echo $h->content_id; ?>/<?php echo $h->getSEOTitle(); ?>/" title="<?php echo $h->title; ?>">
                                             
                                         <img src="<?php echo $h->img_url; ?>" alt="<?php echo $h->title; ?>">
                                   
                                            </a>
                                        </figure>
                                        <div class="post_content">
                                            <h2 class="post-title">
                                                <a href="/tin-tuc/<?php echo $h->menu_id; ?>/<?php echo $h->getSEOCate(); ?>/<?php echo $h->content_id; ?>/<?php echo $h->getSEOTitle(); ?>/" title="<?php echo $h->title; ?>"><?php echo $h->title; ?></a>
                                            </h2>
                                            <span class="post_date">
                                                <time datetime="2014-10-03T18:18:10"><?php echo date('Y-m-d H:i', time()); ?></time>
                                            </span>
                                            <span class="post_comment">
                                                <a href="/tin-tuc/<?php echo $h->menu_id; ?>/<?php echo $h->getSEOCate(); ?>/<?php echo $h->content_id; ?>/<?php echo $h->getSEOTitle(); ?>/" class="comments_link"><?php echo $h->total_view; ?> Views</a>
                                            </span>
                                        </div>
                                    </li>
                                    <?php $i++ ?>
                                     <?php } ?>
                                    
                                   
                                </ul>
                            </section>
                            <div class="clear"></div>
                            <div class="spacer"></div>
                            <div class="row ">
                                <div class="span5 ">
                                    <section class="lazy-load-box effect-fade" >
                                        <h2>Tin tức mới</h2>
                                        <ul class="recent-posts list_2 unstyled">
                                             <?php foreach ($newsList->items as $n) { ?>
                                            <li class="recent-posts_li">
                                                <figure class="thumbnail featured-thumbnail">
                                                    <a href="/tin-tuc/<?php echo $n->menu_id; ?>/<?php echo $n->getSEOCate(); ?>/<?php echo $n->content_id; ?>/<?php echo $n->getSEOTitle(); ?>/" title="<?php echo $n->title; ?>">
                                                        <img width="143" height="101" src="<?php echo $n->img_url; ?>" alt="<?php echo $n->title; ?>">
                                                    </a>
                                                </figure>
                                                <div class="inner">
                                                    <h5>
                                                        <a href="/tin-tuc/<?php echo $n->menu_id; ?>/<?php echo $n->getSEOCate(); ?>/<?php echo $n->content_id; ?>/<?php echo $n->getSEOTitle(); ?>/" title="<?php echo $n->title; ?>">                                                              <?php echo $n->title; ?>
                                                        </a>
                                                    </h5>
                                                    <div class="excerpt">
                                                        <a href="/tin-tuc/<?php echo $n->menu_id; ?>/<?php echo $n->getSEOCate(); ?>/<?php echo $n->content_id; ?>/<?php echo $n->getSEOTitle(); ?>/" >
                                                            <?php echo $n->description; ?> 
                                                        </a>
                                                    </div>
                                                    <span class="meta">
                                                        <span class="post-date"><?php echo date('Y-m-d H:i', time()); ?></span>
                                                        <span class="post-comments">
                                                            <?php echo $n->total_view; ?>
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="clear"></div>
                                            
                                            </li>
                                             <?php } ?>
                                        </ul>
                                    </section>
                                    <section class="lazy-load-box effect-fade" >
                                        <a href="/tin-tuc" title="Tất cả" class="btn btn-primary btn-normal btn-inline " target="_self">Tất cả</a>
                                    </section>
                                </div>
                                <div class="span3 ">
                                     <h2>Dịch vụ</h2>
                                     <?php foreach ($serviceList->items as $r) { ?>
                                        <section class="lazy-load-box effect-fade" >
                                            <div class="banner-wrap ">
                                                <figure class="featured-thumbnail">
                                                    <a href="/dich-vu/<?php echo $r->menu_id; ?>/<?php echo $r->getSEOCate(); ?>/" title="<?php echo $r->title; ?>">
                                                        <img src="<?php echo $r->img_url; ?>" title="<?php echo $r->title; ?>" alt="<?php echo $r->title; ?>">
                                                    </a>
                                                </figure>
                                                <p><?php echo $r->title; ?></p>
                                            </div>
                                        </section>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="span4 ">
                            <section class="lazy-load-box effect-fade" >
                                <h2>Video nổi bật</h2>
                            </section>
                            <section class="lazy-load-box effect-fade" >
                                <ul class="recent-posts list_3 unstyled">
                                    
                                      <?php foreach ($videoList->items as $v) { ?>
                                    <li class="recent-posts_li format-video clearfix">
                                        <figure class="thumbnail featured-thumbnail">
                                            <a href="/video/<?php echo $v->menu_id; ?>/<?php echo $v->getSEOCate(); ?>/<?php echo $v->content_id; ?>/<?php echo $v->getSEOTitle(); ?>/" title="<?php echo $v->title; ?>"><img src="<?php echo $v->img_url; ?>" alt="<?php echo $v->title; ?>"></a>
                                        </figure>
                                        <div class="inner">
                                            <span class="post_category">
                                                <a href="/video/<?php echo $v->menu_id; ?>/<?php echo $v->getSEOCate(); ?>/<?php echo $v->content_id; ?>/<?php echo $v->getSEOTitle(); ?>/" title="<?php echo $v->title; ?>"><?php echo $v->title; ?></a>
                                            </span>
                                            <h5><a href="/video/<?php echo $v->menu_id; ?>/<?php echo $v->getSEOCate(); ?>/<?php echo $v->content_id; ?>/<?php echo $v->getSEOTitle(); ?>/" title="<?php echo $v->description; ?>"><?php echo $v->description; ?></a></h5>
                                            <div class="excerpt">
                                                <a href="/video/<?php echo $v->menu_id; ?>/<?php echo $v->getSEOCate(); ?>/<?php echo $v->content_id; ?>/<?php echo $v->getSEOTitle(); ?>/" title="<?php echo $v->description; ?>"> 
                                                    <?php echo $v->description; ?>
                                                </a>
                                            </div>
                                            <span class="meta">
                                                <span class="post-date"><?php echo date('Y-m-d H:i', time()); ?></span>
                                                <span class="post-comments">
                                                    <?php echo $v->total_view; ?>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="clear"></div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </section>
                           
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>