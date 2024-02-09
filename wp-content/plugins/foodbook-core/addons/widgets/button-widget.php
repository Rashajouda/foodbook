<?php
/**
 *
 * Button Widget .
 *
 */
class Button_widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'sfoodbookbuttonwidget';
	}

	public function get_title() {
		return __( 'Button', 'foodbook' );
	}


	public function get_icon() {
		return 'eicon-button';
    }


	public function get_categories() {
		return [ 'foodbook' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'button_option',
			[
				'label' 	=> __( 'Button', 'foodbook' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'button_style_design',
			[
				'label' 		=> esc_html__( 'Button Style', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::CHOOSE,
				'options' 		=> [
					'one' 		=> [
						'title' 	=> esc_html__( 'Style One', 'foodbook' ),
						'icon'  	=> 'fa fa-user',
					],
					'two' 		=> [
						'title' 	=> esc_html__( 'Style Two', 'foodbook' ),
						'icon'  	=> 'fa fa-cloud',
					],
				],
				'default' 		=> 'one',
				'toggle' 		=> true,
			]
		);
		$this->add_control(
			'button_text', [
				'label'         => __( 'Button Text', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'label_block'   => true,
				'default'		=> __( 'Free Audit','foodbook' )
			]
		);
        $this->add_control(
			'button_link',
			[
				'label'         => __( 'Button Link', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'foodbook' ),
				'show_external' => true,
				'default'       => [
					'url'              => '',
					'is_external'      => true,
					'nofollow'         => true,
				],
			]
		);
		$this->add_control(
			'button_alignment',
			[
				'label' 	=> __( 'Button Alignment', ' foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::CHOOSE,
				'options' 	=> [
					'left' 		=> [
						'title' => __( 'Left', ' foodbook' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' 	=> __( 'Center', ' foodbook' ),
						'icon' 		=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' 	=> __( 'Right', ' foodbook' ),
						'icon' 		=> 'eicon-text-align-right',
					],
				],
				'default' 		=> 'center',
				'toggle' 		=> true,
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'button_style_option',
			[
				'label' => __( 'Button Options', ' foodbook' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' 	=> __( 'Normal', 'foodbook' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' 		=> esc_html__( 'Button Text Color', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn,{{WRAPPER}} .btn-inline' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'button_text_shadow',
				'label' 		=> __( 'Button Text Shadow', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .btn,{{WRAPPER}} .btn-inline',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'label' 		=> __( 'Typography', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .btn,{{WRAPPER}} .btn-inline',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border',
				'label' 		=> __( 'Button Border', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .btn,{{WRAPPER}} .btn-inline',
			]
		);
		$this->add_control(
			'button_border_corner_color',
			[
				'label' 		=> esc_html__( 'Button Border Corner Color', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn:before,{{WRAPPER}} .btn:after' => 'border-color: {{VALUE}}!important',
				],
				'condition' 	=> [ 'button_style_design'	=>	'one' ],
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn,{{WRAPPER}} .btn-inline' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' 		=> esc_html__( 'Button Border Radius', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn,{{WRAPPER}} .btn-inline' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn,{{WRAPPER}} .btn-inline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' 		=> esc_html__( 'Padding', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn,{{WRAPPER}} .btn-inline' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_option',
			[
				'label' 	=> __( 'Hover', 'foodbook' ),
			]
		);
		$this->add_control(
			'button_hover_text_color',
			[
				'label' 		=> esc_html__( 'Button Hover Text Color', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn:hover,{{WRAPPER}} .btn-inline:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'button_hover_text_shadow',
				'label' 		=> __( 'Button Hover Text Shadow', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .btn:hover,{{WRAPPER}} .btn-inline:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_hover_typography',
				'label' 		=> __( 'Typography', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .btn:hover,{{WRAPPER}} .btn-inline:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_hover_border',
				'label' 		=> __( 'Button Hover Border', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .btn:hover,{{WRAPPER}} .btn-inline:hover',
			]
		);
		$this->add_control(
			'button_hover_special_border',
			[
				'label' 		=> esc_html__( 'Button Hover Border Bottom Color', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-inline:after' => 'background-color: {{VALUE}}',
				],
				'condition' 	=> [ 'button_style_design'	=>	'two' ],
			]
		);
		$this->add_control(
			'button_hover_background_color',
			[
				'label' 		=> esc_html__( 'Button Hover Background Color', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn:hover,{{WRAPPER}} .btn-inline:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_hover_border_radius',
			[
				'label' 		=> esc_html__( 'Button Hover Border Radius', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn:hover,{{WRAPPER}} .btn-inline:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_hover_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn:hover,{{WRAPPER}} .btn-inline:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_hover_padding',
			[
				'label' 		=> esc_html__( 'Padding', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn:hover,{{WRAPPER}} .btn-inline:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

    }



	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['button_alignment'] == 'left' ){
			$button_align = 'text-left';
		}elseif( $settings['button_alignment'] == 'center' ){
			$button_align = 'text-center';
		}else{
			$button_align = 'text-right';
		}

        $target   = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
        if( !empty( $settings['button_text'] ) ):
            echo '<div class="'.esc_attr( $button_align ).'">';
                if( $settings['button_style_design'] == 'one' ){
                    echo '<a href="'.esc_url( $settings['button_link']['url'] ).'" '. $target . $nofollow .' class="btn">'.esc_html( $settings['button_text'] ).'</a>';
                }else{
                    echo '<a href="'.esc_url( $settings['button_link']['url'] ).'" '. $target . $nofollow .' class="btn-inline">'.esc_html( $settings['button_text'] ).'</a>';
                }
            echo '</div>';
        endif;

	}

}