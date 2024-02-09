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

    $foodbook_title_breadcrumb_align = "";

    if( foodbook_meta( 'global_style' ) == 'single' && is_page() ){
        if( foodbook_meta( 'content_align' ) == 'left' ){
            $foodbook_title_breadcrumb_align = 'text-left';
        }elseif( foodbook_meta( 'content_align' ) == 'center'  ){
            $foodbook_title_breadcrumb_align = 'text-center';
        }else{
            $foodbook_title_breadcrumb_align = 'text-right';
        }
    }elseif( class_exists( 'ReduxFramework' ) ){
        if( foodbook_opt( 'foodbook_header_content_alignment' ) == 'left' ){
            $foodbook_title_breadcrumb_align = 'text-left';
        }elseif( foodbook_opt( 'foodbook_header_content_alignment' ) == 'center'  ){
            $foodbook_title_breadcrumb_align = 'text-center';
        }else{
            $foodbook_title_breadcrumb_align = 'text-right';
        }
    }else{
        $foodbook_title_breadcrumb_align = 'text-center';
    }

    if( foodbook_opt( 'foodbook_overlay_show_hide' ) ){
        $foodbook_page_overlay = 'page-title-bg-overlay';
    }else{
        $foodbook_page_overlay = '';
    }


?>

<!-- Page Title Begin -->
<section class="pt-140 pb-140 page-title-bg <?php echo esc_attr( $foodbook_page_overlay );?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title <?php echo esc_attr( $foodbook_title_breadcrumb_align );?>">
                    <?php
                        if( foodbook_meta( 'global_style' ) == 'single' && is_page() ){
                            if( foodbook_meta( 'page_header_show_hide' ) == '1' ){
                                echo foodbook_page_banner_header();
                            }
                        }elseif( class_exists( 'ReduxFramework' ) ){
                            if( foodbook_opt( 'foodbook_header_text_show_hide' ) == true ){
                                echo foodbook_page_banner_header();
                            }
                        }else{
                            echo foodbook_page_banner_header();
                        }
                    ?>
                    <ul class="list-inline">
                        <?php
                            if( foodbook_meta( 'global_style' ) == 'single' && is_page() ){
                                if( foodbook_meta( 'breadcrumb_enable' ) == '1' ){
                                    echo foodbook_breadcrumb();
                                }
                            }elseif( class_exists( 'ReduxFramework' ) ){
                                if( foodbook_opt( 'foodbook_enable_bread' ) == '1' ){
                                    echo foodbook_breadcrumb();
                                }
                            }else{
                                echo foodbook_breadcrumb();
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->