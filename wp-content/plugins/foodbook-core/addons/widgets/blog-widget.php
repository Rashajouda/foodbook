<?php
	/**
	* Elementor Blog Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class BLog_Widget extends \Elementor\Widget_Base {


	public function get_name() {
		return 'sfoodbookblogwidget';
	}

	public function get_title() {
		return esc_html__( 'Blog', 'foodbook' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'foodbook' ];
	}

	// Add The Input For User
	protected function register_controls(){
		$this->start_controls_section(
			'section_content',
			[
				'label'		=> esc_html__( 'Set Content','foodbook' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'post_from',
			[
				'label' 		=> esc_html__( 'Post From', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'all',
				'options' 		=> [
					'all'  			=> esc_html__( 'All', 'foodbook' ),
					'categories' 	=> esc_html__( 'Categories', 'foodbook' ),
				],
			]
		);
		$this->add_control(
			'categories',
			[
				'label' 		=> esc_html__( 'Post From', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT2,
				'options' 		=> foodbook_blogs_category(),
				'condition' 	=> ['post_from' => 'categories'],
                'multiple'      => true,
			]
		);
		$this->add_control(
			'post_limit',
			[
				'label' 		=> esc_html__( 'Post Limit', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder'	=> esc_html__( 'Only Number Work. Like 4 or 6', 'foodbook' ),
			]
		);
		$this->add_control(
			'order',
			[
				'label' 		=> esc_html__( 'Order', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'ASC',
				'options' 		=> [
					'ASC'  			=> esc_html__( 'Ascending', 'foodbook' ),
					'DESC' 			=> esc_html__( 'Descending', 'foodbook' ),
				],
			]
		);
		$this->add_control(
			'order_by',
			[
				'label' 		=> esc_html__( 'Order By', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'date',
				'options' 		=> [
					'none'  		=> esc_html__( 'None', 'foodbook' ),
					'type' 			=> esc_html__( 'Type', 'foodbook' ),
					'title' 		=> esc_html__( 'Title', 'foodbook' ),
					'name' 			=> esc_html__( 'Name', 'foodbook' ),
					'date' 			=> esc_html__( 'Date', 'foodbook' ),
				],
			]
		);
        $this->add_control(
            'blog_column',
            [
                'label' 		=> esc_html__( 'Select Blog Column', 'foodbook' ),
                'type' 			=> \Elementor\Controls_Manager::SELECT,
                'default' 		=> 'three',
                'options' 		=> [
                    'two'  		   => esc_html__( '2 Column', 'foodbook' ),
                    'three' 	   => esc_html__( '3 Column', 'foodbook' ),
                    'four' 		   => esc_html__( '4 Column', 'foodbook' ),
                    'six' 		   => esc_html__( '6 Column', 'foodbook' ),
                ],
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'design_option',
			[
				'label'			=> esc_html__( 'Date Style','foodbook' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'date_color',
			[
				'label'         => __( 'Date Color', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .single-blog-item .blog-content .posted' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'date_text_shadow',
				'label'         => __( 'Date Text Shadow', 'foodbook' ),
				'selector'      => '{{WRAPPER}} .single-blog-item .blog-content .posted',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'          => 'date_typography',
				'label'         => __( 'Date Typography', 'foodbook' ),
				'selector'      => '{{WRAPPER}} .single-blog-item .blog-content .posted',
			]
		);
        $this->add_control(
			'date_margin',
			[
				'label'         => __( 'Date Margin', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .single-blog-item .blog-content .posted' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'date_padding',
			[
				'label'         => __( 'Date Padding', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .single-blog-item .blog-content .posted' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'title_design_option',
			[
				'label'			=> esc_html__( 'Title Style','foodbook' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'title_normal_hover',
			[
				'label'     => __( 'Title Normal And Hover', 'foodbook' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'normal'         => [
						'title'           => __( 'Normal', 'foodbook' ),
						'icon'            => 'fa fa-align-left',
					],
					'hover'          => [
						'title'           => __( 'Hover', 'foodbook' ),
						'icon'            => 'fa fa-align-center',
					],
				],
				'default'   => 'normal',
				'toggle'    => true,
			]
		);
        $this->add_control(
			'blog_title_color',
			[
				'label'         => __( 'Title Color', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .single-blog-item .blog-content h3 a' => 'color: {{VALUE}}',
				],
                'condition' 	=> ['title_normal_hover' => 'normal'],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'blog_title_text_shadow',
				'label'         => __( 'Title Text Shadow', 'foodbook' ),
				'selector'      => '{{WRAPPER}} .single-blog-item .blog-content h3 a',
                'condition' 	=> ['title_normal_hover' => 'normal'],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'          => 'blog_title_typography',
				'label'         => __( 'Title Typography', 'foodbook' ),
				'selector'      => '{{WRAPPER}} .single-blog-item .blog-content h3 a',
                'condition' 	=> ['title_normal_hover' => 'normal'],
			]
		);
        $this->add_control(
			'blog_title_margin',
			[
				'label'         => __( 'Title Margin', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .single-blog-item .blog-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition' 	=> ['title_normal_hover' => 'normal'],
			]
		);
        $this->add_control(
			'blog_title_padding',
			[
				'label'         => __( 'Title Padding', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .single-blog-item .blog-content h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition' 	=> ['title_normal_hover' => 'normal'],
			]
		);


        $this->add_control(
			'blog_title_color_hover',
			[
				'label'         => __( 'Title Color', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .single-blog-item .blog-content h3 a:hover' => 'color: {{VALUE}}',
				],
                'condition' 	=> ['title_normal_hover' => 'hover'],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'blog_title_text_shadow_hover',
				'label'         => __( 'Title Text Shadow', 'foodbook' ),
				'selector'      => '{{WRAPPER}} .single-blog-item .blog-content h3 a:hover',
                'condition' 	=> ['title_normal_hover' => 'hover'],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'          => 'blog_title_typography_hover',
				'label'         => __( 'Title Typography', 'foodbook' ),
				'selector'      => '{{WRAPPER}} .single-blog-item .blog-content h3 a:hover',
                'condition' 	=> ['title_normal_hover' => 'hover'],
			]
		);
        $this->add_control(
			'blog_title_margin_hover',
			[
				'label'         => __( 'Title Margin', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .single-blog-item .blog-content h3:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition' 	=> ['title_normal_hover' => 'hover'],
			]
		);
        $this->add_control(
			'blog_title_padding_hover',
			[
				'label'         => __( 'Title Padding', 'foodbook' ),
				'type'          => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .single-blog-item .blog-content h3:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition' 	=> ['title_normal_hover' => 'hover'],
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
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'button_text_shadow',
				'label' 		=> __( 'Button Text Shadow', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .single-blog-item .blog-content .btn-inline',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'label' 		=> __( 'Typography', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .single-blog-item .blog-content .btn-inline',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border',
				'label' 		=> __( 'Button Border', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .single-blog-item .blog-content .btn-inline',
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'button_text_color_hover',
			[
				'label' 		=> esc_html__( 'Button Text Color On Hover', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'button_text_shadow_hover',
				'label' 		=> __( 'Button Text Shadow On Hover', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .single-blog-item .blog-content .btn-inline:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography_hover',
				'label' 		=> __( 'Typography', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .single-blog-item .blog-content .btn-inline:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border_hover',
				'label' 		=> __( 'Button Border', 'foodbook' ),
				'selector' 		=> '{{WRAPPER}} .single-blog-item .blog-content .btn-inline:hover',
			]
		);
        $this->add_control(
			'button_special_border_bottom',
			[
				'label' 		=> esc_html__( 'Button Special Border Color On Hover', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline:after' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_background_color_hover',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_border_radius_hover',
			[
				'label' 		=> esc_html__( 'Button Border Radius', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_margin_hover',
			[
				'label' 		=> esc_html__( 'Margin', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_padding_hover',
			[
				'label' 		=> esc_html__( 'Padding', 'foodbook' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .single-blog-item .blog-content .btn-inline:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	// Output For User
	protected function render(){

		$settings = $this->get_settings_for_display();

        if( $settings['blog_column'] == 'two' ){
            $blog_column = 'col-lg-6';
        }elseif( $settings['blog_column'] == 'three' ){
            $blog_column = 'col-lg-4';
        }elseif( $settings['blog_column'] == 'four' ){
            $blog_column = 'col-lg-3';
        }else{
            $blog_column = 'col-lg-2';
        }

		if( $settings['post_from'] == "categories" ){
		   $blog = array(
			   'post_type'         => 'post',
			   'posts_per_page'    => esc_attr( $settings['post_limit'] ),
			   'order'             => esc_attr( $settings['order'] ),
			   'orderby'           => esc_attr( $settings['order_by'] ),
			   'tax_query'         => array(
					   array(
						   'taxonomy'  => 'category',
						   'field'     => 'slug',
						   'terms'     => $settings['categories'],
					   )
				   ),
		   );
		}else{
			$blog = array(
			   'post_type'         => 'post',
			   'posts_per_page'    => esc_attr( $settings['post_limit'] ),
			   'order'             => esc_attr( $settings['order'] ),
			   'orderby'           => esc_attr( $settings['order_by'] ),
		   );
		}

        $blog_post = new WP_Query( $blog );

        if( $blog_post->have_posts() ):
            echo '<div class="row justify-content-center">';
                while( $blog_post->have_posts() ):
                    $blog_post->the_post();
                    echo '<div class="'.esc_attr( $blog_column ).' col-sm-6">';
                        get_template_part( 'template-part/blog','widget' );
                    echo '</div>';
                endwhile;
                wp_reset_postdata();
            echo '</div>';
        endif;
	}
}