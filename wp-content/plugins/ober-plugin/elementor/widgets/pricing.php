<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Awwards Widget.
 *
 * @since 1.0
 */

class Ober_Pricing_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-pricing';
	}

	public function get_title() {
		return esc_html__( 'Pricing', 'ober-plugin' );
	}

	public function get_icon() {
		return 'eicon-parallax';
	}

	public function get_categories() {
		return [ 'ober-category' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_tab',
			[
				'label' => esc_html__( 'Items', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default' => esc_html__( 'Enter title', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'subtitle', [
				'label'       => esc_html__( 'Subtitle', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subtitle', 'ober-plugin' ),
				'default' => esc_html__( 'Enter subtitle', 'ober-plugin' ),
			]
		);

    $repeater->add_control(
			'price', [
				'label'       => esc_html__( 'Price', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter price', 'ober-plugin' ),
				'default' => esc_html__( 'Enter price', 'ober-plugin' ),
			]
		);

    $repeater->add_control(
			'text', [
				'label'       => esc_html__( 'Description', 'ober-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter description', 'ober-plugin' ),
				'default' => esc_html__( 'Enter description', 'ober-plugin' ),
			]
		);

    $repeater->add_control(
			'more_text', [
				'label' => esc_html__( 'Button (Text)', 'ober-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Text', 'ober-plugin' ),
				'default' => esc_html__( 'view work', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'more_link', [
				'label' => esc_html__( 'Button (URL)', 'ober-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'ober-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			]
		);

    $this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'ober-plugin' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ober-plugin' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ober-plugin' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ober-plugin' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default'	=> 'center',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_styling',
			[
				'label' => esc_html__( 'Items', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label' => esc_html__( 'Title Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_title_typography',
				'label' => esc_html__( 'Title Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .title',
			]
		);

		$this->add_control(
			'item_subtitle_color',
			[
				'label' => esc_html__( 'Subtitle Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_subtitle_typography',
				'label' => esc_html__( 'Subtitle Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .subtitle',
			]
		);

		$this->add_control(
			'item_price_color',
			[
				'label' => esc_html__( 'Price Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_price_typography',
				'label' => esc_html__( 'Price Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .price',
			]
		);

		$this->add_control(
			'item_text_color',
			[
				'label' => esc_html__( 'Text Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_text_typography',
				'label' => esc_html__( 'Text Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .text',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<!-- Pricing -->
		<?php if ( $settings['items'] ) : ?>
		<div class="pricing-items row">

			<?php foreach ( $settings['items'] as $index => $item ) :
		      $item_subtitle = $this->get_repeater_setting_key( 'subtitle', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_subtitle, 'basic' );

		      $item_title = $this->get_repeater_setting_key( 'title', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_title, 'basic' );

          $item_price = $this->get_repeater_setting_key( 'price', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_price, 'basic' );

          $item_text = $this->get_repeater_setting_key( 'text', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_text, 'advanced' );
		  ?>
			<div class="pricing-col col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<div class="pricing-item scrolla-element-anim-1 scroll-animate" data-animate="active">
					<?php if ( $item['title'] ) : ?>
					<div class="title">
						<span <?php echo $this->get_render_attribute_string( $item_title ); ?>>
							<?php echo wp_kses_post( $item['title'] ); ?>
						</span>
					</div>
					<?php endif; ?>
          <?php if ( $item['subtitle'] ) : ?>
					<div class="subtitle">
						<span <?php echo $this->get_render_attribute_string( $item_subtitle ); ?>>
							<?php echo wp_kses_post( $item['subtitle'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['price'] ) : ?>
					<div class="price">
						<span <?php echo $this->get_render_attribute_string( $item_price ); ?>>
							<?php echo wp_kses_post( $item['price'] ); ?>
						</span>
					</div>
					<?php endif; ?>
          <?php if ( $item['text'] ) : ?>
          <div class="text">
            <div <?php echo $this->get_render_attribute_string( $item_text ); ?>>
              <?php echo wp_kses_post( $item['text'] ); ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if ( $item['more_text'] ) : ?>
          <a<?php if ( $item['more_link'] ) : ?><?php if ( $item['more_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['more_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['more_link']['url'] ); ?>"<?php endif; ?> class="btn">
            <?php echo esc_html( $item['more_text'] ); ?>
          </a>
          <?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>

		</div>
		<?php endif; ?>

		<?php
	}

	/**
	 * Render widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() { ?>

		<!-- Pricing -->
		<# if ( settings.items ) { #>
		<div class="pricing-items row">
			<# _.each( settings.items, function( item, index ) {
		      var item_subtitle = view.getRepeaterSettingKey( 'subtitle', 'items', index );
		    	view.addInlineEditingAttributes( item_subtitle, 'none' );

		      var item_title = view.getRepeaterSettingKey( 'title', 'items', index );
		    	view.addInlineEditingAttributes( item_title, 'none' );

          var item_price = view.getRepeaterSettingKey( 'price', 'items', index );
		    	view.addInlineEditingAttributes( item_price, 'none' );

          var item_text = view.getRepeaterSettingKey( 'text', 'items', index );
		    	view.addInlineEditingAttributes( item_text, 'none' );
		  #>
			<div class="pricing-col col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<div class="pricing-item scrolla-element-anim-1 scroll-animate" data-animate="active">
					<# if ( item.title ) { #>
					<div class="title">
						<span {{{ view.getRenderAttributeString( 'item_title' ) }}}>{{{ item.title }}}</span>
					</div>
					<# } #>
					<# if ( item.subtitle ) { #>
					<div class="label">
						<span {{{ view.getRenderAttributeString( 'item_subtitle' ) }}}>{{{ item.subtitle }}}</span>
					</div>
					<# } #>
          <# if ( item.price ) { #>
					<div class="price">
						<span {{{ view.getRenderAttributeString( 'item_price' ) }}}>{{{ item.price }}}</span>
					</div>
					<# } #>
          <# if ( item.text ) { #>
          <div class="text">
            <div {{{ view.getRenderAttributeString( 'item_text' ) }}}>{{{ item.text }}}</div>
          </div>
          <# } #>
          <# if ( item.more_text ) { #>
          <a<# if ( item.link ) { #><# if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}"<# } #> class="btn">
            {{{ item.more_text }}}
          </a>
          <# } #>
				</div>
			</div>
			<# }); #>
		</div>
    <# } #>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Pricing_Widget() );
