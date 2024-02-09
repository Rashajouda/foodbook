<?php
namespace Darklooks\Admin;

/**
 * Darklooks admin class
 *
 * @package     Darklooks
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

if( !defined( 'WPINC' ) ) {
    die;
}

class Admin_Template {
    
    private static function settingsSectionList() {
        return [
            [
                'name' => esc_html__( 'General Setting', 'darklooks' ),
                'icon' => 'img/icons/icon2.svg',
                'is_active' => 'active',
                'selector' => 'general_setting'

            ],
            [
                'name' => esc_html__( 'Advance Setting', 'darklooks' ),
                'icon' => 'img/icons/icon4.svg',
                'is_active' => '',
                'selector' => 'advance_setting'

            ],
            [
                'name' => esc_html__( 'Switch Setting', 'darklooks' ),
                'icon' => 'img/icons/icon3.svg',
                'is_active' => '',
                'selector' => 'switch_setting'

            ],
            [
                'name' => esc_html__( 'Color Preset', 'darklooks' ),
                'icon' => 'img/icons/icon5.svg',
                'is_active' => '',
                'selector' => 'color_preset'

            ],
            [
                'name' => esc_html__( 'Image Settings', 'darklooks' ),
                'icon' => 'img/icons/icon6.svg',
                'is_active' => '',
                'selector' => 'image_settings'

            ],
            [
                'name' => esc_html__( 'Time Based', 'darklooks' ),
                'icon' => 'img/icons/icon7.svg',
                'is_active' => '',
                'selector' => 'time_based'

            ],
            [
                'name' => esc_html__( 'Custom CSS', 'darklooks' ),
                'icon' => 'img/icons/icon3.svg',
                'is_active' => '',
                'selector' => 'custom_css'

            ]
        ];
    }

    public static function getForm() {
        ?>
        <!-- Main Wrapper -->
        <form class="darklooks-admin-form" method="post" action="options.php">
        <div class="dl-main-wrapper">
            <!-- Admin Menu Wrap -->
            <div class="dl-adminmenuwrap">
                <?php 
                settings_fields( 'darklooks-settings-group' ); 
                do_settings_sections( 'darklooks-settings-group' );
                // Logo
                self::getHeaderLogo(); 
                // Tabs
                self::getTabs();
                ?>
            </div>
            <!-- End Admin Menu Wrap -->

            <!-- DarkLooks Main Content -->
            <div class="dl-main-content">
                <!-- Tab Content -->
                <div class="dl-tab-content">
                    <?php 
                    self::getTabContent();
                    ?>
                </div>
                <!-- End Tab Content -->
            </div>
            <!-- End DarkLooks Main Content -->
        </div>
        <!-- End Main Wrapper -->
        </form>
        <?php
    }

    public static function getHeaderLogo() {
        echo '<div class="dl-adminmenu-header">
            <div class="logo"><img src="'.DARKLOOKS_DIR_ADMIN_ASSETS.'img/logo.svg" alt="'.esc_html__( 'darklooks logo', 'darklooks' ).'"></div>
            <div class="dl-menu-button"><span></span></div>
        </div>';
    }

    public static function getTabs() {
        $dirUrl = DARKLOOKS_DIR_ADMIN_ASSETS;
        echo '<ul class="dl-adminmenu dl-tab-btn">';
            foreach( self::settingsSectionList() as $item ) {
                echo '<li data-tab-select="'.esc_attr( $item['selector'] ).'" class="'.esc_attr( $item['is_active'] ).'"><img src="'.esc_url( $dirUrl.$item['icon'] ).'">'.esc_html( $item['name'] ).'</li>';
            }       
        echo '</ul>';
    }

    public static function getTabContent() {
        $dirUrl = DARKLOOKS_DIR_ADMIN_ASSETS;
        echo '<div class="dl-tab-content">';
            foreach( self::settingsSectionList() as $item ) {
                $fileName = str_replace( ' ', '_', $item['name'] );
                echo '<div data-tab="'.esc_attr( $item['selector'] ).'">';
                    require_once DARKLOOKS_DIR_ADMIN.'tab-templates/'.$fileName.'.php';
                echo '</div>';
            }
        echo '</div>';
    }

}