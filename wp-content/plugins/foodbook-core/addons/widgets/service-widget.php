<?php
/**
 *
 * Service Widget .
 *
 */
class Service_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'sfoodbookservice';
	}

	public function get_title() {
		return __( 'Service', 'foodbook' );
	}


	public function get_icon() {
		return 'eicon-icon-box';
    }


	public function get_categories() {
		return [ 'foodbook' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'service_section',
			[
				'label' => __( 'Service', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'service_title',
			[
				'label' => __( 'Title', 'foodbook' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default'  => __( 'Service Title', 'foodbook' )
			]
		);

		$this->add_control(
			'service_desc',
			[
				'label' => __( 'Short Description', 'foodbook' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default'  => __( 'Short Description', 'foodbook' )
			]
		);

		$this->add_control(
			'service_image',
			[
				'label' => __( 'Choose Image', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'service_link',
			[
				'label' => __( 'Service Link', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'foodbook' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

        $this->add_control(
			'section_service_align',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'service_general_style_section',
			[
				'label' => __( 'General', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-service' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'border_corner_color',
			[
				'label' => __( 'Border Corner Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-service:before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .single-service:after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'service_title_style_section',
			[
				'label' => __( 'Title', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'service_title_color',
			[
				'label' => __( 'Title Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-service .content h3 a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'service_title_hover_color',
			[
				'label' => __( 'Title Hover Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-service .content h3 a:hover' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'service_title_typography',
				'label' => __( 'Title Typography', 'foodbook' ),
				'selector' => '{{WRAPPER}} .single-service .content h3',
			]
        );

        $this->add_responsive_control(
			'service_title_margin',
			[
				'label' => __( 'Title Margin', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-service .content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'service_title_padding',
			[
				'label' => __( 'Title Padding', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-service .content h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'service_desc_style_section',
			[
				'label' => __( 'Description', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'service_desc_color',
			[
				'label' => __( 'Description Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-service .content p' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'service_desc_typography',
				'label' => __( 'Description Typography', 'foodbook' ),
				'selector' => '{{WRAPPER}} .single-service .content p',
			]
        );

        $this->add_responsive_control(
			'service_desc_margin',
			[
				'label' => __( 'Description Margin', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-service .content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'service_desc_padding',
			[
				'label' => __( 'Description Padding', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-service .content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$target = $settings['service_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['service_link']['nofollow'] ? ' rel="nofollow"' : '';
		$url = $settings['service_link']['url'] ? $settings['service_link']['url'] : '#';
        echo '<!-- Single Service -->';
		echo '<div class="single-service '.esc_attr( $settings['section_service_align'] ).'">';
			if( !empty( $settings['service_image']['url'] ) ) {
				echo '<!-- Icon -->';
				echo '<div class="icon">';
					echo foodbook_img_tag( array(
						"class"		=> "svg",
						"url"		=> esc_url( $settings['service_image']['url'] )
					) );
				echo '</div>';
				echo '<!-- End Icon -->';
			}
			echo '<!-- Content -->';
			echo '<div class="content">';
				if( !empty( $settings['service_title'] ) ) {
					echo '<h3>';
						echo '<a href="'.esc_url($url).'">'.esc_html( $settings['service_title'] ).'</a>';
					echo '</h3>';
				}
				if( !empty( $settings['service_desc'] ) ) {
					echo '<p>'.wp_kses_post( $settings['service_desc'] ).'</p>';
				}
			echo '</div>';
			echo '<!-- End Content -->';
		echo '</div>';
		echo '<!-- End Single Service -->';

	}

}