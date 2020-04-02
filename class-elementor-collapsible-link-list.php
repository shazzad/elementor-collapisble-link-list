<?php
/**
 * Class Elementor_Collapsible_Link_List_Widget
 * Custom elementor widget
 */

class Elementor_Collapsible_Link_List_Widget extends \Elementor\Widget_Base {

	/**
	 * Get Name
	 *
	 * Return the action name
	 *
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'elementor-collapsible-link-list';
	}

	/**
	 * Get Label
	 *
	 * Returns the action label
	 *
	 * @access public
	 * @return string
	 */
	public function get_title() {
		return __( 'Collapsible Link List', 'ecll' );
	}


    public function get_icon() {
		return 'eicon-post-list';
	}

    public function get_categories() {
        return ['general'];
    }

	public function get_keywords() {
		return ['collapsible', 'list', 'download'];
	}

	/**
	 * Register Settings Section
	 *
	 * Registers the Action controls
	 *
	 * @access public
	 * @param \Elementor\Widget_Base $widget
	 */
	protected function _register_controls() {
		$this->_title_controls();
		$this->_downloads_controls();
		$this->_expand_controls();

		$this->_title_styles_controls();
		$this->_download_name_styles_controls();
		$this->_download_description_styles_controls();
		$this->_download_icon_styles_controls();
		$this->_download_item_styles_controls();
		$this->_expand_styles_controls();
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
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Title' , 'ecll' ),
			]
		);
		$this->add_control(
			'title_state',
			[
				'label' => __( 'Title State', 'elementor' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'open' => __( 'Open', 'elementor' ),
					'close' => __( 'Close', 'elementor' )
				],
				'default' => 'open'
			]
		);
		$this->add_control(
			'title_icon_open',
			[
				'label' => __( 'Icon (Open)', 'ecll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'fas fa-plus',
            		'library' => 'fa-solid'
				),
				'skin' => 'inline',
				'exclude_inline_options' => array( 'svg' )
			]
		);
		$this->add_control(
			'title_icon_close',
			[
				'label' => __( 'Icon (Close)', 'ecll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'fas fa-minus',
            		'library' => 'fa-solid'
				),
				'skin' => 'inline',
				'exclude_inline_options' => array( 'svg' )
			]
		);
		$this->end_controls_section();
	}
	protected function _downloads_controls() {
		$this->start_controls_section(
			'downloads_content',
			[
				'label' => __( 'Downloads', 'ecll' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'download_icon',
			[
				'label' => __( 'Download Icon', 'ecll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'fas fa-arrow-down',
            		'library' => 'fa-solid'
				),
				'skin' => 'inline',
				'exclude_inline_options' => array( 'svg' )
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label' => __( 'Name', 'ecll' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Download Name' , 'ecll' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'description', [
				'label' => __( 'Description', 'ecll' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Download Description' , 'ecll' ),
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
			'icon', [
				'label' => __( 'Icon', 'ecll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'skin' => 'inline',
				'exclude_inline_options' => array( 'svg' )
			]
		);

		$this->add_control(
			'downloads',
			[
				'label' => __( 'Downloads', 'ecll' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'show_label' => false,
				'default' => [
					[
						'name' => __( 'Download #1', 'ecll' ),
						'description' => __( 'Download description.', 'ecll' ),
					],
					[
						'name' => __( 'Download #2', 'ecll' ),
						'description' => __( 'Some description.', 'ecll' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();
	}
	protected function _expand_controls() {
		$this->start_controls_section(
			'expand_content',
			[
				'label' => __( 'Expand', 'ecll' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'expand_limit', [
				'label' => __( 'Initial downloads to display', 'ecll' ),
				'description' => __( 'Use -1 to display all' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 0,
				'label_block' => true,
			]
		);
		$this->add_control(
			'expand_text', [
				'label' => __( 'Expand text', 'ecll' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Load more' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'shrink_text', [
				'label' => __( 'Shrink text', 'ecll' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Show less' ),
				'label_block' => true,
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

		$this->add_responsive_control(
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
		$this->add_responsive_control(
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
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => array(
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 0,
		            'left' => 0,
		            'isLinked' => 1
		        )
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
				'default' => array(
		            'unit' => 'px',
		            'top' => 20,
		            'right' => 20,
		            'bottom' => 20,
		            'left' => 20,
		            'isLinked' => 1
		        )
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
				'default' => array(
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 4,
		            'left' => 0,
		            'isLinked' => false
		        )
			]
		);

        $this->end_controls_section();
	}
	protected function _download_item_styles_controls() {
        $this->start_controls_section(
			'download_style',
			[
				'label' => __( 'Download Item', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);



        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'download_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .ecll-download-link',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'download_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.ecll-download-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => array(
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 0,
		            'left' => 0,
		            'isLinked' => 1
		        )
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'download_box_shadow',
				'selector' => '{{WRAPPER}} a.ecll-download-link',
				'default' => array(
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 0,
		            'left' => 0,
		            'isLinked' => 1
		        )
			]
		);


        $this->start_controls_tabs( 'tabs_download_style' );
		$this->start_controls_tab(
			'tab_download_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

        $this->add_control(
			'download_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ecll-download-name, {{WRAPPER}} .ecll-download-description, {{WRAPPER}} .ecll-download-icon' => 'color: {{VALUE}};',
				],
				'default' => '#54595F'
			]
		);
		$this->add_control(
			'download_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} a.ecll-download-link' => 'background-color: {{VALUE}};',
				],
				'default' => '#fff'
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_download_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);
        $this->add_control(
			'download_hover_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ecll-download-link:hover .ecll-download-name, {{WRAPPER}} .ecll-download-link:hover .ecll-download-description, {{WRAPPER}} .ecll-download-link:hover .ecll-download-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'download_hover_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.ecll-download-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'download_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.ecll-download-link:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'download_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.ecll-download-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'default' => array(
		            'unit' => 'px',
		            'top' => 20,
		            'right' => 20,
		            'bottom' => 20,
		            'left' => 20,
		            'isLinked' => 1
		        )
			]
		);

		$this->add_responsive_control(
			'download_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.ecll-download-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'default' => array(
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 4,
		            'left' => 0,
		            'isLinked' => false
		        )
			]
		);

        $this->end_controls_section();
    }
	protected function _download_name_styles_controls() {
        $this->start_controls_section(
			'download_name_style',
			[
				'label' => __( 'Download Item Name', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'download_name_typography',
				'label' => __('Name typography'),
				'selector' => '{{WRAPPER}} .ecll-download-name',
			]
		);
		$this->add_control(
			'download_name_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-download-name' => 'margin-right: {{RIGHT}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'horizontal',
				'separator' => 'before',
				'default' => array(
		            'unit' => 'px',
		            'right' => 0,
		            'left' => 0,
		            'isLinked' => false
		        )
			]
		);
		$this->end_controls_section();
	}
	protected function _download_description_styles_controls() {
        $this->start_controls_section(
			'download_description_style',
			[
				'label' => __( 'Download Item Description', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'download_description_typography',
				'label' => __('Description typography'),
				'selector' => '{{WRAPPER}} .ecll-download-description',
			]
		);
		$this->add_control(
			'download_description_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-download-description' => 'margin-right: {{RIGHT}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'horizontal',
				'separator' => 'before',
				'default' => array(
		            'unit' => 'px',
		            'right' => 0,
		            'left' => 0,
		            'isLinked' => false
		        )
			]
		);
		$this->end_controls_section();
	}
	protected function _download_icon_styles_controls() {
        $this->start_controls_section(
			'download_icon_style',
			[
				'label' => __( 'Download Item Icon', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'download_icon_typography',
				'label' => __('Icon typography'),
				'selector' => '{{WRAPPER}} .ecll-download-icon',
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
					]
				]
			]
		);
		$this->add_control(
			'download_icon_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ecll-download-icon' => 'margin-right: {{RIGHT}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'horizontal',
				'separator' => 'before',
				'default' => array(
		            'unit' => 'px',
		            'right' => 0,
		            'left' => 0,
		            'isLinked' => false
		        )
			]
		);
		$this->end_controls_section();
	}
	protected function _expand_styles_controls() {
		$this->start_controls_section(
			'expand_style',
			[
				'label' => __( 'Load more', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'expand_typography',
				'label' => __('Typography'),
				'selector' => '{{WRAPPER}} .ecll-title-text',
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
				'default' => array(
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 0,
		            'left' => 0,
		            'isLinked' => 1
		        )
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
				'default' => array(
		            'unit' => 'px',
		            'top' => 20,
		            'right' => 20,
		            'bottom' => 20,
		            'left' => 20,
		            'isLinked' => 1
		        )
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
				'default' => array(
		            'unit' => 'px',
		            'top' => 0,
		            'right' => 0,
		            'bottom' => 4,
		            'left' => 0,
		            'isLinked' => false
		        )
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['expand_limit'] == -1 || $settings['expand_limit'] > $settings['downloads'] ) {
			$settings['expand_limit'] = count( $settings['downloads'] );
		}

		$this->add_render_attribute( 'wrapper', 'class', 'ecll-wrap' );

		$this->add_render_attribute( 'title-text', 'class', array( 'ecll-title-text' ) );
		if ( ! empty( $settings['title_text_alignment'] ) ) {
			$this->add_render_attribute( 'title-text', 'class', array( 'ecll-align-'. $settings['title_text_alignment'] ) );
		}
		$this->add_render_attribute( 'title-icon', 'class', array( 'ecll-title-icon' ) );
		if ( ! empty( $settings['title_icon_alignment'] ) ) {
			$this->add_render_attribute( 'title-icon', 'class', array( 'ecll-align-icon-'. $settings['title_icon_alignment'] ) );
		}
		$this->add_render_attribute( 'title-icon-open', 'class', array( $settings['title_icon_open']['value'], 'open-icon' ) );
		$this->add_render_attribute( 'title-icon-close', 'class', array( $settings['title_icon_close']['value'], 'close-icon' ) );

		$this->add_render_attribute( 'hidden-downloads', 'class', 'ecll-hidden-downloads' );

		if ( 'open' === $settings['title_state'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'ecll-open' );
			$this->add_render_attribute( 'title-icon-open', 'style', 'display:none' );
			$this->add_render_attribute( 'expand-text', 'style', 'display:none' );
		} else {
			$this->add_render_attribute( 'title-icon-close', 'style', 'display:none' );
			$this->add_render_attribute( 'hidden-downloads', 'style', 'display:none' );
			$this->add_render_attribute( 'shrink-text', 'style', 'display:none' );
		}

		$this->add_render_attribute( 'download-list-item', 'class', array( 'ecll-download-item' ) );
		$this->add_render_attribute( 'download-link', 'class', array( 'ecll-download-link' ) );

		$this->add_render_attribute( 'expand-text', 'class', 'ecll-expand-text' );
		$this->add_render_attribute( 'shrink-text', 'class', 'ecll-shrink-text' );


		?><div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<button class="ecll-title">
				<span class="ecll-title-content-wrapper">
					<span <?php echo $this->get_render_attribute_string( 'title-icon' ); ?>>
						<i <?php echo $this->get_render_attribute_string( 'title-icon-open' ); ?>></i>
						<i <?php echo $this->get_render_attribute_string( 'title-icon-close' ); ?>></i>
					</span>
					<span <?php echo $this->get_render_attribute_string( 'title-text' ); ?>>
						<?php echo $settings['title']; ?>
					</span>
				</span>
			</button>
			<ul class="ecll-primary-downloads">
			<?php
			foreach ( array_slice( $settings['downloads'], 0, $settings['expand_limit'] ) as $index => $item ) :
				if ( empty( $item['link']['url'] ) ) {
					continue;
				}

				$download_icon = ! empty( $item['icon']['value'] ) ? $item['icon']['value'] : $settings['download_icon']['value'];
				?>
				<li <?php echo $this->get_render_attribute_string( 'download-list-item' ); ?>>
					<a <?php echo $this->get_render_attribute_string( 'download-link' ); ?> href="<?php echo esc_url( $item['link']['url'] ); ?>">
						<span class="ecll-title-content-wrapper">
							<span class="ecll-download-icon">
								<i class="<?php echo $download_icon; ?>"></i>
							</span>
							<span class="ecll-download-name"><?php echo $item['name']; ?></span>
							<span class="ecll-download-description"><?php echo $item['description']; ?></span>
						</span>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>

			<?php if ( count( $settings['downloads'] ) > $settings['expand_limit'] ) : ?>
				<ul <?php echo $this->get_render_attribute_string( 'hidden-downloads' ); ?>>
				<?php
				foreach ( array_slice( $settings['downloads'], $settings['expand_limit'] ) as $index => $item ) :
					if ( empty( $item['link']['url'] ) ) {
						continue;
					}

					$download_icon = ! empty( $item['icon']['value'] ) ? $item['icon']['value'] : $settings['download_icon']['value'];
					?>
					<li <?php echo $this->get_render_attribute_string( 'download-list-item' ); ?>>
						<a <?php echo $this->get_render_attribute_string( 'download-link' ); ?> href="<?php echo esc_url( $item['link']['url'] ); ?>">
							<span class="ecll-title-content-wrapper">
								<span class="ecll-download-icon">
									<i class="<?php echo $download_icon; ?>"></i>
								</span>
								<span class="ecll-download-name"><?php echo $item['name']; ?></span>
								<span class="ecll-download-description"><?php echo $item['description']; ?></span>
							</span>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
				<div class="ecll-expand-wrapper">
					<button class="ecll-expand-btn" type="button">
						<span <?php echo $this->get_render_attribute_string( 'expand-text' ); ?>><?php echo $settings['expand_text']; ?></span>
						<span <?php echo $this->get_render_attribute_string( 'shrink-text' ); ?>><?php echo $settings['shrink_text']; ?></span>
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
		if ( settings.expand_limit == -1 || settings.expand_limit > settings.downloads.length ) {
			settings.expand_limit = settings.downloads.length;
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
			'class': [ settings.title_icon_open.value, 'open-icon' ]
		});
		view.addRenderAttribute('title-icon-close',{
			'class': [ settings.title_icon_close.value, 'close-icon' ]
		});

		view.addRenderAttribute('hidden-downloads',{
			'class': [ 'ecll-hidden-downloads' ]
		});

		if ( 'open' === settings.title_state ) {
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
			view.addRenderAttribute('hidden-downloads',{
				'style': [ 'display:none' ]
			});
			view.addRenderAttribute('shrink-text',{
				'style': [ 'display:none' ]
			});
		}

		view.addRenderAttribute('download-list-item',{
			'class': [ 'ecll-download-item' ]
		});
		view.addRenderAttribute('download-link',{
			'class': [ 'ecll-download-link' ],
		});

		view.addRenderAttribute('expand-text',{
			'class': [ 'ecll-expand-text' ],
		});
		view.addRenderAttribute('shrink-text',{
			'class': [ 'ecll-shrink-text' ],
		});
		#>

		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
			<button class="ecll-title">
				<span class="ecll-title-content-wrapper">
					<span {{{ view.getRenderAttributeString( 'title-icon' ) }}}>
						<i {{{ view.getRenderAttributeString( 'title-icon-open' ) }}}></i>
						<i {{{ view.getRenderAttributeString( 'title-icon-close' ) }}}></i>
					</span>
					<span {{{ view.getRenderAttributeString( 'title-text' ) }}}>
						{{{ settings.title }}}
					</span>
				</span>
			</button>

			<ul class="ecll-primary-downloads">
				<#
				if ( settings.downloads ) {
					_.each( settings.downloads.slice(0, settings.expand_limit), function( item, index ) {
						let download_icon = item.icon.value ? item.icon.value : settings.download_icon.value;
					#>
				<li {{{ view.getRenderAttributeString( 'download-list-item' ) }}}>
					<a {{{ view.getRenderAttributeString( 'download-link' ) }}} href="{{{ item.link.url }}}">
						<span class="ecll-title-content-wrapper">
							<span class="ecll-download-icon">
								<i class="{{{ download_icon }}}"></i>
							</span>
							<span class="ecll-download-name">{{{ item.name }}}</span>
							<span class="ecll-download-description">{{{ item.description }}}</span>
						</span>
					</a>
				</li>
				<#
				} );
			}
			#>
			</ul>
			<#
			if ( settings.downloads.length > settings.expand_limit ) {
				#>
				<ul {{{ view.getRenderAttributeString( 'hidden-downloads' ) }}}>
					<#
					_.each( settings.downloads.slice(settings.expand_limit), function( item, index ) {
						let download_icon = item.icon.value ? item.icon.value : settings.download_icon.value;
						#>
					<li {{{ view.getRenderAttributeString( 'download-list-item' ) }}}>
						<a {{{ view.getRenderAttributeString( 'download-link' ) }}} href="{{{ item.link.url }}}">
							<span class="ecll-title-content-wrapper">
								<span class="ecll-download-icon">
									<i class="{{{ download_icon }}}"></i>
								</span>
								<span class="ecll-download-name">{{{ item.name }}}</span>
								<span class="ecll-download-description">{{{ item.description }}}</span>
							</span>
						</a>
					</li>
					<#
					} );
				#>
				</ul>
				<div class="ecll-expand-wrapper">
					<button class="ecll-expand-btn" type="button">
						<span {{{ view.getRenderAttributeString( 'expand-text' ) }}}>{{{ settings.expand_text }}}</span>
						<span {{{ view.getRenderAttributeString( 'shrink-link' ) }}}>{{{ settings.shrink_text }}}</span>
					</button>
				</div>
				<#
			}
			#>
		</div>
		<?php
	}
}
