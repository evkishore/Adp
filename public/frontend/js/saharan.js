/*
Template Name: Saharan
Author: http://bootexperts.com/
Version: 1.0
*/

(function($) {
    "use strict";
	
		//Tool-tips
		function parveztip(element, content) {
			if (content == 'html') {
				var tipText = element.html();
			} else {
				var tipText = element.attr('title');
			}
			element.on('mouseover', function() {
				if ($('.parveztip').length == 0) {
					element.before('<span class="parveztip">' + tipText + '</span>');

					var tipWidth = $('.parveztip').outerWidth();
					var tipPush = -(tipWidth / 2 - element.outerWidth() / 2);
					$('.parveztip').css('margin-left', tipPush);
				}
			});
			element.on('mouseleave', function() {
				$('.parveztip').remove();
			});
		}
	
        $('.digital-categories,.furniture-categories,.glass-categories').ntm();

        //Mobile Menu
        var mobileMenuWrapper = $('.mobile-menu-container');
        mobileMenuWrapper.find('.children-menu').each(function() {
            var linkItem = $(this).find('a').first();
            linkItem.after('<i class="fa fa-plus"></i>');
        });
        //calculate the init height of menu
        var totalMenuLevelFirst = $('.mobile-menu-container > ul.nav-menu > li').length;
        var mobileMenuH = totalMenuLevelFirst * 40 + 10; //40 is height of one item, 10 is padding-top + padding-bottom;

        $('.mbmenu-toggler').on('click', function(event) {
            if (mobileMenuWrapper.hasClass('open')) {
                mobileMenuWrapper.removeClass('open');
                mobileMenuWrapper.animate({
                    'height': 0
                }, 'fast');
            } else {
                mobileMenuWrapper.addClass('open');
                mobileMenuWrapper.animate({
                    'height': mobileMenuH
                }, 'fast');
            }
        });
        //set the height of all li.children-menu items
        $('.mobile-menu-container li.children-menu').each(function() {
            $(this).css({
                'height': 40,
                'overflow': 'hidden'
            });
        });
        //process the parent items
        $('.mobile-menu-container li.children-menu').each(function() {
            var parentLi = $(this);
            var dropdownUl = parentLi.find('ul.sub-menu').first();

            parentLi.find('.fa').first().bind('click', function() {
                //set height is auto for all parents dropdown
                parentLi.parents('li.children-menu').css('height', 'auto');
                //set height is auto for menu wrapper
                mobileMenuWrapper.css({
                    'height': 'auto'
                });

                var dropdownUlheight = dropdownUl.outerHeight() + 40;

                if (parentLi.hasClass('opensubmenu')) {
                    parentLi.removeClass('opensubmenu');
                    parentLi.animate({
                        'height': 40
                    }, 'fast', function() {
                        //calculate new height of menu wrapper
                        mobileMenuH = mobileMenuWrapper.outerHeight();
                    });
                    parentLi.find('.fa').first().removeClass('fa-minus');
                    parentLi.find('.fa').first().addClass('fa-plus');
                } else {
                    parentLi.addClass('opensubmenu');
                    parentLi.animate({
                        'height': dropdownUlheight
                    }, 'fast', function() {
                        //calculate new height of menu wrapper
                        mobileMenuH = mobileMenuWrapper.outerHeight();
                    });
                    parentLi.find('.fa').first().addClass('fa-minus');
                    parentLi.find('.fa').first().removeClass('fa-plus');
                }

            });
        });

        //Mini Cart
        if ($(window).width() > 1024) {
            $('.widget_shopping_cart').on('mouseover', function() {
                var mCartHeight = $('.mini_cart_inner').outerHeight();
                var cCartHeight = $('.mini_cart_content').outerHeight();
                if (cCartHeight < mCartHeight) {
                    $('.mini_cart_content').stop(true, false).animate({
                        'height': mCartHeight
                    });
                }
            });
            $('.widget_shopping_cart').on('mouseleave', function() {
                $('.mini_cart_content').animate({
                    'height': '0'
                });
            });
        }
        //For tablet & mobile
        $('.widget_shopping_cart').on('click', function(event) {
            if ($(window).width() < 1025) {
                var closed = false;
                var mCartHeight = $('.mini_cart_inner').outerHeight();
                var mCartToggler = $('.cart-toggler');
                if ($('.mini_cart_content').height() == 0) {
                    closed = true;
                }
                if (mCartToggler.is(event.target) || mCartToggler.has(event.target).length != 0 || mCartToggler.is(event.target)) {
                    event.preventDefault();
                    if (closed) {
                        $('.mini_cart_content').animate({
                            'height': mCartHeight
                        });
                        closed = false;
                    } else {
                        $('.mini_cart_content').animate({
                            'height': '0'
                        }, function() {
                            closed = true;
                        });
                    }
                }
            }
        });

        // Shop toolbar sort
        $('.toolbar .orderby').chosen({
            disable_search: true,
            width: "auto"
        });

        //currency switcher
        $('.wcml_currency_switcher').chosen({
            disable_search: true,
            width: "auto"
        });

        //toplink 
        $('.top-menu .icon').on('click', function() {
            if ($('.menu-top-menu-container').hasClass('show')) {
                $('.menu-top-menu-container').removeClass('show');
            } else {
                $('.menu-top-menu-container').addClass('show');
            }
        });

        //Header Search by category
        var cateToggler = $('.cate-toggler');
        cateToggler.on('click', function() {
            $('.header-search .product-categories').toggleClass('open');
        });

        //Vertical 
        $('.collapse-menu .menu li.children-menu > a').each(function() {
            $(this).after('<i class="fa fa-plus"></i>');
        });

        $('.collapse-menu .menu li.children-menu .fa').on('click', function() {
            if ($(this).hasClass('fa-plus')) {
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
            } else {
                if ($(this).hasClass('fa-minus')) {
                    $(this).removeClass('fa-minus');
                    $(this).addClass('fa-plus');
                }
            }
        });

        $('.collapse-menu .menu li.children-menu > .fa').each(function() {
            $(this).on('click', function() {
                var element = $(this).parent('li');

                if (element.hasClass('open')) {
                    element.removeClass('open');
                    element.find('li').removeClass('open');
                    element.find('ul').slideUp();
                } else {
                    element.addClass('open');
                    element.children('ul').slideDown();
                    element.siblings('li').children('ul').slideUp();
                    element.siblings('li').removeClass('open');
                    element.siblings('li').find('li').removeClass('open');
                    element.siblings('li').find('ul').slideUp();
                }
            });
        });
        //end - vertical menu


        //Tooltip
        $('.yith-wcwl-add-to-wishlist a').each(function() {
            parveztip($(this), 'html');
        });
        $('.compare-button a').each(function() {
            parveztip($(this), 'html');
        });
        $('.add_to_cart_inline a').each(function() {
            parveztip($(this), 'html');
        });
        $('.quickviewbtn a').each(function() {
            parveztip($(this), 'html');
        });
        $('.yith-wcwl-add-to-wishlist a').each(function() {
            parveztip($(this), 'html');
        });
        $('.footer .social-icons a').each(function() {
            parveztip($(this), 'title');
        });

        //Latest posts carousel
        $('.latest-posts .parvez_wrapper > h3').each(function() {
            var pwidgetTitle = $(this).html();
            $(this).html('<span>' + pwidgetTitle + '</span>');
        });

        //Products & Brands carousel & Latest posts carousel
        $('.home-tabs-f4 .shop-products, #shop-products-4-1, #shop-products-4-2, #shop-products-4-3, #shop-products-4-4, #brands-carousel-4, .digital .shop-products, .home-tabs-layout1 .shop-products, #posts-carousel-1, .home-tabs-f7 .shop-products').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            speed: 500,
            easing: 'linear',
            swipeToSlide: true,
            autoplaySpeed: 1000,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });

        //Products Carousel
        $('#brands-carousel-5, #brands-carousel-1, #sale_products_digital, .home-tabs-f11 .shop-products, #shop-products-5, #shop-products-2-5').slick({
            infinite: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            speed: 500,
            easing: 'linear',
            swipeToSlide: true,
            autoplaySpeed: 1000,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });

        //Products Carousel
        $('#featureds_pdct, .home-tabs-f5 .shop-products, .home-tabs-f10 .shop-products, #brands_carousel_6slide, .home-tabs-food .shop-products').slick({
            infinite: false,
            slidesToShow: 6,
            slidesToScroll: 1,
            speed: 500,
            easing: 'linear',
            swipeToSlide: true,
            autoplaySpeed: 1000,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });

        //Products Carousel
        $('#posts-carousel-2, #hot-deal-slide2').slick({
            infinite: false,
            slidesToShow: 2,
            slidesToScroll: 1,
            speed: 1000,
            easing: 'linear',
            swipeToSlide: true,
            autoplaySpeed: 3000,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });

        //Products carousel
        $('.home-tabs-glass .shop-products, #shop-products-accessories, #shop-products-kids, #featured_products_digital, #new_products_digital_slide3, .digital3 .shop-products, #posts-carousel-3, .latest_products .shop-products').slick({
            arrows: true,
            dots: false,
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            speed: 500,
            easing: 'linear',
            autoplay: false,
            swipeToSlide: true,
            autoplaySpeed: 3000,
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

        //Testimonials carousel
        $('#testimonials-list-1').slick({
            arrows: false,
            dots: true,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 500,
            easing: 'linear',
            autoplay: true,
            swipeToSlide: true,
            autoplaySpeed: 3000
        });

        //Products carousel
        $('#new_product').slick({
            arrows: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 500,
            easing: 'linear',
            autoplay: true,
            swipeToSlide: true,
            autoplaySpeed: 3000
        });

        //Latest posts carousel - layout 4
        $('#posts-carousel-digital, #hot-deals-slide1, #testimonials-list-digital,.latest_post .posts-carousel').slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 500,
            easing: 'linear',
            autoplay: false,
            swipeToSlide: true,
            autoplaySpeed: 3000,
        });

        /*thumbnails carousel*/
        $('.quick-thumbnails').slick({
            slidesToScroll: 1,
            slidesToShow: 4,
            arrows: false,
            dots: true
        });

        /*thumbnail click*/
        $('.quick-thumbnails a').each(function() {
            var quickThumb = $(this);
            var quickImgSrc = quickThumb.attr('href');
            quickThumb.on('click', function(event) {
                event.preventDefault();
                $('.main-image').find('img').attr('src', quickImgSrc);
            });
        });

        //Go to top
        $('#back-top').on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, "slow");
        });

        //Category view mode
        $('.view-mode').each(function() {
            $(this).find('.grid').on('click', function(event) {
                event.preventDefault();

                $('.view-mode').find('.grid').addClass('active');
                $('.view-mode').find('.list').removeClass('active');

                $('.shop-products').removeClass('list-view');
                $('.shop-products').addClass('grid-view');

                $('.list-col4').removeClass('col-xs-12 col-sm-4');
                $('.list-col8').removeClass('col-xs-12 col-sm-8');
            });
            $(this).find('.list').on('click', function(event) {
                event.preventDefault();

                $('.view-mode').find('.list').addClass('active');
                $('.view-mode').find('.grid').removeClass('active');

                $('.shop-products').addClass('list-view');
                $('.shop-products').removeClass('grid-view');

                $('.list-col4').addClass('col-xs-12 col-sm-4');
                $('.list-col8').addClass('col-xs-12 col-sm-8');
            });
        });

        //Product images on details page
        $('.single-images').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            fade: true,
            asNavFor: '.single-thumbnails'
        });
        $('.single-thumbnails').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.single-images',
            arrows: true,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            infinite: true
        });

        //Tab jQuary
        $('.parveztabs li').each(function() {
            $(this).on('click', function() {
                var tabRel = $(this).attr('rel');

                $('.parveztabs .tab').removeClass('active');
                $(this).addClass('active');

                $('.widget_road_widgets').removeClass('active');
                $('#' + tabRel).addClass('active');

                $('.panel').removeClass('active');
                $('#' + tabRel).addClass('active');
            });
        });

        //Count down
        $('.countbox.hastime').each(function() {
            var countTime = $(this).attr('data-time');

            $(this).countdown(countTime, function(event) {
                $(this).html(
                    '<span class="timebox day"><strong>' + event.strftime('%D') + '</strong>days</span><span class="timebox hour"><strong>' + event.strftime('%H') + '</strong>hrs</span><span class="timebox minute"><strong>' + event.strftime('%M') + '</strong>mins</span><span class="timebox second"><strong>' + event.strftime('%S') + '</strong>secs</span>'
                );
            });
            //$(this).countdown('stop');
        });

        //Count down 2
        $('.countbox1.hastime').each(function() {
            var countTime = $(this).attr('data-time');

            $(this).countdown(countTime, function(event) {
                $(this).html(
                    '<span class="timebox day"><span class="timebox-inner"><strong>' + event.strftime('%D') + '</strong>days</span></span> <span class="timebox hour"><span class="timebox-inner"><strong>' + event.strftime('%H') + '</strong>hrs</span></span> <span class="timebox minute"><span class="timebox-inner"><strong>' + event.strftime('%M') + '</strong>mins</span></span> <span class="timebox second"><span class="timebox-inner"><strong>' + event.strftime('%S') + '</strong>secs</span></span>'
                );
            });
            //$(this).countdown('stop');
        });

        //Checkout Page Login
        $('.showlogin').on('click', function() {
            $('#checkoutlogin').toggleClass('checkout-login', 700, 'easeOutSine');
        });

        //Checkout Page Coupon
        $('.showcoupon').on('click', function() {
            $('#checkoutcoupon').toggleClass('checkoutcoupon', 600, 'easeOutSine');
        });

        //Shop toolbar sorting
        $('.toolbar .orderby').chosen({
            disable_search: true,
            width: "auto"
        });

        //Modal
        $('#productModal').on('shown.bs.modal');
		
        //PrettyPhoto
        $("area[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal'});

        $(".gallery:first a[data-gal^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'light_square',
            slideshow: 3000,
            autoplay_slideshow: false
        });
        $(".gallery:gt(0) a[data-gal^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            slideshow: 10000,
            hideflash: true
        });

        //Price Slider / UI jQuary Slider
        $('#slider-range').slider({
            range: true,
            min: 45,
            max: 515,
            values: [45, 515],
            slide: function(event, ui) {
                $("#amount").val("£" + ui.values[0] + " - £" + ui.values[1]);
            }
        });
        $("#amount").val("£" + $("#slider-range").slider("values", 0) +
            " — £" + $("#slider-range").slider("values", 1));


    // Scroll
    var currentP = 0;
    $(window).on('scroll', function() {
        var headerH = $('.header-container').height();
        var navH = $('.nav-container').height();
        headerH += navH;
        var scrollP = $(window).scrollTop();
        if ($(window).width() > 1024) {
            if (scrollP != currentP) {
                //Back to top
                if (scrollP >= headerH) {
                    $('#back-top').addClass('show');
                    $('.nav-container').addClass('ontop');
                } else {
                    $('#back-top').removeClass('show');
                    $('.nav-container').removeClass('ontop');
                }
                currentP = $(window).scrollTop();
            }
        }
    });

})(jQuery);