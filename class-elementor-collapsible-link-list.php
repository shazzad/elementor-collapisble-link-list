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
		return __( 'Collapsible Link List', 'coll' );
	}


    public function get_icon() {
		return 'eicon-insert-image';
	}

    public function get_categories() {
        return [ 'general' ];
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
		$this->_icon_controls();
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
				'label' => __( 'Title', 'coll' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title' , 'coll' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'title_icon_open',
			[
				'label' => __( 'Icon (Open)', 'coll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'fas fa-plus',
            		'library' => 'fa-solid'
				)
			]
		);
		$this->add_control(
			'title_icon_close',
			[
				'label' => __( 'Icon (Close)', 'coll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'fas fa-minus',
            		'library' => 'fa-solid'
				)
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
		$this->add_control(
			'download_icon',
			[
				'label' => __( 'Download Icon', 'coll' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'fas fa-arrow-down',
            		'library' => 'fa-solid'
				)
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
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label' => __( 'Name', 'coll' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Download Name' , 'coll' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'description', [
				'label' => __( 'Description', 'coll' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Download Description' , 'coll' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'link', [
				'label' => __( 'Link', 'coll' ),
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
				'label' => __( 'Downloads', 'coll' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'show_label' => false,
				'default' => [
					[
						'name' => __( 'Download #1', 'coll' ),
						'description' => __( 'Download description.', 'coll' ),
					],
					[
						'name' => __( 'Download #2', 'coll' ),
						'description' => __( 'Some description.', 'coll' ),
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
				'name' => 'title_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .coll-title-text',
				'fields_options' => [
					'font_style' => [
						'default' => 'italic',
					]
				]
			]
		);
        $this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .coll-title-text, {{WRAPPER}} .coll-title-icon' => 'color: {{VALUE}};',
				],
				'default' => '#fff'
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .coll-title' => 'background-color: {{VALUE}};',
				],
				'default' => '#3B4961'
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .coll-title',
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
					'{{WRAPPER}} .coll-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' => 'title_box_shadow',
				'selector' => '{{WRAPPER}} .coll-title',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .coll-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .coll-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => __( 'Download', 'elementor' ),
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
				'name' => 'download_text_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .coll-download-text',
			]
		);


        $this->start_controls_tabs( 'tabs_button_style' );
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
					'{{WRAPPER}} .coll-download-text, {{WRAPPER}} .elementor-button-icon' => 'color: {{VALUE}};',
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
			'tab_hover_download',
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
					'{{WRAPPER}} a.coll-download-link:hover .elementor-button-text, {{WRAPPER}} .elementor-button:hover .elementor-button-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'download_hover_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.coll-download-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'download_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.coll-download-link:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'download_hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);
        $this->end_controls_tab();
		$this->end_controls_tabs();

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
					'{{WRAPPER}} a.coll-download-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'download_box_shadow',
				'selector' => '{{WRAPPER}} a.coll-download-link',
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

		$this->add_responsive_control(
			'download_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.coll-download-link, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} a.coll-download-link, {{WRAPPER}} .elementor-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_render_attribute( 'wrapper', 'class', 'coll-wrap' );

		$this->add_render_attribute( 'title-wrapper', 'class', array( 'elementor-button-wrapper', 'coll-title-wrapper' ) );
		$this->add_render_attribute( 'title', 'class', array( 'elementor-button', 'coll-title' ) );
		$this->add_render_attribute( 'title', 'style', 'width:100%' );

		$this->add_render_attribute( 'title-text', 'class', array( 'elementor-button-text', 'coll-title-text', 'elementor-align-'. $settings['title_text_alignment'] ) );

		$this->add_render_attribute( 'title-icon-wrapper', 'class', array( 'elementor-button-icon', 'elementor-align-icon-'. $settings['title_icon_alignment'], 'coll-title-icon-wrapper' ) );
		$this->add_render_attribute( 'title-icon-open', 'class', array( $settings['title_icon_open']['value'], 'coll-title-icon open-icon' ) );
		$this->add_render_attribute( 'title-icon-open', 'style', 'display:none' );
		$this->add_render_attribute( 'title-icon-close', 'class', array( $settings['title_icon_close']['value'], 'coll-title-icon close-icon' ) );

		$this->add_render_attribute( 'download-wrapper', 'class', 'elementor-button-wrapper' );
		$this->add_render_attribute( 'download-link', 'class', array( 'elementor-button', 'coll-download-link' ) );
		$this->add_render_attribute( 'download-link', 'style', 'display:block' );

		$this->add_render_attribute( 'download-icon-wrapper', 'class', array( 'elementor-button-icon', 'elementor-align-icon-'. $settings['download_icon_alignment'] ) );
		$this->add_render_attribute( 'download-icon', 'class', 'download-icon' );
		$this->add_render_attribute( 'download-icon', 'class', $settings['download_icon']['value'] );

		$this->add_render_attribute( 'download-text', 'class', array( 'elementor-button-text', 'elementor-align-'. $settings['download_text_alignment'], 'coll-download-text' ) );

		?><div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'title-wrapper' ); ?>>
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
			</div>
			<ul class="coll-download-links">
			<?php
			foreach ( $settings['downloads'] as $index => $item ) :
				if ( empty( $item['link']['url'] ) ) {
					continue;
				}

				?>
				<li <?php echo $this->get_render_attribute_string( 'download-wrapper' ); ?>>
					<a <?php echo $this->get_render_attribute_string( 'download-link' ); ?> href="<?php echo esc_url( $item['link']['url'] ); ?>">
						<span class="elementor-button-content-wrapper">
							<span <?php echo $this->get_render_attribute_string( 'download-icon-wrapper' ); ?>>
								<i <?php echo $this->get_render_attribute_string( 'download-icon' ); ?>></i>
							</span>
							<span <?php echo $this->get_render_attribute_string( 'download-text' ); ?>>
								<span><?php echo $item['name']; ?></span>
								<span><?php echo $item['description']; ?></span>
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
}
