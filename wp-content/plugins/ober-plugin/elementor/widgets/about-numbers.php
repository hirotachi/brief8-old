<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Numbers Widget.
 *
 * @since 1.0
 */
class Ober_About_Numbers_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-about-numbers';
	}

	public function get_title() {
		return esc_html__( 'About Numbers', 'ober-plugin' );
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
			'numbers_tab',
			[
				'label' => esc_html__( 'Numbers', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon', [
				'label'       => esc_html__( 'Icon', 'ober-plugin' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'number', [
				'label'       => esc_html__( 'Number', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subtitle', 'ober-plugin' ),
				'default' => esc_html__( 'Enter subtitle', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default' => esc_html__( 'Enter title', 'ober-plugin' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Numbers', 'ober-plugin' ),
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
				'default'	=> 'left',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_styling',
			[
				'label'     => esc_html__( 'Numbers Items', 'ober-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .numbers-item .icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_typography',
				'label'     => esc_html__( 'Icon Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .numbers-item .icon i',
			]
		);

		$this->add_control(
			'number_color',
			[
				'label'     => esc_html__( 'Number Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .numbers-item .num' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typography',
				'label'     => esc_html__( 'Number Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .numbers-item .num',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .numbers-item .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .numbers-item .title',
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

		<!-- Section numbers -->
		<?php if ( $settings['items'] ) : ?>
		<div class="numbers-items">
			<?php foreach ( $settings['items'] as $index => $item ) :
		    	$item_name = $this->get_repeater_setting_key( 'title', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_name, 'basic' );

		    	$item_num = $this->get_repeater_setting_key( 'number', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_num, 'basic' );
		    ?>
		    <div class="numbers-item scrolla-element-anim-1 scroll-animate" data-animate="active">
		    	<?php if ( $item['icon'] ) : ?>
		    	<div class="icon">
						<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
					<?php endif; ?>
					<?php if ( $item['number'] ) : ?>
					<div class="num">
						<span <?php echo $this->get_render_attribute_string( $item_num ); ?>>
							<?php echo wp_kses_post( $item['number'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['title'] ) : ?>
					<div class="title">
						<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
							<?php echo wp_kses_post( $item['title'] ); ?>
						</span>
					</div>
					<?php endif; ?>
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

	<!-- Section numbers -->
	<# if ( settings.items ) { #>
	<div class="numbers-items">
		<# _.each( settings.items, function( item, index ) {
	    	var item_name = view.getRepeaterSettingKey( 'title', 'items', index );
	    	view.addInlineEditingAttributes( item_name, 'basic' );

	        var item_num = view.getRepeaterSettingKey( 'number', 'items', index );
	    	view.addInlineEditingAttributes( item_num, 'basic' );

	    	var iconHTML = elementor.helpers.renderIcon( view, item.icon, { 'aria-hidden': true }, 'i' , 'object' );
	    #>
	    <div class="numbers-item scrolla-element-anim-1 scroll-animate" data-animate="active">
	    	<# if ( item.icon ) { #>
	    	<div class="icon">
				{{{ iconHTML.value }}}
			</div>
			<# } #>
			<# if ( item.number ) { #>
			<div class="num">
				<span {{{ view.getRenderAttributeString( 'item_num' ) }}}>{{{ item.number }}}</span>
			</div>
			<# } #>
			<# if ( item.title ) { #>
			<div class="title">
				<span {{{ view.getRenderAttributeString( 'item_name' ) }}}>{{{ item.title }}}</span>
			</div>
			<# } #>
		</div>
		<# }); #>
	</div>
	<# } #>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_About_Numbers_Widget() );
