<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Footer Heading Widget.
 *
 * @since 1.0
 */
class Ober_Footer_Heading_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-footer-heading';
	}

	public function get_title() {
		return esc_html__( 'Footer Heading', 'ober-plugin' );
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
			'heading_tab',
			[
				'label' => esc_html__( 'Heading', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'ober-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter your description', 'ober-plugin' ),
				'default'     => esc_html__( 'Description', 'ober-plugin' ),
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
			'heading_styling',
			[
				'label' => esc_html__( 'Heading', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Description Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .footer-heading div' => 'color: {{VALUE}};',
          '{{WRAPPER}} .footer-heading div p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => esc_html__( 'Description Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .footer-heading div',
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

		$this->add_inline_editing_attributes( 'description', 'advanced' );

		?>

		<?php if ( $settings['description'] ) : ?>
		<div class="footer-heading scrolla-element-anim-1 scroll-animate" data-animate="active">
			<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
				<?php echo wp_kses_post( $settings['description'] ); ?>
			</div>
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
	protected function content_template() {
		?>
		<#

		view.addInlineEditingAttributes( 'description', 'advanced' );

		#>

		<# if ( settings.description ) { #>
		<div class="footer-heading scrolla-element-anim-1 scroll-animate" data-animate="active">
			<div {{{ view.getRenderAttributeString( 'description' ) }}}>
    			{{{ settings.description }}}
    	</div>
		</div>
		<# } #>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Footer_Heading_Widget() );
