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

class Custom_Css extends \Darklooks\Admin\Inc\Controller_Base {

    public function getTitle() {
        return esc_html__( 'Custom CSS', 'darklooks' );
    }

    public function getIcon() {
        return DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/setting-icon-3.svg';
    }

    public function registerControls() {
        // Section Header
        $this->header();
        $this->getCssEditorController([
            'title'     => esc_html__( 'CSS', 'darklooks' ),
            'sub_title' => esc_html__( 'Add your custom css.', 'darklooks' ),
            'name'      => 'darklooks_custom_css'
        ]);
        // Section Footer
        $this->footer();
    }
	

}

$obj = new Custom_Css();