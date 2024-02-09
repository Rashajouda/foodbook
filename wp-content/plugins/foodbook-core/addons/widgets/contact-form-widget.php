<?php
/**
 *
 * Contact Form Widget .
 *
 */
class Contact_Form_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'sfoodbookcontactform';
	}

	public function get_title() {
		return __( 'Contact Form', 'foodbook' );
	}


	public function get_icon() {
		return 'eicon-form-horizontal';
    }


	public function get_categories() {
		return [ 'foodbook' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'form_title_section',
			[
				'label' => __( 'Title', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'form_title',
			[
				'label' => __( 'Title', 'foodbook' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default'  => __( 'Title', 'foodbook' )
			]
        );

        $this->add_control(
			'form_title_tag',
			[
				'label' => __( 'Title Tag', 'foodbook' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'h1'    => __("H1",'foodbook'),
                    'h2'    => __("H2",'foodbook'),
                    'h3'    => __("H3",'foodbook'),
                    'h4'    => __("H4",'foodbook'),
                    'h5'    => __("H5",'foodbook'),
                    'h6'    => __("H6",'foodbook'),
                    'div'   => __("Div",'foodbook'),
                    'p'    => __("P",'foodbook'),
                ],
                'default' => 'h2',
			]
        );

        $this->add_control(
			'form_description',
			[
				'label' => __( 'Description', 'foodbook' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default'  => __( 'Short Description', 'foodbook' )
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'form_shortcode_section',
			[
				'label' => __( 'Form Shortcode', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'contact_form_shortcode',
			[
				'label' => __( 'Form Shortcode', 'foodbook' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'form_title_style',
			[
				'label' => __( 'Form Title', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'form_title_typography',
				'label' => __( 'Typography', 'foodbook' ),
				'selector' => '{{WRAPPER}} .contact-form-wrapper .seo-form-title',
			]
        );

        $this->add_control(
			'form_title_margin',
			[
				'label' => __( 'Margin', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-form-wrapper .seo-form-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_control(
			'form_title_padding',
			[
				'label' => __( 'Padding', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-form-wrapper .seo-form-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
			]
		);

        $this->add_control(
			'form_title_color',
			[
				'label' => __( 'Title Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form-wrapper .seo-form-title' => 'color: {{VALUE}}',
				],
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'form_desc',
			[
				'label' => __( 'Form Description', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'form_desc_typography',
				'label' => __( 'Typography', 'foodbook' ),
                'selector' => '{{WRAPPER}} .contact-form-wrapper p',
                'separator' => 'after'
			]
        );

        $this->add_control(
			'form_desc_margin',
			[
				'label' => __( 'Margin', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-form-wrapper p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_control(
			'form_desc_padding',
			[
				'label' => __( 'Padding', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-form-wrapper p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
			]
		);

        $this->add_control(
			'form_desc_color',
			[
				'label' => __( 'Description Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form-wrapper p' => 'color: {{VALUE}}',
				],
			]
		);


        $this->end_controls_section();


        $this->start_controls_section(
			'form_input',
			[
				'label' => __( 'Form Input', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'form_input_margin',
			[
				'label' => __( 'Margin', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-form input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .contact-form textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_control(
			'form_input_padding',
			[
				'label' => __( 'Padding', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .contact-form textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
			]
		);

        $this->add_control(
			'form_input_color',
			[
				'label' => __( 'Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form .theme-input-style' => 'color: {{VALUE}} !important;',
				],
			]
        );

        $this->add_control(
			'form_input_background_color',
			[
				'label' => __( 'Background Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form .theme-input-style' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

        $this->add_control(
			'form_input_focus_background_color',
			[
				'label' => __( 'Focus Background Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form .theme-input-style:focus' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'form_submit_btn',
			[
				'label' => __( 'Form Submit Button', 'foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'form_submit_btn_margin',
			[
				'label' => __( 'Margin', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-form button.btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_control(
			'form_submit_btn_padding',
			[
				'label' => __( 'Padding', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-form button.btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'after'
			]
		);

        $this->add_control(
			'form_submit_btn_color',
			[
				'label' => __( 'Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form button.btn' => 'color: {{VALUE}} !important;',
				],
			]
        );

        $this->add_control(
			'form_submit_btn_border_color',
			[
				'label' => __( 'Border Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form button.btn' => 'border-color: {{VALUE}} !important;',
				],
			]
        );


        $this->add_control(
			'form_submit_btn_bg_color',
			[
				'label' => __( 'Background Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form button.btn' => 'background-color: {{VALUE}} !important;',
				],
			]
        );

        $this->add_control(
			'form_submit_btn_hover_color',
			[
				'label' => __( 'Hover Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form button.btn:hover' => 'color: {{VALUE}} !important;',
				],
			]
        );

        $this->add_control(
			'form_submit_btn_hover_border_color',
			[
				'label' => __( 'Hover Border Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form button.btn:hover:before' => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-form button.btn:hover:after' => 'border-color: {{VALUE}} !important;',
				],
			]
        );


        $this->add_control(
			'form_submit_btn_hover_bg_color',
			[
				'label' => __( 'Hover Background Color', 'foodbook' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form button.btn:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
        );

        $this->end_controls_section();

	}


	protected function render() {

		$settings = $this->get_settings_for_display();
        echo '<!-- Contact Form Begin -->';
            echo '<div class="contact-form-wrapper">';
                if( !empty( $settings['form_title'] ) ) {
                    echo foodbook_heading_tag( array(
                        "text"  => esc_html( $settings['form_title'] ),
                        "tag"   => esc_attr( $settings['form_title_tag'] ),
                        "class" => "seo-form-title"
                    ) );
                }
                if( !empty( $settings['form_description'] ) ) {
                    echo foodbook_paragraph_tag( array(
                        "text"  => wp_kses_post( $settings['form_description'] )
                    ) );
                }

                echo do_shortcode($settings['contact_form_shortcode']);
            echo '</div>';
            echo '<!-- Contact Form End -->';
	}

}