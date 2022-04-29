<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober CF7 Widget.
 *
 * @since 1.0
 */

class Ober_CF7_Form_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-cf7-form';
	}

	public function get_title() {
		return esc_html__( 'Contact Form 7', 'ober-plugin' );
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
			'form_tab',
			[
				'label' => esc_html__( 'Form', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'contact_form',
			[
				'label' => esc_html__( 'Select CF7 Form', 'ober-plugin' ),
				'type' => Controls_Manager::SELECT,
				'default' => 1,
				'options' => $this->contact_form_list(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'heading_styling',
			[
				'label' => esc_html__( 'Forms', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'Label Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .contacts-form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => esc_html__( 'Label Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .contacts-form label',
			]
		);

		$this->add_control(
			'input_color',
			[
				'label' => esc_html__( 'Input Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .contacts-form input' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'label' => esc_html__( 'Input Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .contacts-form input',
			]
		);

		$this->add_control(
			'input_border_color',
			[
				'label' => esc_html__( 'Input Border Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .contacts-form input' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Contact Form List.
	 *
	 * @since 1.0
	 */
	protected function contact_form_list() {
		$cf7_posts = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		$cf7_forms = array();

		if ( $cf7_posts ) {
			foreach ( $cf7_posts as $cf7_form ) {
				$cf7_forms[ $cf7_form->ID ] = $cf7_form->post_title;
			}
		} else {
			$cf7_forms[ esc_html__( 'No contact forms found', 'ober-plugin' ) ] = 0;
		}

		return $cf7_forms;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<?php if ( $settings['contact_form'] ) : ?>
		<!-- contact form -->
		<div class="contacts-form scrolla-element-anim-1 scroll-animate" data-animate="active">
			<?php echo do_shortcode( '[contact-form-7 id="'. esc_attr( $settings['contact_form'] ) .'"]' ); ?>
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

		<# if ( settings.contact_form ) { #>
		<!-- contact form -->
		<div class="contacts-form">
			[contact-form-7 id="{{{ settings.contact_form }}}"]
		</div>
		<# } #>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_CF7_Form_Widget() );
