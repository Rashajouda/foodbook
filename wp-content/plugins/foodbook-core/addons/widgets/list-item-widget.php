<?php
/**
 *
 * List Item Widget .
 *
 */
class List_Item_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'sfoodbooklistitem';
	}

	public function get_title() {
		return __( 'List Item', 'foodbook' );
	}


	public function get_icon() {
		return 'eicon-bullet-list';
    }


	public function get_categories() {
		return [ 'foodbook' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'list_item_section',
			[
				'label' => __( 'List Item', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_item', [
				'label' => __( 'Item', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Item description' , 'foodbook' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'list_items',
			[
				'label' => __( 'Items', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_item' => __( 'Item description #1', 'foodbook' ),
					],
				],
				'title_field' => '{{{ list_item }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'general_style_section',
			[
				'label' => __( 'General', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'check_color',
			[
				'label' => __( 'Check Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-check li:after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'check_bg_color',
			[
				'label' => __( 'Check Background Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-check li:before' => 'background-color: {{VALUE}}',
				],
			]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'list_item_style_section',
			[
				'label' => __( 'Item', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_item_color',
			[
				'label' => __( 'List Item Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-check li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list_item_typography',
				'label' => __( 'List Item Typography', 'foodbook' ),
				'selector' => '{{WRAPPER}} .list-check li',
			]
        );

        $this->add_responsive_control(
			'list_item_margin',
			[
				'label' => __( 'List Item Margin', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .list-check li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'list_item_padding',
			[
				'label' => __( 'List Item Padding', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .list-check li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
        if( !empty( $settings['list_items'] ) && is_array( $settings['list_items'] ) ) {
            echo '<ul class="list-check">';
                foreach( $settings['list_items'] as $singleitem ) {
                    echo '<li>'.wp_kses_post($singleitem['list_item']).'</li>';
                }
            echo '</ul>';
        }
	}

}