<?php
namespace Darklooks\Admin\Templates;
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

class Image_Settings extends \Darklooks\Admin\Inc\Controller_Base {

    public function getTitle() {
        return esc_html__( 'Image Settings', 'darklooks' );
    }

    public function getIcon() {
        return DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/setting-icon-6.svg';
    }

    public function registerControls() {
        // Section Header
        $this->header();
        $this->getMediaUploadController([
            'title'     => esc_html__( 'Light Mode Site Logo', 'darklooks' ),
            'sub_title' => esc_html__( 'Set light mode site logo.', 'darklooks' ),
            'name'      => 'light_site_logo'
        ]);
        $this->getMediaUploadController([
            'title'     => esc_html__( 'Dark Mode Site Logo', 'darklooks' ),
            'sub_title' => esc_html__( 'Set dark mode site logo.', 'darklooks' ),
            'name'      => 'dark_site_logo'
        ]);
        $this->getImageRepeaterController([
            'title'     => esc_html__( 'Dark Mode Site Logo', 'darklooks' ),
            'sub_title' => esc_html__( 'Set dark mode site logo.', 'darklooks' ),
            'field_name_one'      => 'light_img_url',
            'field_name_two'      => 'dark_img_url'
        ]);
        $this->getSliderController([
            'title'     => esc_html__( 'Dark Mode Image Opacity', 'darklooks' ),
            'sub_title' => esc_html__( 'Set dark mode image opacity.', 'darklooks' ),
            'name'      => 'img_dark_opacity',
            'step'       => '0.1',
            'min'       => '0',
            'max'       => '1'
        ]);
        // Section Footer
        $this->footer();
    }
	

}

$obj = new Image_Settings();