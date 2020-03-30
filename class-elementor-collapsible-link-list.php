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
		#$this->_icon_controls();
		$this->_downloads_controls();

		$this->_title_styles_controls();
		$this->_download_styles_controls();
	}

	protected function _title_controls() {
		$this->start_controls_section(
			'title_content',
			[
				'label' => __( 'Title', 'plugin-name' ),
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
	protected function _icon_controls() {
		$this->start_controls_section(
			'icon_content',
			[
				'label' => __( 'Icon', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();
	}
	protected function _downloads_controls() {
		$this->start_controls_section(
			'downloads_content',
			[
				'label' => __( 'Downloads', 'plugin-name' ),
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
	protected function _download_styles_controls() {
        $this->start_controls_section(
			'download_style',
			[
				'label' => __( 'Download Item', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'download_text_alignment',
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
			'download_icon_alignment',
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
				'name' => 'download_name_typography',
				'label' => __('Name typography'),
				'selector' => '{{WRAPPER}} .ecll-download-name',
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

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'download_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .elementor-button',
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
					'{{WRAPPER}} .ecll-download-text, {{WRAPPER}} .ecll-download-icon' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} a.elementor-button' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .ecll-download-link:hover .ecll-download-text, {{WRAPPER}} .ecll-download-link:hover .ecll-download-icon' => 'color: {{VALUE}};',
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

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'ecll-wrap' );

		$this->add_render_attribute( 'title', 'class', array( 'elementor-button', 'ecll-title' ) );
		$this->add_render_attribute( 'title', 'style', 'width:100%' );
		$this->add_render_attribute( 'title-text', 'class', array( 'elementor-button-text', 'ecll-title-text', 'elementor-align-'. $settings['title_text_alignment'] ) );
		$this->add_render_attribute( 'title-icon-wrapper', 'class', array( 'elementor-button-icon', 'elementor-align-icon-'. $settings['title_icon_alignment'], 'ecll-title-icon-wrapper' ) );
		$this->add_render_attribute( 'title-icon-open', 'class', array( $settings['title_icon_open']['value'], 'ecll-title-icon open-icon' ) );
		$this->add_render_attribute( 'title-icon-close', 'class', array( $settings['title_icon_close']['value'], 'ecll-title-icon close-icon' ) );

		if ( 'open' === $settings['title_state'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'ecll-open' );
			$this->add_render_attribute( 'title-icon-open', 'style', 'display:none' );
		} else {
			$this->add_render_attribute( 'title-icon-close', 'style', 'display:none' );
			$this->add_render_attribute( 'download-list', 'style', 'display:none' );
		}

		$this->add_render_attribute( 'download-list', 'class', 'ecll-downloads' );
		$this->add_render_attribute( 'download-list-item', 'class', array( 'ecll-download-item' ) );
		$this->add_render_attribute( 'download-link', 'class', array( 'elementor-button', 'ecll-download-link' ) );
		$this->add_render_attribute( 'download-link', 'style', 'display:block' );
		$this->add_render_attribute( 'download-icon-wrapper', 'class', array( 'elementor-button-icon', 'elementor-align-icon-'. $settings['download_icon_alignment'], 'ecll-download-icon' ) );
		$this->add_render_attribute( 'download-icon', 'class', array( $settings['download_icon']['value'] ) );
		$this->add_render_attribute( 'download-text', 'class', array( 'elementor-button-text', 'elementor-align-'. $settings['download_text_alignment'], 'ecll-download-text' ) );

		?><div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<button <?php echo $this->get_render_attribute_string( 'title' ); ?>>
				<span class="elementor-button-content-wrapper">
					<span <?php echo $this->get_render_attribute_string( 'title-icon-wrapper' ); ?>>
						<i <?php echo $this->get_render_attribute_string( 'title-icon-open' ); ?>></i>
						<i <?php echo $this->get_render_attribute_string( 'title-icon-close' ); ?>></i>
					</span>
					<span <?php echo $this->get_render_attribute_string( 'title-text' ); ?>>
						<?php echo $settings['title']; ?>
					</span>
				</span>
			</button>
			<ul <?php echo $this->get_render_attribute_string( 'download-list' ); ?>>
			<?php
			foreach ( $settings['downloads'] as $index => $item ) :
				if ( empty( $item['link']['url'] ) ) {
					continue;
				}

				?>
				<li <?php echo $this->get_render_attribute_string( 'download-list-item' ); ?>>
					<a <?php echo $this->get_render_attribute_string( 'download-link' ); ?> href="<?php echo esc_url( $item['link']['url'] ); ?>">
						<span class="elementor-button-content-wrapper">
							<span <?php echo $this->get_render_attribute_string( 'download-icon-wrapper' ); ?>>
								<i <?php echo $this->get_render_attribute_string( 'download-icon' ); ?>></i>
							</span>
							<span <?php echo $this->get_render_attribute_string( 'download-text' ); ?>>
								<span class="ecll-download-name"><?php echo $item['name']; ?></span>
								<span class="ecll-download-description"><?php echo $item['description']; ?></span>
							</span>
						</span>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>

		<?php
		# echo '<pre>'; print_r($settings); echo '</pre>';
	}

	public function content_template()
	{
		?>
		<#
		view.addRenderAttribute('wrapper',{
			'class': [ 'ecll-wrap' ]
		});
		view.addRenderAttribute('title',{
			'class': [ 'elementor-button', 'ecll-title' ],
			'style': 'width:100%'
		});
		view.addRenderAttribute('title-text',{
			'class': [ 'elementor-button-text', 'ecll-title-text', 'elementor-align-' + settings.title_text_alignment ],
			'style': 'width:100%'
		});
		view.addRenderAttribute('title-icon-wrapper',{
			'class': [ 'elementor-button-icon', 'elementor-align-icon-' + settings.title_icon_alignment, 'ecll-title-icon-wrapper' ]
		});
		view.addRenderAttribute('title-icon-open',{
			'class': [ settings.title_icon_open.value, 'ecll-title-icon open-icon' ]
		});
		view.addRenderAttribute('download-list',{
			'class': [ 'ecll-downloads' ]
		});

		if ( 'open' === settings.title_state ) {
			view.addRenderAttribute('wrapper',{
				'class': [ 'ecll-open' ]
			});
			view.addRenderAttribute('title-icon-open',{
				'style': [ 'display:none' ]
			});
		} else {
			view.addRenderAttribute('title-icon-close',{
				'style': [ 'display:none' ]
			});
			view.addRenderAttribute('download-list',{
				'style': [ 'display:none' ]
			});
		}

		view.addRenderAttribute('title-icon-close',{
			'class': [settings.title_icon_close.value, 'ecll-title-icon close-icon']
		});

		view.addRenderAttribute('download-list-item',{
			'class': ['ecll-download-item']
		});
		view.addRenderAttribute('download-link',{
			'class': [ 'elementor-button', 'ecll-download-link' ],
			'style': ['display:block']
		});
		view.addRenderAttribute('download-icon-wrapper',{
			'class': [ 'elementor-button-icon', 'ecll-download-icon', 'elementor-align-icon-' + settings.download_icon_alignment ]
		});
		view.addRenderAttribute('download-icon',{
			'class': [ settings.download_icon.value ],
			'style': ['display:block']
		});
		view.addRenderAttribute('download-text',{
			'class': [ 'elementor-button-text', 'elementor-align-' + settings.download_text_alignment, 'ecll-download-text' ],
			'style': ['display:block']
		});
		#>
		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
			<button {{{ view.getRenderAttributeString( 'title' ) }}}>
				<span class="elementor-button-content-wrapper">
					<span {{{ view.getRenderAttributeString( 'title-icon-wrapper' ) }}}>
						<i {{{ view.getRenderAttributeString( 'title-icon-open' ) }}}></i>
						<i {{{ view.getRenderAttributeString( 'title-icon-close' ) }}}></i>
					</span>
					<span {{{ view.getRenderAttributeString( 'title-text' ) }}}>
						{{{ settings.title }}}
					</span>
				</span>
			</button>

			<ul {{{ view.getRenderAttributeString( 'download-list' ) }}}>
				<#
				if ( settings.downloads ) {
					_.each( settings.downloads, function( item, index ) {
					#>
				<li {{{ view.getRenderAttributeString( 'download-list-item' ) }}}>
					<a {{{ view.getRenderAttributeString( 'download-link' ) }}} href="{{{ item.link.url }}}">
						<span class="elementor-button-content-wrapper">
							<span {{{ view.getRenderAttributeString( 'download-icon-wrapper' ) }}}>
								<i {{{ view.getRenderAttributeString( 'download-icon' ) }}}></i>
							</span>
							<span {{{ view.getRenderAttributeString( 'download-text' ) }}}>
								<span class="ecll-download-name">{{{ item.name }}}</span>
								<span class="ecll-download-description">{{{ item.description }}}</span>
							</span>
						</span>
					</a>
				</li>
				<#
				} );
			}
			#>
			</ul>
		</div>
		<?php
	}
}
