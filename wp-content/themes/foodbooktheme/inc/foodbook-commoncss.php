<?php
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit( );
    }
    /**
    * @Packge     : foodbook
    * @Version    : 1.0
    * @Author     : ThemeLooks
    * @Author URI : https://www.themelooks.com/
    *
    */
    // enqueue css
    function foodbook_common_custom_css(){
        wp_enqueue_style( 'foodbook-color-schemes', esc_url( get_template_directory_uri() ).'/assets/css/color.schemes.css' );
    	$foodbook_theme_color                     = foodbook_opt( 'foodbook_unlimited_color' );
    	$foodbook_css_editor                      = foodbook_opt( 'foodbook_css_editor' );
    	$foodbook_back_to_top_icon_opacity        = foodbook_opt( 'foodbook_backtotop_icon_background_opacity' );
    	$foodbook_coming_soon_placeholder_color   = foodbook_opt( 'foodbook_coming_soon_form_placeholder_color' );
    	$foodbook_404_placeholder_color           = foodbook_opt( 'foodbook_404_form_placeholder_color' );
    	$customcss = "";

    	if( foodbook_meta( 'global_style' ) == 'single' && is_page() ){
            if( !empty( foodbook_meta( 'page_header_bg' ) ) ){
                $foodbook_header_bg = foodbook_meta( 'page_header_bg' );
            }
    		$pagehederbgcolor 		= foodbook_meta( 'page_header_bg_color' );

            if( foodbook_meta( 'page_header_bg_repeat' ) == 'norepeat' ){
                $pagehederbgrepeat = 'no-repeat';
            }elseif( foodbook_meta( 'page_header_bg_repeat' ) == 'repeatall' ){
                $pagehederbgrepeat = 'repeat-all';
            }elseif( foodbook_meta( 'page_header_bg_repeat' ) == 'repeathor' ){
                $pagehederbgrepeat = 'repeat-x';
            }elseif( foodbook_meta( 'page_header_bg_repeat' ) == 'repeatver' ){
                $pagehederbgrepeat = 'repeat-y';
            }elseif( foodbook_meta( 'page_header_bg_repeat' ) == 'inherit' ){
                $pagehederbgrepeat = 'inherit';
            }else{
                $pagehederbgrepeat = '';
            }

            if( foodbook_meta( 'page_header_bg_size' ) == 'inherit' ){
                $pagehederbgsize = 'inherit';
            }elseif( foodbook_meta( 'page_header_bg_size' ) == 'cover' ){
                $pagehederbgsize = 'cover';
            }elseif( foodbook_meta( 'page_header_bg_size' ) == 'contain' ){
                $pagehederbgsize = 'contain';
            }else{
                $pagehederbgsize = '';
            }

            if( foodbook_meta( 'page_header_bg_attachment' ) == 'fixed' ){
                $pagehederbgattachment = 'fixed';
            }elseif( foodbook_meta( 'page_header_bg_attachment' ) == 'scroll' ){
                $pagehederbgattachment = 'scroll';
            }elseif( foodbook_meta( 'page_header_bg_attachment' ) == 'inherit' ){
                $pagehederbgattachment = 'inherit';
            }else{
                $pagehederbgattachment = '';
            }

    		$pagehederbgposition 	= foodbook_meta( 'page_header_bg_position' );

            if( foodbook_meta( 'page_header_bg_position' ) == 'lefttop' ){
                $pagehederbgposition = 'left top';
            }elseif( foodbook_meta( 'page_header_bg_position' ) == 'leftcenter' ){
                $pagehederbgposition = 'left center';
            }elseif( foodbook_meta( 'page_header_bg_position' ) == 'leftbottom' ){
                $pagehederbgposition = 'left bottom';
            }elseif( foodbook_meta( 'page_header_bg_position' ) == 'centertop' ){
                $pagehederbgposition = 'center top';
            }elseif( foodbook_meta( 'page_header_bg_position' ) == 'centercenter' ){
                $pagehederbgposition = 'center center';
            }elseif( foodbook_meta( 'page_header_bg_position' ) == 'centerbottom' ){
                $pagehederbgposition = 'center bottom';
            }elseif( foodbook_meta( 'page_header_bg_position' ) == 'righttop' ){
                $pagehederbgposition = 'right top';
            }elseif( foodbook_meta( 'page_header_bg_position' ) == 'rightcenter' ){
                $pagehederbgposition = 'right center';
            }elseif( foodbook_meta( 'page_header_bg_position' ) == 'rightbottom' ){
                $pagehederbgposition = 'right bottom';
            }else{
                $pagehederbgposition = '';
            }
    		$pagehedertextcolor 	= foodbook_meta( 'page_header_text_color' );
    		$pagehederbreadcolor 	= foodbook_meta( 'breadcrumb_link_color' );
    		$pagehederbreadcolorhov = foodbook_meta( 'breadcrumb_link_hover_color' );
    		$pagehederbreadcoloract = foodbook_meta( 'breadcrumb_active_color' );
    		$pagehederbreadcolordiv = foodbook_meta( 'breadcrumb_divider_color' );
    	}else{
            // Global Settings
            $foodbook_header_bg    = foodbook_opt( 'foodbook_header_bg','background-image' );
            $pagehederbgcolor 		= foodbook_opt( 'foodbook_header_bg','background-color' );
            $pagehederbgrepeat 		= foodbook_opt( 'foodbook_header_bg','background-repeat' );
            $pagehederbgsize 		= foodbook_opt( 'foodbook_header_bg','background-size' );
            $pagehederbgattachment 	= foodbook_opt( 'foodbook_header_bg','background-attachment' );
            $pagehederbgposition 	= foodbook_opt( 'foodbook_header_bg','background-position' );
    		$pagehedertextcolor 	= foodbook_opt( 'foodbook_header_text_color' );
    		$pagehederbreadcolor 	= foodbook_opt( 'foodbook_link_color' );
    		$pagehederbreadcolorhov	= foodbook_opt( 'foodbook_link_hover_color' );
    		$pagehederbreadcoloract	= foodbook_opt( 'foodbook_active_color' );
    		$pagehederbreadcolordiv	= foodbook_opt( 'foodbook_divider_color' );
        }

        if( !empty( $foodbook_header_bg ) ){
    		$customcss .= ".page-title-bg{
	        	background-image:url('{$foodbook_header_bg}');
        	}";
    	}
		if( !empty( $pagehederbgcolor ) ){
    		$customcss .= ".page-title-bg{
	        	background-color:{$pagehederbgcolor};
        	}";
    	}
		if( !empty( $pagehederbgrepeat ) ){
    		$customcss .= ".page-title-bg{
	        	background-repeat:{$pagehederbgrepeat};
        	}";
    	}
		if( !empty( $pagehederbgsize ) ){
    		$customcss .= ".page-title-bg{
	        	background-size:{$pagehederbgsize};
        	}";
    	}
		if( !empty( $pagehederbgattachment ) ){
    		$customcss .= ".page-title-bg{
	        	background-attachment:{$pagehederbgattachment};
        	}";
    	}
		if( !empty( $pagehederbgposition ) ){
    		$customcss .= ".page-title-bg{
	        	background-position:{$pagehederbgposition};
        	}";
    	}

		if( !empty( $pagehedertextcolor ) ){
    		$customcss .= ".page-title h2{
	        	color:{$pagehedertextcolor};
        	}";
    	}
		if( !empty( $pagehederbreadcolor ) ){
    		$customcss .= ".page-title  .list-inline #breadcrumb a{
				color:{$pagehederbreadcolor};
			}";
    	}
		if( !empty( $pagehederbreadcolorhov ) ){
    		$customcss .= ".page-title  .list-inline #breadcrumb a:hover{
				color:{$pagehederbreadcolorhov};
			}";
    	}
		if( !empty( $pagehederbreadcoloract ) ){
    		$customcss .= ".page-title  .list-inline li.active{
				color:{$pagehederbreadcoloract};
			}";
    	}
		if( !empty( $pagehederbreadcolordiv ) ){
    		$customcss .= ".page-title li:not(:last-child):after{
				color:{$pagehederbreadcolordiv};
			}";
    	}
		if( !empty( $foodbook_back_to_top_icon_opacity ) ){
    		$customcss .= ".back-to-top:hover{
				opacity:{$foodbook_back_to_top_icon_opacity};
			}";
    	}
		if( !empty( $foodbook_coming_soon_placeholder_color ) ){
    		$customcss .= ".content-coming-soon .search-form .theme-input-group input::placeholder{
				color:{$foodbook_coming_soon_placeholder_color}!important;
			}";
    	}
		if( !empty( $foodbook_404_placeholder_color ) ){
    		$customcss .= ".content404 .search-form .theme-input-group input::placeholder{
				color:{$foodbook_404_placeholder_color}!important;
			}";
    	}


        // Theme Color

        if( !empty( $foodbook_theme_color ) ){
            $customcss .= ".c1, a, h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            blockquote cite,
            .btn, .page-title ul li:not(:last-child),
            .header .header-main .main-menu #menu-button,
            .header .header-main .main-menu .nav li ul li a,
            .banner .slider-counter span {
				color:{$foodbook_theme_color} !important;
			}";
        }

        // Background Color

        if( !empty( $foodbook_theme_color ) ){
            $customcss .= ".c1-bg,
            ::-moz-selection,
            .owl-carousel button.owl-dot,
            .title-border span:first-child,
            .header .header-main .menu-trigger span,
            .header .header-main .menu-trigger span:before,
            .header .header-main .menu-trigger span:after,
            .header .header-main #menu-button span,
            .header .header-main #menu-button span:before,
            .header .header-main #menu-button span:after{
				background-color:{$foodbook_theme_color} !important;
			}";
        }

        // Border Color

        if( !empty( $foodbook_theme_color ) ){
            $customcss .= ".c1-bo{
				border-color:{$foodbook_theme_color} !important;
			}";
        }

        if( !empty( $foodbook_css_editor ) ){
            $customcss .= $foodbook_css_editor;
        }
        wp_add_inline_style( 'foodbook-color-schemes', $customcss );

    }
    add_action( 'wp_enqueue_scripts', 'foodbook_common_custom_css', 50 );