<?php
/**
 *
 * Category Slider Widget .
 *
 */
class Category_Slider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'foodbookcategoryslider';
	}

	public function get_title() {
		return __( 'Category Slider', 'foodbook' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
    }

	public function get_categories() {
		return [ 'foodbook' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'category_slider_option',
			[
				'label' 	=> __( 'Category Slider', 'foodbook' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'category_title',
			[
				'label'         => __( 'Category Slider Title', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'default'       => __( 'Asian Food', 'foodbook' ),
				'placeholder'   => __( 'Type your title here', 'foodbook' ),
			]
		);

		$repeater->add_control(
			'category_title_link',
			[
				'label' 		=> __( 'Link', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'foodbook' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);


		$repeater->add_control(
			'category_subtitle',
			[
				'label'         => __( 'Category Slider Sub Title', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'default'       => __( '30 Avaiable', 'foodbook' ),
				'placeholder'   => __( 'Type your subtitle here', 'foodbook' ),
			]
		);

		$repeater->add_control(
			'category_slider_image',
			[
				'label' 	=> __( 'Choose Slider Image', 'elementor' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'default' 	=> [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' 		=> 'category_image_size',
				'include' 	=> [],
				'default' 	=> 'full',
			]
		);
		$this->add_control(
			'category_slider',
			[
				'label' 	      => __( 'Add Slider Image', 'foodbook' ),
				'type' 		      => \Elementor\Controls_Manager::REPEATER,
                'default'         => [
                    [
						'category_title'		=> esc_html__( 'Asian Food', 'foodbook' ),
                        'category_slider_image' 	=> FOODBOOK_IMG_DIR_URI.'brand/brand-1.png',
                    ],
                    [
						'category_title'		=> esc_html__( 'Afrikan Food', 'foodbook' ),
                        'category_slider_image' 	=> FOODBOOK_IMG_DIR_URI.'brand/brand-1.png',
                    ],
                ],
				'fields' 	      => $repeater->get_controls(),
				'title_field'     => '{{{ category_title }}}',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'brand_slider_control',
			[
				'label' 	=> __( 'Slider Control', 'foodbook' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'slider_item_margin',
			[
				'label' 		=> __( 'Slider Margin', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
			]
		);
		$this->add_control(
			'brand_owl_loop',
			[
				'label' 		=> __( 'Slider Loop', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'On', 'foodbook' ),
				'label_off' 	=> __( 'Off', 'foodbook' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'brand_owl_nav',
			[
				'label' 		=> __( 'Owl Nav', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'On', 'foodbook' ),
				'label_off' 	=> __( 'Off', 'foodbook' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'brand_owl_autoplay',
			[
				'label' 		=> __( 'Slider Autoplay', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'foodbook' ),
				'label_off' 	=> __( 'No', 'foodbook' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);

        $this->add_control(
			'category_slider_item',
			[
				'label' 		=> __( 'Category Slider Item', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' => 1,
						'max' => 10,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'brand_slider_responsive_control',
            [
                'label' 	=> __( 'Slider Responsive', 'foodbook' ),
                'tab' 		=> \Elementor\Controls_Manager::TAB_RESPONSIVE,
            ]
        );

        $this->add_control(
			'category_image_for_small',
			[
				'label' 		=> __( 'Slider Image Item For Small Device', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' => 1,
						'max' => 10,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
			]
		);
        $this->add_control(
			'category_image_for_mobile',
			[
				'label' 		=> __( 'Slider Image Item For Mobile', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' => 1,
						'max' => 10,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
			]
		);
        $this->add_control(
			'category_image_for_tablet',
			[
				'label' 		=> __( 'Slider Image Item For Tablet', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' => 1,
						'max' => 10,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'category_slider_design',
            [
                'label' 	=> __( 'Category Slider Design', 'foodbook' ),
                'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'title_color',
			[
				'label' 	=> __( 'Title Color', 'foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-category-slider .content-wrapper a' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'title_hover_color',
			[
				'label' 	=> __( 'Title Hover Color', 'foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-category-slider .content-wrapper a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' 		=> 'title_text_shadow',
				'label' 	=> __( 'Title Text Shadow', 'foodbook' ),
				'selector' 	=> '{{WRAPPER}} .single-category-slider .content-wrapper a',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Title Typography', 'foodbook' ),
				'selector' 	=> '{{WRAPPER}} .single-category-slider .content-wrapper a',
			]
		);
		$this->add_control(
			'title_margin',
			[
				'label' 		=> __( 'Title Margin', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-category-slider .content-wrapper a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' 		=> __( 'Title Padding', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-category-slider .content-wrapper a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' 	=> __( 'Subtitle Color', 'foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-category-slider .content-wrapper span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' 		=> 'subtitle_text_shadow',
				'label' 	=> __( 'Subtitle Text Shadow', 'foodbook' ),
				'selector' 	=> '{{WRAPPER}} .single-category-slider .content-wrapper span',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'subtitle_typography',
				'label' 	=> __( 'Subtitle Typography', 'foodbook' ),
				'selector' 	=> '{{WRAPPER}} .single-category-slider .content-wrapper span',
			]
		);
		$this->add_control(
			'subtitle_margin',
			[
				'label' 		=> __( 'Subtitle Margin', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-category-slider .content-wrapper span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' 		=> __( 'Subtitle Padding', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-category-slider .content-wrapper span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

    }



	protected function render() {

        $settings = $this->get_settings_for_display();

        // Slider Owl Loop
        if( $settings['brand_owl_loop'] =='yes' ){
            $slider_owl_loop = 'true';
        }else{
            $slider_owl_loop = 'false';
        }

        if( $settings['brand_owl_nav'] =='yes' ){
            $slider_owl_nav = 'true';
        }else{
            $slider_owl_nav = 'false';
        }

        // Slider Owl Autoplay
        if( $settings['brand_owl_autoplay'] =='yes' ){
            $slider_owl_autoplay = 'true';
        }else{
            $slider_owl_autoplay = 'false';
        }

        if( !empty( $settings['category_slider'] ) ):
            echo '<div class="row">';
                echo '<div class="col-12">';
                    echo '<!-- Partners -->';
                    ?>
                    <div class="category-slider owl-carousel" data-owl-nav="<?php echo esc_attr( $slider_owl_nav );?>" data-owl-margin="<?php echo esc_attr( $settings['slider_item_margin']['size'] );?>" data-owl-items="<?php echo esc_attr( $settings['category_slider_item']['size'] ); ?>" data-owl-autoplay="<?php echo esc_attr( $slider_owl_autoplay )?>" data-owl-loop="<?php echo esc_attr( $slider_owl_loop );?>" data-owl-responsive='{"0": {"items": "<?php echo esc_attr( $settings['category_image_for_small']['size'] );?>"},"575":{"items": "<?php echo esc_attr( $settings['category_image_for_mobile']['size'] );?>"},"768": {"items": "<?php echo esc_attr( $settings['category_image_for_tablet']['size'] );?>"},"992": {"items": "<?php echo esc_attr( $settings['category_slider_item']['size'] );?>"}}'>
                        <?php
                        echo '<!-- Single Partner -->';
                        foreach ( $settings['category_slider'] as $single_category ):
                            $target 	= $single_category['category_title_link']['is_external'] ? ' target="_blank"' : '';
                            $nofollow 	= $single_category['category_title_link']['nofollow'] ? ' rel="nofollow"' : '';
                            echo '<div class="single-category-slider">';
								echo '<a '.wp_kses_post( $target.$nofollow ).' href="'.esc_url( $single_category['category_title_link']['url'] ).'">';
                                	echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $single_category, 'category_image_size', 'category_slider_image' );
								echo '</a>';
								echo '<div class="content-wrapper">';
									if( ! empty( $single_category['category_title'] ) ){
										echo '<h3>';
											echo '<a '.wp_kses_post( $target.$nofollow ).' href="'.esc_url( $single_category['category_title_link']['url'] ).'">';
												echo esc_html( $single_category['category_title'] );
											echo '</a>';
										echo '</h3>';
									}
									if( ! empty( $single_category['category_subtitle'] ) ){
										echo foodbook_span_tag( array(
											'text'	=> esc_html( $single_category['category_subtitle'] ),
										) );
									}
                            	echo '</div>';
                            echo '</div>';
                        endforeach;
                        echo '<!-- End Single Partner -->';
                    echo '</div>';
                    echo '<!-- End of Partners -->';
                echo '</div>';
            echo '</div>';
        endif;

	}

}