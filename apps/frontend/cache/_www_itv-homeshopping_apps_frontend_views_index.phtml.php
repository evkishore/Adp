<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TV Channel | The best movies and videos</title>
    <meta name="description" content=" | The best movies and videos">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <?php echo $this->assets->outputCss('css'); ?>
    <style type="text/css">
        .cf-hidden {
            display: none;
        }
        
        .cf-invisible {
            visibility: hidden;
        }
    </style>
    <?php echo $this->assets->outputJs('js-header'); ?>

    <!--[if lt IE 8]>
	<div style=' clear: both; text-align:center; position: relative;'>
		<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
	</div>
	<![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="/frontend/js/jquery.mobile.customized.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(function () {
            jQuery('.sf-menu').mobileMenu({
                defaultText: "Menu..."
            });
        });
    </script>
    <!--<![endif]-->
    <script type="text/javascript">
        // Init navigation menu
        jQuery(function () {
            // main navigation init
            jQuery('ul.sf-menu').superfish({
                delay: 1000, // the delay in milliseconds that the mouse can remain outside a sub-menu without it closing
                animation: {
                    opacity: "show",
                    height: "show"
                }, // used to animate the sub-menu open
                speed: "normal", // animation speed
                autoArrows: false, // generation of arrow mark-up (for submenu)
                disableHI: true // to disable hoverIntent detection
            });

            //Zoom fix
            //IPad/IPhone
            var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
                ua = navigator.userAgent,
                gestureStart = function () {
                    viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0";
                },
                scaleFix = function () {
                    if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
                        viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
                        document.addEventListener("gesturestart", gestureStart, false);
                    }
                };
            scaleFix();
        })
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            if (!device.mobile() && !device.tablet()) {
                jQuery('.header .nav__primary').tmStickUp({
                    correctionSelector: jQuery('#wpadminbar'),
                    listenSelector: jQuery('.listenSelector'),
                    active: false,
                    pseudo: true
                });
            }
            $(function () {
                var url = location.pathname;
                var aUrl = url.split('/')[1];
                
                if (aUrl == '') {
                    $('#topnav li').removeClass('current-menu-item current_page_item');
                    $('#topnav li:first').addClass('current-menu-item current_page_item');
                } else {
                    $('#topnav li').removeClass('current-menu-item current_page_item');
                    if(aUrl=='dich-vu'){
                        $('#menu-item-3').addClass('current-menu-item current_page_item');
                    }else{
                        $('#topnav li a[href="/' + aUrl + '"]').parent().addClass('current-menu-item current_page_item');
                    }
                    
                }
            });
        })
    </script>
    <style type="text/css">
        @media(max-width: 767px) {
            .sf-menu {
                display: none;
            }
            .select-menu {
                display: block;
            }
        }
    </style>
</head>
<body class="home page page-template page-template-page-home-php">
    <div id="motopress-main" class="main-holder">
        <header class="motopress-wrapper header">
            <?php echo $this->partial('header'); ?>
        </header>
        <div class="motopress-wrapper content-holder clearfix">
            <div class="container">
                <?php echo $this->getContent(); ?>
            </div>
            <footer class="motopress-wrapper footer">
                <?php echo $this->partial('footer'); ?>
            </footer>
        </div>
        <div id="back-top-wrapper" class="visible-desktop">
            <p id="back-top" style="display: none;">
                <a href="#"><span></span></a> 
            </p>
        </div>
        <?php echo $this->assets->outputJs('js-footer'); ?>
</body>
</html>