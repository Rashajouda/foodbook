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

class Time_Based extends \Darklooks\Admin\Inc\Controller_Base {

    public function getTitle() {
        return esc_html__( 'Time Based', 'darklooks' );
    }

    public function getIcon() {
        return DARKLOOKS_DIR_ADMIN_ASSETS.'img/icons/setting-icon-7.svg';
    }

    public function registerControls() {
        $timeList = \Darklooks\Inc\Helper::getTimeList();
        // Section Header
        $this->header();
        $this->getSwitcherController([
            'title'     => esc_html__( 'Enable Dark Mode Based On Time', 'darklooks' ),
            'sub_title' => esc_html__( 'Turn on the dark mode automatically between the given time range.', 'darklooks' ),
            'name'      => 'enable_time_dark_mode',
        ]);
        $this->getSelectController([
            'title'     => esc_html__( 'Set Start Time', 'darklooks' ),
            'sub_title' => esc_html__( 'Set a time to start automatically dark mode on time.', 'darklooks' ),
            'name'      => 'dark_start_time',
            'options'   => $timeList
        ]);
        $this->getSelectController([
            'title'     => esc_html__( 'Set End Time', 'darklooks' ),
            'sub_title' => esc_html__( 'Set a time to stop display automatically dark mode on time.', 'darklooks' ),
            'name'      => 'dark_end_time',
            'options'   => $timeList
        ]);
        // Section Footer
        $this->footer();
    }
	

}

$obj = new Time_Based();