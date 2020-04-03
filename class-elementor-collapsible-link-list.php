<?php
/**
 * Class Elementor_Collapsible_Link_List_Widget
 * Custom elementor widget
 */

class Elementor_Collapsible_Link_List_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'elementor-collapsible-link-list';
	}

	public function get_title() {
		return __( 'Collapsible Link List', 'ecll' );
	}


    public function get_icon() {
		return 'eicon-post-list';
	}

    public function get_categories() {
        return [ 'general' ];
    }

	public function get_keywords() {
		return [ 'collapsible', 'list', 'link' ];
	}

	protected function _register_controls() {
		$this->_title_controls();
		$this->_expand_btn_controls();
		$this->_links_controls();

		$this->_title_styles_controls();
		$this->_expand_btn_styles_controls();
		$this->_link_styles_controls();
		$this->_link_name_styles_controls();
		$this->_link_description_styles_controls();
		$this->_link_icon_styles_controls();
	}

	protected function _title_controls() {
		$this->start_controls_section(
			'title_content',
			[
				'label' => __( 'Title', 'ecll' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title', [
				'label' => __( 'Title', 'ecll' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => __( 'Wahlen sie ihr gewunschtes PDF' , 'ecll' ),
			]
		);
		$this->add_control(
			'more_options',
			[
				'label' => __( 'Displayed if collapsible activity is available', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_icon_open',
			[
				'label' => __( 'Icon (Expanded)', 'ecll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-plus',
            		'library' => 'fa-solid'
				],
				'recommended' => [
					'fa-solid' => [
						'plus',
						'plus-square'
					],
					'fa-regular' => [
						'plus-square',
						'calendar-plus'
					],
				],
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ]
			]
		);
		$this->add_control(
			'title_icon_close',
			[
				'label' => __( 'Icon (Collapsed)', 'ecll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-minus',
            		'library' => 'fa-solid'
				],
				'recommended' => [
					'fa-solid' => [
						'calendar-minus',
						'minus-square'
					],
					'fa-regular' => [
						'minus',
						'minus-square',
						'minus-circle'
					],
				],
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ]
			]
		);
		$this->end_controls_section();
	}
	protected function _expand_btn_controls() {
		$this->start_controls_section(
			'expand_btn_content',
			[
				'label' => __( 'Expand Button', 'ecll' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'expand_text', [
				'label' => __( 'Expand text', 'ecll' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Show more' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'collapse_text', [
				'label' => __( 'Collapse text', 'ecll' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Show less' ),
				'label_block' => true,
			]
		);
		$this->end_controls_section();
	}

	protected function _links_controls() {
		$this->start_controls_section(
			'links_content',
			[
				'label' => __( 'Links', 'ecll' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'expand_limit', [
				'label' => __( 'Initial links to display', 'ecll' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'description' => __( '-1 to display all, 0 to hide all' ),
				'label_block' => false,
				'default' => 2
			]
		);
		$this->add_control(
			'list_state',
			[
				'label' => __( 'List State', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'expanded' => __( 'Expanded', 'ecll' ),
					'collapsed' => __( 'Collapsed', 'ecll' )
				],
				'default' => 'collapsed'
			]
		);

		$this->add_control(
			'link_icon',
			[
				'label' => __( 'Link Icon', 'ecll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-download',
            		'library' => 'fa-solid'
				],
				'recommended' => [
					'fa-solid' => [
						'download',
						'file-download',
						'cloud-download-alt',
						'arrow-alt-circle-down',
						'arrow-circle-down',
						'arrow-down'
					],
					'fa-regular' => [
						'arrow-alt-circle-down',
						'minus-circle'
					],
				],
				'separator' => 'before',
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ]
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label' => __( 'Name', 'ecll' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Link Name' , 'ecll' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'description', [
				'label' => __( 'Description', 'ecll' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Link Description' , 'ecll' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'link', [
				'label' => __( 'Link', 'ecll' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => true,
				],
			]
		);
		$repeater->add_control(
			'link_icon',
			[
				'label' => __( 'Link Icon', 'ecll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'recommended' => [
					'fa-solid' => [
						'download',
						'file-download',
						'cloud-download-alt',
						'arrow-alt-circle-down',
						'arrow-circle-down',
						'arrow-down'
					],
					'fa-regular' => [
						'arrow-alt-circle-down',
						'minus-circle'
					],
				],
				'separator' => 'before',
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ]
			]
		);

		$this->add_control(
			'links',
			[
				'label' => __( 'Links', 'ecll' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'Link #1', 'ecll' ),
						'description' => __( 'Link description.', 'ecll' ),
					],
					[
						'name' => __( 'Link #2', 'ecll' ),
						'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'ecll' ),
					],
					[
						'name' => __( 'Link #3', 'ecll' ),
						'description' => __( 'Lorem ipsum dolor sit amet.', 'ecll' ),
					],
					[
						'name' => __( 'Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet', 'ecll' ),
						'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 'ecll' ),
					],
					[
						'name' => __( 'Link #5', 'ecll' ),
						'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'ecll' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();
	}
	protected function _title_styles_controls() {
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_text_alignment',
			[
				'label' => __( 'Text Alignment', 'elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					]
				],
				'default' => 'left'
			]
		);
		$this->add_control(
			'title_icon_alignment',
			[
				'label' => __( 'Icon Alignment', 'elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					]
				],
				'default' => 'right'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_text_typography',
				'label' => __('Text typography'),
				'selector' => '{{WRAPPER}} .ecll-title-text',
				'fields_options' => [
					'font_style' => [
						'default' => 'italic',
					]
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_icon_typography',
				'label' => __('Icon typography'),
				'selector' => '{{WRAPPER}} .ecll-title-icon',
				'fields_options' => [
					'font_family' => [
						'default' => 'default',
						'condition' => [
				            'not' => 'equal'
				        ]
					],
					'text_transform' => [
						'default' => 'default',
						'condition' => [
				            'not' => 'equal'
				        ]
					],
					'letter_spacing' => [
						'condition' => [
				            'not' => 'equal'
				        ]
					],
					'font_style' => [
						'condition' => [
				            'not' => 'equal'
				        ]
					],
					'text_decoration' => [
						'condition' => [
				            'not' => 'equal'
				        ]
					],
					'line_height' => [
						'condition' => [
				            'not' => 'equal'
				        ]
					]
				]
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .ecll-title',
				'separator' => 'before',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '0',
							'right' => '0',
							'bottom' => '0',
							'left' => '0',
							'isLinked' => false,
						],
					]
				]
			]
		);

		$this->add_control(
			'title_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 0,
		            'left' => 0,
		            'isLinked' => 1
		        ]
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

        $this->add_control(
			'title_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ecll-title-text, {{WRAPPER}} .ecll-title-icon' => 'color: {{VALUE}};',
				],
				'default' => '#fff'
			]
		);
		$this->add_control(
			'title_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .ecll-title' => 'background-color: {{VALUE}};',
				],
				'default' => '#3b4961'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_box_shadow',
				'selector' => '{{WRAPPER}} .ecll-title',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);
        $this->add_control(
			'title_text_color_hover',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ecll-title:hover .ecll-title-text, {{WRAPPER}} .ecll-title:hover .ecll-title-icon' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_background_color_hover',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ecll-title:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_border_color_hover',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ecll-title:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_box_shadow_hover',
				'selector' => '{{WRAPPER}} .ecll-title',
			]
		);
        $this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'default' => [
		            'unit' => 'px',
		            'top' => 20,
		            'right' => 20,
		            'bottom' => 20,
		            'left' => 20,
		            'isLinked' => 1
		        ]
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'default' => [
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 4,
		            'left' => 0,
		            'isLinked' => false
				]
			]
		);

        $this->end_controls_section();
	}
	protected function _link_styles_controls() {
        $this->start_controls_section(
			'link_style',
			[
				'label' => __( 'Link', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);



        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'link_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .ecll-link-link',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.ecll-link-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 0,
		            'left' => 0,
		            'isLinked' => 1
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'link_box_shadow',
				'selector' => '{{WRAPPER}} a.ecll-link-link',
				'default' => [
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 0,
		            'left' => 0,
		            'isLinked' => 1
		        ]
			]
		);


        $this->start_controls_tabs( 'tabs_link_style' );
		$this->start_controls_tab(
			'tab_link_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

        $this->add_control(
			'link_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ecll-link-name, {{WRAPPER}} .ecll-link-description, {{WRAPPER}} .ecll-link-icon' => 'color: {{VALUE}};',
				],
				'default' => '#54595F'
			]
		);
		$this->add_control(
			'link_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} a.ecll-link-link' => 'background-color: {{VALUE}};',
				],
				'default' => '#fff'
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_link_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);
        $this->add_control(
			'link_hover_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ecll-link-link:hover .ecll-link-name, {{WRAPPER}} .ecll-link-link:hover .ecll-link-description, {{WRAPPER}} .ecll-link-link:hover .ecll-link-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_hover_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.ecll-link-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.ecll-link-link:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'link_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.ecll-link-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'default' => [
		            'unit' => 'px',
		            'top' => 20,
		            'right' => 20,
		            'bottom' => 20,
		            'left' => 20,
		            'isLinked' => 1
				]
			]
		);

		$this->add_responsive_control(
			'link_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.ecll-link-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'default' => [
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 4,
		            'left' => 0,
		            'isLinked' => false
		        ]
			]
		);

        $this->end_controls_section();
    }
	protected function _link_name_styles_controls() {
        $this->start_controls_section(
			'link_name_style',
			[
				'label' => __( 'Link Name', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'name_width', [
				'label' => __( 'Link Name Width', 'ecll' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw' ],
				'description' => __( 'control the width of name column', 'ecll' ),
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 600,
					],
					'vw' => [
						'min' => 1,
						'max' => 60,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ecll-link-name' => 'min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_name_typography',
				'label' => __('Name typography'),
				'selector' => '{{WRAPPER}} .ecll-link-name',
			]
		);
		$this->add_control(
			'link_name_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-link-name' => 'margin-right: {{RIGHT}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'horizontal',
				'separator' => 'before',
				'default' => [
		            'unit' => 'px',
		            'right' => 10,
		            'left' => 0,
		            'isLinked' => false
		        ]
			]
		);
		$this->end_controls_section();
	}
	protected function _link_description_styles_controls() {
        $this->start_controls_section(
			'link_description_style',
			[
				'label' => __( 'Link Description', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_description_typography',
				'label' => __('Description typography'),
				'selector' => '{{WRAPPER}} .ecll-link-description',
			]
		);
		$this->add_control(
			'link_description_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-link-description' => 'margin-right: {{RIGHT}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'horizontal',
				'separator' => 'before',
				'default' => [
		            'unit' => 'px',
		            'right' => 0,
		            'left' => 0,
		            'isLinked' => false
				]
			]
		);
		$this->end_controls_section();
	}
	protected function _link_icon_styles_controls() {
        $this->start_controls_section(
			'link_icon_style',
			[
				'label' => __( 'Link Icon', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_icon_typography',
				'label' => __('Icon typography'),
				'selector' => '{{WRAPPER}} .ecll-link-icon',
				'fields_options' => [
					'font_family' => [
						'default' => 'default',
						'condition' => [
				            'not' => 'equal'
				        ]
					],
					'text_transform' => [
						'default' => 'default',
						'condition' => [
				            'not' => 'equal'
				        ]
					],
					'letter_spacing' => [
						'condition' => [
				            'not' => 'equal'
				        ]
					],
					'font_style' => [
						'condition' => [
				            'not' => 'equal'
				        ]
					],
					'text_decoration' => [
						'condition' => [
				            'not' => 'equal'
				        ]
					],
					'line_height' => [
						'condition' => [
				            'not' => 'equal'
				        ]
					]
				]
			]
		);
		$this->add_control(
			'link_icon_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-link-icon' => 'margin-right: {{RIGHT}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'horizontal',
				'separator' => 'before',
				'default' => [
		            'unit' => 'px',
		            'right' => 0,
		            'left' => 20,
		            'isLinked' => false
				]
			]
		);
		$this->end_controls_section();
	}
	protected function _expand_btn_styles_controls() {
		$this->start_controls_section(
			'expand_style',
			[
				'label' => __( 'Expand Button', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'expand_typography',
				'label' => __('Typography'),
				'selector' => '{{WRAPPER}} .ecll-expand-btn',
				/*
				'fields_options' => [
					'font_style' => [
						'default' => 'italic',
					]
				]*/
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'expand_border',
				'selector' => '{{WRAPPER}} .ecll-expand-btn',
				'separator' => 'before',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '0',
							'right' => '0',
							'bottom' => '0',
							'left' => '0',
							'isLinked' => false,
						],
					]
				]
			]
		);

		$this->add_control(
			'expand_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-expand-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 0,
		            'left' => 0,
		            'isLinked' => 1
				]
			]
		);

		$this->start_controls_tabs( 'tabs_expand_style' );
		$this->start_controls_tab(
			'tab_expand_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

        $this->add_control(
			'expand_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ecll-expand-btn' => 'color: {{VALUE}};',
				],
				'default' => '#fff'
			]
		);
		$this->add_control(
			'expand_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .ecll-expand-btn' => 'background-color: {{VALUE}};',
				],
				'default' => '#3b4961'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'expand_box_shadow',
				'selector' => '{{WRAPPER}} .ecll-expand-btn',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_expand_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);
        $this->add_control(
			'expand_text_color_hover',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ecll-expand-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'expand_background_color_hover',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ecll-expand-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'expand_border_color_hover',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ecll-expand-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'expand_box_shadow_hover',
				'selector' => '{{WRAPPER}} .ecll-expand-btn',
			]
		);
        $this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'expand_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-expand-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'default' => [
		            'unit' => 'px',
		            'top' => 15,
		            'right' => 20,
		            'bottom' => 15,
		            'left' => 20,
		            'isLinked' => false
				]
			]
		);

		$this->add_responsive_control(
			'expand_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-expand-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'default' => [
		            'unit' => 'px',
		            'top' => 10,
		            'right' => 0,
		            'bottom' => 0,
		            'left' => 0,
		            'isLinked' => false
				]
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		#print_r($settings['links']);
		#die();

		$collapsible = false;
		if ( $settings['expand_limit'] == -1 || $settings['expand_limit'] > $settings['links'] ) {
			$settings['expand_limit'] = count( $settings['links'] );
		}
		if ( count( $settings['links'] ) > $settings['expand_limit'] ) {
			$collapsible = true;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'ecll-wrap' );

		$this->add_render_attribute( 'title-text', 'class', [ 'ecll-title-text' ] );
		if ( ! empty( $settings['title_text_alignment'] ) ) {
			$this->add_render_attribute( 'title-text', 'class', [ 'ecll-align-'. $settings['title_text_alignment'] ] );
		}

		$this->add_render_attribute( 'title-icon', 'class', [ 'ecll-title-icon' ] );
		if ( ! empty( $settings['title_icon_alignment'] ) ) {
			$this->add_render_attribute( 'title-icon', 'class', [ 'ecll-align-icon-'. $settings['title_icon_alignment'] ] );
		}

		$this->add_render_attribute( 'title-icon-open', 'class', [ $settings['title_icon_open']['value'], 'ecll-expanded-icon' ] );
		$this->add_render_attribute( 'title-icon-close', 'class', [ $settings['title_icon_close']['value'], 'ecll-collapsed-icon' ] );

		$this->add_render_attribute( 'hidden-links', 'class', 'ecll-hidden-links' );

		if ( $collapsible ) {
			if ( 'expanded' === $settings['list_state'] ) {
				$this->add_render_attribute( 'wrapper', 'class', 'ecll-open' );
				$this->add_render_attribute( 'title-icon-open', 'style', 'display:none' );
				$this->add_render_attribute( 'expand-text', 'style', 'display:none' );
			} else {
				$this->add_render_attribute( 'title-icon-close', 'style', 'display:none' );
				$this->add_render_attribute( 'hidden-links', 'style', 'display:none' );
				$this->add_render_attribute( 'collapse-text', 'style', 'display:none' );
			}
		}

		$this->add_render_attribute( 'link-link', 'class', [ 'ecll-link-link' ] );

		$this->add_render_attribute( 'expand-text', 'class', 'ecll-expand-text' );
		$this->add_render_attribute( 'collapse-text', 'class', 'ecll-collapse-text' );

		$primary_links = array_slice( $settings['links'], 0, $settings['expand_limit'] );

		?><div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<div class="ecll-title">
				<div class="ecll-content-wrapper">
					<?php if ( $collapsible ) : ?>
					<button <?php echo $this->get_render_attribute_string( 'title-icon' ); ?>>
						<i <?php echo $this->get_render_attribute_string( 'title-icon-open' ); ?>></i>
						<i <?php echo $this->get_render_attribute_string( 'title-icon-close' ); ?>></i>
					</button>
					<?php endif; ?>
					<div <?php echo $this->get_render_attribute_string( 'title-text' ); ?>>
						<?php echo $settings['title']; ?>
					</div>
				</div>
			</div>
			<?php if ( ! empty( $primary_links ) ) : ?>
				<ul class="ecll-primary-links">
				<?php
				foreach ( $primary_links as $index => $item ) :
					if ( empty( $item['link']['url'] ) ) {
						continue;
					}

					$link_icon = ! empty( $item['link_icon']['value'] ) ? $item['link_icon']['value'] : $settings['link_icon']['value'];

					?>
					<li class="ecll-link-item elementor-repeater-item-<?php echo $item['_id']; ?>">
						<a <?php echo $this->get_render_attribute_string( 'link-link' ); ?> href="<?php echo esc_url( $item['link']['url'] ); ?>">
							<div class="ecll-content-wrapper">
								<div class="ecll-link-name"><?php echo $item['name']; ?></div>
								<div class="ecll-link-description"><?php echo $item['description']; ?></div>
								<div class="ecll-link-icon"><i class="<?php echo $link_icon; ?>"></i></div>
							</div>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if ( $collapsible ) : ?>
				<ul <?php echo $this->get_render_attribute_string( 'hidden-links' ); ?>>
				<?php
				foreach ( array_slice( $settings['links'], $settings['expand_limit'] ) as $index => $item ) :
					if ( empty( $item['link']['url'] ) ) {
						continue;
					}

					$link_icon = ! empty( $item['link_icon']['value'] ) ? $item['link_icon']['value'] : $settings['link_icon']['value'];
					?>
					<li class="ecll-link-item elementor-repeater-item-<?php echo $item['_id']; ?>">
						<a <?php echo $this->get_render_attribute_string( 'link-link' ); ?> href="<?php echo esc_url( $item['link']['url'] ); ?>">
							<div class="ecll-content-wrapper">
								<div class="ecll-link-name"><?php echo $item['name']; ?></div>
								<div class="ecll-link-description"><?php echo $item['description']; ?></div>
								<div class="ecll-link-icon"><i class="<?php echo $link_icon; ?>"></i></div>
							</div>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
				<div class="ecll-expand-wrapper">
					<button class="ecll-expand-btn" type="button">
						<span <?php echo $this->get_render_attribute_string( 'expand-text' ); ?>><?php echo $settings['expand_text']; ?></span>
						<span <?php echo $this->get_render_attribute_string( 'collapse-text' ); ?>><?php echo $settings['collapse_text']; ?></span>
					</button>
				</div>
			<?php endif; ?>
		</div>

		<?php
		# echo '<pre>'; print_r($settings); echo '</pre>';
	}

	protected function content_template() {
		?>
		<#
		if ( settings.expand_limit == -1 || settings.expand_limit > settings.links.length ) {
			settings.expand_limit = settings.links.length;
		}
		var collapsible = false;
		if ( settings.links.length > settings.expand_limit ) {
			collapsible = true;
		}

		view.addRenderAttribute('wrapper',{
			'class': [ 'ecll-wrap' ]
		});

		view.addRenderAttribute('title-text',{
			'class': [ 'ecll-title-text' ],
		});
		if ( settings.title_text_alignment ) {
			view.addRenderAttribute('title-text',{
				'class': [ 'ecll-align-' + settings.title_text_alignment ],
			});
		}

		view.addRenderAttribute('title-icon',{
			'class': [ 'ecll-title-icon' ]
		});
		if ( settings.title_icon_alignment ) {
			view.addRenderAttribute('title-icon',{
				'class': [ 'ecll-align-icon-' + settings.title_icon_alignment ]
			});
		}

		view.addRenderAttribute('title-icon-open',{
			'class': [ settings.title_icon_open.value, 'ecll-expanded-icon' ]
		});
		view.addRenderAttribute('title-icon-close',{
			'class': [ settings.title_icon_close.value, 'ecll-collapsed-icon' ]
		});

		view.addRenderAttribute('hidden-links',{
			'class': [ 'ecll-hidden-links' ]
		});

		if ( 'expanded' === settings.list_state ) {
			view.addRenderAttribute('wrapper',{
				'class': [ 'ecll-open' ]
			});
			view.addRenderAttribute('title-icon-open',{
				'style': [ 'display:none' ]
			});
			view.addRenderAttribute('expand-text',{
				'style': [ 'display:none' ]
			});
		} else {
			view.addRenderAttribute('title-icon-close',{
				'style': [ 'display:none' ]
			});
			view.addRenderAttribute('hidden-links',{
				'style': [ 'display:none' ]
			});
			view.addRenderAttribute('collapse-text',{
				'style': [ 'display:none' ]
			});
		}

		view.addRenderAttribute('link-link',{
			'class': [ 'ecll-link-link' ],
		});

		view.addRenderAttribute('expand-text',{
			'class': [ 'ecll-expand-text' ],
		});
		view.addRenderAttribute('collapse-text',{
			'class': [ 'ecll-collapse-text' ],
		});

		var primary_links = settings.links.slice(0, settings.expand_limit );
		#>

		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
			<div class="ecll-title">
				<div class="ecll-content-wrapper">
					<# if ( collapsible ) { #>
					<button {{{ view.getRenderAttributeString( 'title-icon' ) }}} type="button">
						<i {{{ view.getRenderAttributeString( 'title-icon-open' ) }}}></i>
						<i {{{ view.getRenderAttributeString( 'title-icon-close' ) }}}></i>
					</button>
					<# } #>
					<div {{{ view.getRenderAttributeString( 'title-text' ) }}}>
						{{{ settings.title }}}
					</div>
				</div>
			</div>

			<# if (primary_links.length > 0) { #>
				<ul class="ecll-primary-links">
				<#
					_.each( primary_links, function( item, index ) {
						let link_icon = item.link_icon.value ? item.link_icon.value : settings.link_icon.value;
					#>
					<li class="ecll-link-item elementor-repeater-item-{{{ item._id }}}">
						<a {{{ view.getRenderAttributeString( 'link-link' ) }}} href="{{{ item.link.url }}}">
							<div class="ecll-content-wrapper">
								<div class="ecll-link-name" >{{{ item.name }}}</div>
								<div class="ecll-link-description">{{{ item.description }}}</div>
								<div class="ecll-link-icon"><i class="{{{ link_icon }}}"></i></div>
							</div>
						</a>
					</li>
					<#
					} );
				#>
				</ul>
			<# } #>
			<#
			if ( collapsible ) {
				#>
				<ul {{{ view.getRenderAttributeString( 'hidden-links' ) }}}>
					<#
					_.each( settings.links.slice(settings.expand_limit), function( item, index ) {
						let link_icon = item.link_icon.value ? item.link_icon.value : settings.link_icon.value;
						#>
					<li class="ecll-link-item elementor-repeater-item-{{{ item._id }}}">
						<a {{{ view.getRenderAttributeString( 'link-link' ) }}} href="{{{ item.link.url }}}">
							<div class="ecll-content-wrapper">
								<div class="ecll-link-name">{{{ item.name }}}</div>
								<div class="ecll-link-description">{{{ item.description }}}</div>
								<div class="ecll-link-icon"><i class="{{{ link_icon }}}"></i></div>
							</div>
						</a>
					</li>
					<#
					} );
				#>
				</ul>
				<div class="ecll-expand-wrapper">
					<button class="ecll-expand-btn" type="button">
						<span {{{ view.getRenderAttributeString( 'expand-text' ) }}}>{{{ settings.expand_text }}}</span>
						<span {{{ view.getRenderAttributeString( 'collapse-text' ) }}}>{{{ settings.collapse_text }}}</span>
					</button>
				</div>
				<#
			}
			#>
		</div>
		<?php
	}
}
