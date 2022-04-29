<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Heading Widget.
 *
 * @since 1.0
 */
class Ober_Section_Heading_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-section-heading';
	}

	public function get_title() {
		return esc_html__( 'Section Heading', 'ober-plugin' );
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
			'title_tab',
			[
				'label' => esc_html__( 'Title', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'ober-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'div',
				'options' => [
					'h1'  => __( 'H1', 'ober-plugin' ),
					'h2' => __( 'H2', 'ober-plugin' ),
					'div' => __( 'DIV', 'ober-plugin' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default'     => esc_html__( 'Title', 'ober-plugin' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_styling',
			[
				'label'     => esc_html__( 'Title', 'ober-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .m-titles .m-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .m-titles .m-title',
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

		$this->add_inline_editing_attributes( 'title', 'basic' );

		?>

		<!-- Section Heading -->
		<?php if ( $settings['title'] ) : ?>
		<div class="m-titles">
			<<?php echo esc_attr( $settings['title_tag'] ); ?> class="m-title splitting-text-anim-1 scroll-animate" data-splitting="chars" data-animate="active">
				<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
					<?php echo wp_kses_post( $settings['title'] ); ?>
				</span>
			</<?php echo esc_attr( $settings['title_tag'] ); ?>>
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

	<#
	view.addInlineEditingAttributes( 'title', 'basic' );
	#>

	<!-- Section Heading -->
	<# if ( settings.title ) { #>
	<div class="m-titles">
		<div class="m-title">
			<span {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</span>
		</div>
	</div>
	<# } #>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Section_Heading_Widget() );
