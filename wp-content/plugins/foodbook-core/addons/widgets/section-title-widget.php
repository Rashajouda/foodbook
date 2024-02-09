<?php
/**
 *
 * Section Title Widget .
 *
 */
class Section_Title_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'sfoodbooksectiontitle';
	}

	public function get_title() {
		return __( 'Section Title', 'foodbook' );
	}


	public function get_icon() {
		return 'eicon-heading';
    }


	public function get_categories() {
		return [ 'foodbook' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'section_title_section',
			[
				'label' => __( 'Section Title', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'section_title_style',
			[
				'label' => __( 'Style Type', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => __('Style One','foodbook'),
					'2'  => __('Style Two','foodbook'),
				],
				'default' => '1',
			]
		);

        $this->add_control(
			'section_title',
			[
				'label' => __( 'Section Title', 'foodbook' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default'  => __( 'Section Title', 'foodbook' )
			]
		);

		$this->add_control(
			'section_desc',
			[
				'label' => __( 'Section Description', 'foodbook' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default'  => __( 'Section Description', 'foodbook' )
			]
        );

        $this->add_control(
			'section_title_align',
			[
				'label' => __( 'Alignment', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'text-left' => [
						'title' => __( 'Left', 'foodbook' ),
						'icon' => 'eicon-text-align-left',
					],
					'text-center' => [
						'title' => __( 'Center', 'foodbook' ),
						'icon' => 'eicon-text-align-center',
					],
					'text-right' => [
						'title' => __( 'Right', 'foodbook' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'text-left',
				'toggle' => true,
			]
		);

        $this->add_control(
			'section_title_tag',
			[
				'label' => __( 'Title Tag', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'h1'  => 'H1',
					'h2'  => 'H2',
					'h3'  => 'H3',
					'h4'  => 'H4',
					'h5'  => 'H5',
					'h6'  => 'H6',
				],
				'default' => 'h2',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Title', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'section_title_color',
			[
				'label' => __( 'Title Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title .title-selector' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'section_title_border_first_part_color',
			[
				'label' => __( 'Border First Part Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title.style--two .title-border span:first-child' => 'background-color: {{VALUE}}',
				],
				'condition'	=> [
					'section_title_style'	=> '2'
				]
			]
		);

		$this->add_control(
			'section_title_border_second_part_color',
			[
				'label' => __( 'Border Second Part Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title.style--two .title-border span:nth-child(2n)' => 'background-color: {{VALUE}}',
				],
				'condition'	=> [
					'section_title_style'	=> '2'
				]
			]
		);

		$this->add_control(
			'section_title_border_third_part_color',
			[
				'label' => __( 'Border Third Part Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title.style--two .title-border span:last-child' => 'background-color: {{VALUE}}',
				],
				'condition'	=> [
					'section_title_style'	=> '2'
				]
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'section_title_typography',
				'label' => __( 'Title Typography', 'foodbook' ),
				'selector' => '{{WRAPPER}} .section-title .title-selector',
			]
        );

        $this->add_responsive_control(
			'section_title_margin',
			[
				'label' => __( 'Title Margin', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .section-title .title-selector' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'section_title_padding',
			[
				'label' => __( 'Title Padding', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .section-title .title-selector' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style_section',
			[
				'label' => __( 'Description', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'section_desc_color',
			[
				'label' => __( 'Description Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title p' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'section_desc_typography',
				'label' => __( 'Description Typography', 'foodbook' ),
				'selector' => '{{WRAPPER}} .section-title p',
			]
        );

        $this->add_responsive_control(
			'section_desc_margin',
			[
				'label' => __( 'Description Margin', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .section-title p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'section_desc_padding',
			[
				'label' => __( 'Description Padding', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .section-title p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		echo '<!-- Section Title -->';
		if( $settings['section_title_style'] == '1' ) {
			echo '<div class="section-title '.esc_attr( $settings['section_title_align'] ).'">';
				echo '<'.esc_attr( $settings['section_title_tag'] ).' class="title-selector">'.wp_kses_post( $settings['section_title'] ).'</'.esc_attr($settings['section_title_tag']).'>';
				if( !empty( $settings['section_desc'] ) ) {
					echo foodbook_paragraph_tag( array(
						"text"	=> wp_kses_post( $settings['section_desc']  )
					) );
				}
			echo '</div>';
		} else {
			echo '<div class="section-title style--two '.esc_attr( $settings['section_title_align'] ).'">';
				echo '<div class="title-border">';
					echo '<span></span>';
					echo '<span></span>';
					echo '<span></span>';
				echo '</div>';
				echo '<'.esc_attr( $settings['section_title_tag'] ).'>'.wp_kses_post( $settings['section_title'] ).'</'.esc_attr($settings['section_title_tag']).'>';
				if( !empty( $settings['section_desc'] ) ) {
					echo foodbook_paragraph_tag( array(
						"text"	=> wp_kses_post( $settings['section_desc']  )
					) );
				}
			echo '</div>';
		}

        echo '<!-- End Section Title -->';


	}

}