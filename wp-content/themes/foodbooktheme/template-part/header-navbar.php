<?php
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit( );
    }
    /**
    * @Packge     : Foodbook
    * @Version    : 1.0
    * @Author     : ThemeLooks
    * @Author URI : https://www.themelooks.com/
    *
    */
?>
<?php
    if( class_exists( 'ReduxFramework' ) ){
        $header_style = foodbook_opt( 'header_style' );
    }else{
        $header_style = 'two';
    }
    if( $header_style == 'one' ):
?>
    <!-- Header -->
    <header class="header">
        <div class="header-main">
            <div class="container-fluid">
                <div class="row align-items-center main-menu-wrapper justify-content-between">

                    <div class="col order-last order-sm-first">
                        <!-- Header Menu -->
                        <?php if( has_nav_menu( 'primary-menu' ) ):?>
                        <div class="main-menu d-flex align-items-center justify-content-end justify-content-sm-start">
                            <?php
                                echo '<!-- Menu Trigger -->';
                                    echo '<div class="menu-trigger">';
                                        echo '<span></span>';
                                    echo '</div>';
                                    echo '<!-- End Menu Trigger -->';
                                    echo '<!-- Main Menu -->';
                                    echo '<div class="nav-wrapper">';
                                        wp_nav_menu(array(
                                            'theme_location'    => 'primary-menu',
                                            'container'         => '',
                                            'menu_class'        => 'nav align-items-center',
                                        ));
                                    echo '</div>';
                                echo '<!-- End Main Menu -->';
                            ?>
                        </div>
                        <?php endif;?>
                        <!-- End Header Menu -->
                    </div>
                    <div class="col text-sm-center logo-holder">
                        <!-- Logo -->
                        <?php
                            if( has_custom_logo() ) {
                                $foodbook_custom_logo_id = get_theme_mod( 'custom_logo' );
                                $foodbook_logo = wp_get_attachment_image_src( $foodbook_custom_logo_id , 'full' );
                                echo '<a href="'.home_url('/').'">'.foodbook_img_tag(array(
                                    'url'   =>  esc_url( $foodbook_logo[0] )
                                )).'</a>';
                            }else{
                                echo foodbook_theme_logo();
                            }
                        ?>
                        <!-- End Logo -->
                    </div>
                    <div class="col text-right d-none d-sm-block">
                        <!-- Social Icons -->
                        <?php
                            $foodbook_social_icon_show = foodbook_opt( 'foodbook_show_hide_social_logo' );
                            if( function_exists( 'foodbook_social_icon' ) &&  $foodbook_social_icon_show ):
                        ?>
                            <ul class="social_icon_list">
                                <?php
                                    foodbook_social_icon();
                                ?>
                            </ul>
                        <?php endif;?>
                        <!-- End Social Icons -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->
    <?php
        else:
    ?>
    <!-- Header -->
    <header class="header">
        <div class="header-main2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-sm-3 col-5 logo-holder">
                        <!-- Logo -->
                        <?php
                            if( has_custom_logo() ) {
                                $foodbook_custom_logo_id = get_theme_mod( 'custom_logo' );
                                $foodbook_logo = wp_get_attachment_image_src( $foodbook_custom_logo_id , 'full' );
                                echo '<a href="'.home_url('/').'">'.foodbook_img_tag(array(
                                    'url'   =>  esc_url( $foodbook_logo[0] )
                                )).'</a>';
                            }else{
                                echo foodbook_theme_logo();
                            }
                        ?>
                        <!-- End Logo -->
                    </div>
                    <div class="col-lg-10 col-sm-9 col-7 d-flex align-items-center justify-content-end justify-content-sm-between position-static">
                        <!-- Header Menu -->
                        <?php
                            if( has_nav_menu( 'primary-menu' ) ){
                                echo '<div class="main-menu align-items-center d-none d-lg-block">';
                                    echo '<!-- Menu Trigger -->';
                                        echo '<!-- End Menu Trigger -->';
                                        echo '<!-- Main Menu -->';
                                        echo '<div class="nav-wrapper">';
                                            wp_nav_menu(array(
                                                'theme_location'    => 'primary-menu',
                                                'container'         => '',
                                                'menu_class'        => 'nav align-items-center',
                                                'walker'            => new Foodbook_Menu_With_Description(),
                                            ));
                                        echo '</div>';
                                    echo '<!-- End Main Menu -->';
                                echo '</div>';
                            }
                            if( has_nav_menu( 'mobile-menu' ) ){
                                echo '<div id="menu-button" class="mobile_menu-button d-lg-none">';
                                    echo '<span></span>';
                                echo '</div>';
                                echo '<!-- Mobile Menu -->';
                                echo '<div id="mobile_menu" class="offcanvas-panel mobile-menu-panel d-block d-lg-none">';
                                    echo '<!-- Offcanvas Overlay -->';
                                    echo '<div class="offcanvas-overlay"></div>';
                                    echo '<!-- End Offcanvas Overlay -->';
                                    echo '<!-- Panel -->';
                                    echo '<div class="panel">';
                                        echo '<!-- Offcanvas Header -->';
                                        echo '<div class="offcanvas-header d-flex align-items-center justify-content-between">';
                                            if( ! empty( foodbook_opt( 'mobile_offcanvas_logo','url' ) ) ){
                                                echo '<!-- Offcanvs Logo -->';
                                                echo '<div class="d-flex align-items-center">';
                                                    echo '<a href="'.esc_url( foodbook_opt( 'logo_url' ) ).'">';
                                                        echo foodbook_img_tag( array(
                                                            'url'	=> esc_url( foodbook_opt( 'mobile_offcanvas_logo','url' ) ),
                                                            'class' => 'svg',
                                                        ) );
                                                    echo '</a>';
                                                echo '</div>';
                                            }
                                            echo '<!-- End Offcanvs Logo -->';
                                            echo '<!-- Offcanvas Close -->';
                                            echo '<div class="offcanvas-close">';
                                                echo '<span></span>';
                                            echo '</div>';
                                            echo '<!-- End Offcanvas Close -->';
                                        echo '</div>';
                                        echo '<!-- End Offcanvas Header -->';
                                        echo '<!-- Offcanvas Content -->';
                                        echo '<div class="offcanvas-content">';
                                            echo '<nav class="mobile_menu offcanvas-menu offcanvas-mobile">';
                                                wp_nav_menu( array(
                                                    'theme_location'    => 'mobile-menu',
                                                    'container'         => '',
                                                    'menu_class'        => '',
                                                ));
                                            echo '</nav>';
                                        echo '</div>';
                                        echo '<!-- End Offcanvas Content -->';
                                    echo '</div>';
                                    echo '<!-- End Panel -->';
                                echo '</div>';
                                echo '<!-- End Mobile Menu -->';
                            }
                        ?>
                        <div class="header-right d-flex align-items-center">

                            <!-- End Header Menu -->
                            <!-- Social Icons -->
                            <?php
                                $account_button_text    = foodbook_opt( 'account_button_text' );
                                $account_button_url     = foodbook_opt( 'account_button_url' );
                                $account_button_image   = foodbook_opt( 'account_button_image', 'url' );

                                if( ! empty( $account_button_text ) || ! empty( $account_button_image ) ){
                                    echo '<a href="'.esc_url( $account_button_url ).'" class="account">';
                                        echo foodbook_img_tag( array(
                                            'url'   => esc_url( $account_button_image ),
                                            'class' => 'svg',
                                        ) );
                                        echo '<span>'.esc_html( $account_button_text ).'</span>';
                                    echo '</a>';
                                }

                                $foodbook_social_icon_show = foodbook_opt( 'foodbook_show_hide_social_logo' );
                                if( function_exists( 'foodbook_social_icon' ) &&  $foodbook_social_icon_show ):
                            ?>
                                <ul class="social_icon_list">
                                    <?php
                                        foodbook_social_icon();
                                    ?>
                                </ul>
                            <?php endif;?>
                            <!-- End Social Icons -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php endif;?>