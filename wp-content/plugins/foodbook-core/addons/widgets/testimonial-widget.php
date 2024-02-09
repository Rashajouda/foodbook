<?php
/**
 *
 * Slider Widget .
 *
 */
class Testimonial_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'foodbooktestimonialwidget';
	}

	public function get_title() {
		return __( 'Testimonial', 'foodbook' );
	}


	public function get_icon() {
		return 'eicon-testimonial-carousel';
    }


	public function get_categories() {
		return [ 'foodbook' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'slider_option',
			[
				'label' 	=> __( 'Testimonial', 'foodbook' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'load_data_from',
			[
				'label' 		=> __( 'Load Data From?', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'default',
				'options' 		=> [
					'default'  		=> __( 'Deafult', 'foodbook' ),
					'api' 			=> __( 'Api', 'foodbook' ),
				],
			]
		);

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'person_image',
			[
				'label' 	=> __( 'Choose Person Image', 'foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'default' 	=> [
					'url' 	=> FOODBOOK_IMG_DIR_URI.'author/author-1.jpg',
				],
			]
		);

		$repeater->add_control(
			'person_name', [
				'label'         => __( 'Person Name', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'default'       => __( 'Person Name', 'foodbook' ),
				'label_block'   => true,
			]
		);

		$repeater->add_control(
			'star_rating',
			[
				'label' 		=> __( 'Rating', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> '5',
				'options' 		=> [
					'half'  		=> __( '.5', 'foodbook' ),
					'1' 			=> __( '1', 'foodbook' ),
					'1.5' 			=> __( '1.5', 'foodbook' ),
					'2' 			=> __( '2', 'foodbook' ),
					'2.5' 			=> __( '2.5', 'foodbook' ),
					'3' 			=> __( '3', 'foodbook' ),
					'3.5' 			=> __( '3.5', 'foodbook' ),
					'4' 			=> __( '4', 'foodbook' ),
					'4.5' 			=> __( '4.5', 'foodbook' ),
					'5' 			=> __( '5', 'foodbook' ),
				],
			]
		);

		$repeater->add_control(
			'testimonial_quote', [
				'label'         => __( 'Testimonial Quotes', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::WYSIWYG,
                'default'       => __( 'Default description', 'foodbook' ),
				'label_block'   => true,
			]
		);
		$repeater->add_control(
			'testimonial_given_date', [
				'label'         => __( 'How many Days Ago?', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
                'default'       => __( '3 days ago by google', 'foodbook' ),
				'label_block'   => true,
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' 		=> 'person_image_size',
				'include' 	=> [],
				'default' 	=> 'thumbnail',
			]
		);
		$this->add_control(
			'foodbook_testimonial',
			[
				'label' 	=> __( 'Add Testimonial', 'foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'person_name' 		        => __( 'Imran Khan', 'foodbook' ),
					],
					[
						'person_name' 		        => __( 'Neoyaj Sojib', 'foodbook' ),
					],
				],
				'title_field' 	=> '{{{ person_name }}}',
				'condition'		=> [ 'load_data_from'	=> 'default' ],
			]
		);

		$this->add_control(
			'place_id', [
				'label'         => __( 'Google Place Id', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'default'       => __( 'Set The Google Place Id.', 'foodbook' ),
				'label_block'   => true,
				'condition'		=> [ 'load_data_from'	=> 'api' ],
			]
		);

		$this->add_control(
			'place_api', [
				'label'         => __( 'Google Place API', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'default'       => __( 'Set The Google Place API.', 'foodbook' ),
				'label_block'   => true,
				'condition'		=> [ 'load_data_from'	=> 'api' ],
			]
		);

		$this->add_control(
			'description_word', [
				'label'         => __( 'How Many Quatation Word To Show?', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::TEXTAREA,
				'default'       => __( '11', 'foodbook' ),
				'label_block'   => true,
				'condition'		=> [ 'load_data_from'	=> 'api' ],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'slider_control',
			[
				'label' 	=> __( 'Slider Control', 'foodbook' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'data_owl_loop',
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
			'data_owl_autoplay',
			[
				'label' 		=> __( 'Slider Autoplay', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'foodbook' ),
				'label_off' 	=> __( 'No', 'foodbook' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'data_owl_nav',
			[
				'label' 		=> __( 'Slider Nav', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'foodbook' ),
				'label_off' 	=> __( 'No', 'foodbook' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'data_owl_dots',
			[
				'label' 		=> __( 'Slider Dots', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'foodbook' ),
				'label_off' 	=> __( 'No', 'foodbook' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
        $this->add_control(
			'dots_bg',
			[
				'label' 	=> __( 'Owl Dots Background', 'foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-slider .owl-dots .owl-dot' => 'background: {{VALUE}}',
				],
                'condition' => [ 'data_owl_dots' => 'yes' ]
			]
		);
        $this->add_control(
			'dots_active_bg',
			[
				'label' 	=> __( 'Owl Dots Active Background', 'foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-slider .owl-dots .owl-dot.active' => 'background: {{VALUE}}',
				],
                'condition' => [ 'data_owl_dots' => 'yes' ],
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'slider_title_option',
			[
				'label' 	=> __( 'Quote Options', 'foodbook' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'quote_color',
			[
				'label' 	=> __( 'Quote Color', 'foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-testimonial .single-testimonial-inner .content .testimonial-quote p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' 		=> 'quote_text_shadow',
				'label' 	=> __( 'Quote Text Shadow', 'foodbook' ),
				'selector' 	=> '{{WRAPPER}} .single-testimonial .single-testimonial-inner .content .testimonial-quote p',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'quote_typography',
				'label' 	=> __( 'Quote Typography', 'foodbook' ),
				'selector' 	=> '{{WRAPPER}} .single-testimonial .single-testimonial-inner .content .testimonial-quote p',
			]
		);
		$this->add_control(
			'quote_margin',
			[
				'label' 		=> __( 'Quote Margin', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-testimonial .single-testimonial-inner .content .testimonial-quote p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'quote_padding',
			[
				'label' 		=> __( 'Quote Padding', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-testimonial .single-testimonial-inner .content .testimonial-quote p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'name_style_option',
			[
				'label'     => __( 'Name Options', 'foodbook' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'name_color',
			[
				'label' 	=> __( 'Name Color', 'foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .content-wrapper .name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' 		=> 'name_text_shadow',
				'label' 	=> __( 'Name Text Shadow', 'foodbook' ),
				'selector' 	=> '{{WRAPPER}} .content-wrapper .name',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'name_typography',
				'label' 	=> __( 'Name Typography', 'foodbook' ),
				'selector' 	=> '{{WRAPPER}} .content-wrapper .name',
			]
		);
		$this->add_control(
			'name_margin',
			[
				'label' 		=> __( 'Name Margin', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}}  .content-wrapper .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'name_padding',
			[
				'label' 		=> __( 'Name Padding', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}}  .content-wrapper .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'star_style_option',
			[
				'label'     => __( 'Star Options', 'foodbook' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'star_color',
			[
				'label' 	=> __( 'Star Color', 'foodbook' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .star i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'star_typography',
				'label' 	=> __( 'Star Typography', 'foodbook' ),
				'selector' 	=> '{{WRAPPER}} .star i',
			]
		);
		$this->add_control(
			'star_margin',
			[
				'label' 		=> __( 'Star Margin', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}}  .star i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'star_padding',
			[
				'label' 		=> __( 'Star Padding', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}}  .star i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'testimonial_general_option',
            [
                'label'     => __( 'Single Slide Background', 'foodbook' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'single_slide_bg_under',
                'label'     => __( 'Background Under Single Slide', 'foodbook' ),
                'types'     => [ 'classic', 'gradient', 'video' ],
                'selector'  => '{{WRAPPER}} .single-testimonial .single-testimonial-inner:after',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'testimonial_single_slide_option',
            [
                'label'     => __( 'Single Slide Options', 'foodbook' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'single_slide_bg',
				'label'     => __( 'Single Slide Background', 'foodbook' ),
				'types'     => [ 'classic', 'gradient', 'video' ],
				'selector'  => '{{WRAPPER}} .single-testimonial .single-testimonial-inner',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'single_slide_box_shadow',
				'label'     => __( 'Box Shadow', 'foodbook' ),
				'selector'  => '{{WRAPPER}} .single-testimonial .single-testimonial-inner',
			]
		);
        $this->add_control(
			'single_slide_border_raduis',
			[
				'label' 		=> __( 'Single Slide Border Radius', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-testimonial .single-testimonial-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'single_slide_margin',
			[
				'label' 		=> __( 'Single Slide Margin', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-testimonial .single-testimonial-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'single_slide_padding',
			[
				'label' 		=> __( 'Single Slide Padding', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-testimonial .single-testimonial-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();


    }


    // Flat Content wysiwyg output with meta key and post id
    protected function foodbook_get_textareahtml_output( $content ) {

        global $wp_embed;

        $content = $wp_embed->autoembed( $content );
        $content = $wp_embed->run_shortcode( $content );
        $content = wpautop( $content );
        $content = do_shortcode( $content );

        return $content;
    }

	protected function render() {

        $settings = $this->get_settings_for_display();

		// Slider Owl Loop
		if( $settings['data_owl_loop'] =='yes' ){
			$slider_owl_loop = 'true';
		}else{
			$slider_owl_loop = 'false';
		}

		// Slider Owl Autoplay
		if( $settings['data_owl_autoplay'] == 'yes' ){
			$slider_owl_autoplay = 'true';
		}else{
			$slider_owl_autoplay = 'false';
		}

		// Data Owl Dots
		if( $settings['data_owl_dots'] == 'yes' ){
			$slider_owl_dots = 'true';
		}else{
			$slider_owl_dots = 'false';
		}
		// Data Owl Nav
		if( $settings['data_owl_nav'] == 'yes' ){
			$slider_owl_nav = 'true';
		}else{
			$slider_owl_nav = 'false';
		}

        echo '<!-- Testimonial -->';

            echo '<div class="testimonial-slider owl-carousel" data-owl-animate-in="slideIn" data-owl-animate-out="slideOut" data-owl-nav="'.esc_attr( $slider_owl_nav ).'" data-owl-dots="'.esc_attr( $slider_owl_dots ).'" data-owl-mousedrag="true" data-owl-autoplay="'.esc_attr( $slider_owl_autoplay ).'">';
				if( $settings['load_data_from'] == 'default' ){
					if( !empty( $settings['foodbook_testimonial'] ) ):
	                echo '<!-- Single Testimonial -->';
	                    foreach( $settings['foodbook_testimonial'] as $testimonial ):
	                        echo '<div class="single-testimonial">';
								echo '<div class="content media">';
									echo '<div class="image">';
										echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'person_image_size', 'person_image' );
									echo '</div>';
									echo '<div class="content-wrapper media-body">';
										echo '<div class="content-wrap-top">';
											if( ! empty( $testimonial['person_name'] ) ){
												echo '<div class="name">';
													echo esc_html( $testimonial['person_name'] );
												echo '</div>';
											}
											echo '<div class="star">';
												if( $testimonial['star_rating'] == 'half' ){
													echo '<i class="fa fa-star-half-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
												}elseif( $testimonial['star_rating'] == '1' ){
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
												}elseif( $testimonial['star_rating'] == '1.5' ){
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star-half-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
												}elseif( $testimonial['star_rating'] == '2' ){
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
												}elseif( $testimonial['star_rating'] == '2.5' ){
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star-half-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
												}elseif( $testimonial['star_rating'] == '3' ){
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
												}elseif( $testimonial['star_rating'] == '3.5' ){
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star-half-o"></i>';
													echo '<i class="fa fa-star-o"></i>';
												}elseif( $testimonial['star_rating'] == '4' ){
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star-o"></i>';
												}elseif( $testimonial['star_rating'] == '4.5' ){
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star-half-o"></i>';
												}elseif( $testimonial['star_rating'] == '5' ){
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
													echo '<i class="fa fa-star"></i>';
												}
											echo '</div>';
										echo '</div>';
										if( !empty( $testimonial['testimonial_quote'] ) ) {
											echo '<div class="testimonial-quote">';
											echo wp_kses_post( $this->foodbook_get_textareahtml_output( $testimonial['testimonial_quote'] ) );
											if( ! empty( $testimonial['testimonial_given_date'] ) ){
												echo '<span>'.esc_html( $testimonial['testimonial_given_date'] ).'</span>';
											}
											echo '</div>';
										}
									echo '</div>';

								echo '</div>';
	                        echo '</div>';
	                    endforeach;
			        endif;
	                echo '<!-- End Single Testimonial -->';
				}else{
					$map_api_url	= "https://maps.googleapis.com/maps/api/place/details/json?place_id={$settings['place_id']}&key={$settings['place_api']}";

					$remote_data 	= wp_remote_get( $map_api_url );

					if( is_wp_error( $remote_data ) ) {
					    return; // Bail early
					}

					$body = wp_remote_retrieve_body( $remote_data );
					$data = json_decode( $body );

					$slider_data = $data->result->reviews;

					foreach( $slider_data as $testimonial ):
						echo '<div class="single-testimonial">';
							echo '<div class="content media">';
								echo '<div class="image">';
									echo foodbook_img_tag( array(
										'url'	=> esc_url( $testimonial->profile_photo_url )
									) );
								echo '</div>';
								echo '<div class="content-wrapper media-body">';
									echo '<div class="content-wrap-top">';
										echo '<div class="name">';
											echo esc_html( $testimonial->author_name );
										echo '</div>';
										echo '<div class="star">';
											if( $testimonial->rating == '1' ){
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star-o"></i>';
												echo '<i class="fa fa-star-o"></i>';
												echo '<i class="fa fa-star-o"></i>';
												echo '<i class="fa fa-star-o"></i>';
											}elseif( $testimonial->rating == '2' ){
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star-o"></i>';
												echo '<i class="fa fa-star-o"></i>';
												echo '<i class="fa fa-star-o"></i>';
											}elseif( $testimonial->rating == '3' ){
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star-o"></i>';
												echo '<i class="fa fa-star-o"></i>';
											}elseif( $testimonial->rating == '4' ){
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star-o"></i>';
											}elseif( $testimonial->rating == '5' ){
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star"></i>';
												echo '<i class="fa fa-star"></i>';
											}
										echo '</div>';
									echo '</div>';
										echo '<div class="testimonial-quote">';
										echo '<p>';
											echo wp_trim_words( $testimonial->text, $settings['description_word'], '' );
										echo '</p>';
										if( ! empty( $testimonial->relative_time_description ) ){
											echo '<span>'.esc_html( $testimonial->relative_time_description ).'</span>';
										}
										echo '</div>';
								echo '</div>';

							echo '</div>';
						echo '</div>';
					endforeach;
				}
            echo '</div>';
        echo '<!-- End Testimonial -->';

	}

}