<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Footer Copyright Widget.
 *
 * @since 1.0
 */
class Ober_Copyright_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-copyright';
	}

	public function get_title() {
		return esc_html__( 'Copyright', 'ober-plugin' );
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
				'label' => esc_html__( 'Content', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'text',
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
			'content_styling',
			[
				'label' => esc_html__( 'Copyright', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .copyright-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => esc_html__( 'Text Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .copyright-text',
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

		$this->add_inline_editing_attributes( 'text', 'advanced' );

		?>

		<div class="copyright-text scrolla-element-anim-1 scroll-animate" data-animate="active">
			<div <?php echo $this->get_render_attribute_string( 'text' ); ?>>
				<?php echo wp_kses_post( $settings['text'] ); ?>
			</div>
		</div>

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
		view.addInlineEditingAttributes( 'text', 'advanced' );
		#>

		<div class="copyright-text scrolla-element-anim-1 scroll-animate" data-animate="active">
			<div {{{ view.getRenderAttributeString( 'text' ) }}}>
    			{{{ settings.text }}}
    		</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Copyright_Widget() );
