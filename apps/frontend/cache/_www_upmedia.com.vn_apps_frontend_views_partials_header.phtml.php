<div class="container">
    <div class="row">
        <div class="span12" >
            <div class="row">
                <div class="span6" >
                    <br>
                    <div class="logo pull-left">
                        <a href="/" class="logo_h logo_h__img"><img src="/frontend/images/logo.png" alt="TV Channel" title="The best movies and videos"></a>
                        <p class="logo_tagline">The best movies and videos</p>
                    </div>
                </div>
            </div>
            <div class="block_2">
                <div class="row">
                    <div class="span12" >
                        <nav class="nav nav__primary clearfix"><?php $this->_macros['print_menu_level'] = function($__p = null) { if (isset($__p[0])) { $menu_level_items = $__p[0]; } else { if (isset($__p["menu_level_items"])) { $menu_level_items = $__p["menu_level_items"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'print_menu_level' was called without parameter: menu_level_items");  } }  ?><?php $v158673389574306666771iterator = $menu_level_items; $v158673389574306666771incr = 0; $v158673389574306666771loop = new stdClass(); $v158673389574306666771loop->length = count($v158673389574306666771iterator); $v158673389574306666771loop->index = 1; $v158673389574306666771loop->index0 = 1; $v158673389574306666771loop->revindex = $v158673389574306666771loop->length; $v158673389574306666771loop->revindex0 = $v158673389574306666771loop->length - 1; ?><?php foreach ($v158673389574306666771iterator as $menu_item) { ?><?php $v158673389574306666771loop->first = ($v158673389574306666771incr == 0); $v158673389574306666771loop->index = $v158673389574306666771incr + 1; $v158673389574306666771loop->index0 = $v158673389574306666771incr; $v158673389574306666771loop->revindex = $v158673389574306666771loop->length - $v158673389574306666771incr; $v158673389574306666771loop->revindex0 = $v158673389574306666771loop->length - ($v158673389574306666771incr + 1); $v158673389574306666771loop->last = ($v158673389574306666771incr == ($v158673389574306666771loop->length - 1)); ?>
                                    <?php if ($v158673389574306666771loop->first) { ?>
                                        <ul id="topnav" class="sf-menu sf-js-enabled">
                                    <?php } ?>
                                    <li id="menu-item-<?php echo $menu_item->menu_id; ?>" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                                        <a href="<?php echo $menu_item->seo_url; ?>"><?php echo $menu_item->name; ?></a>
                                        <?php $next_menu_level_items = $menu_item->getChilds(); ?>
                                        <?php if ($next_menu_level_items) { ?>
                                            <?php echo $this->callMacro('print_menu_level', array($next_menu_level_items)); ?>
                                        <?php } ?>
                                    </li>
                                    <?php if ($v158673389574306666771loop->last) { ?>
                                        </ul>
                                    <?php } ?><?php $v158673389574306666771incr++; } ?><?php }; $this->_macros['print_menu_level'] = \Closure::bind($this->_macros['print_menu_level'], $this); ?>
                            <?php echo $this->callMacro('print_menu_level', array($root_menu_items)); ?>                                                       
                        </nav>
                        <div class="pseudoStickyBlock" style="position: relative; display: block;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>