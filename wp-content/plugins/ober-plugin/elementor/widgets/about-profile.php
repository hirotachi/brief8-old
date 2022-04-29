<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Profile Widget.
 *
 * @since 1.0
 */
class Ober_About_Profile_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-about-profile';
	}

	public function get_title() {
		return esc_html__( 'About Profile', 'ober-plugin' );
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
			'description',
			[
				'label'       => esc_html__( 'Description', 'ober-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter your description', 'ober-plugin' ),
				'default'     => esc_html__( 'Description', 'ober-plugin' ),
			]
		);

		$this->add_control(
			'more_text', [
				'label' => esc_html__( 'Button (Text)', 'ober-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Text', 'ober-plugin' ),
				'default' => esc_html__( 'view work', 'ober-plugin' ),
			]
		);

		$this->add_control(
			'more_link', [
				'label' => esc_html__( 'Button (URL)', 'ober-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Image', 'ober-plugin' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_styling',
			[
				'label'     => esc_html__( 'About Profile', 'ober-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .profile-box .text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .profile-box .text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'     => esc_html__( 'Description Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .profile-box .text',
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

		<!-- Section Profile -->
		<div class="profile-box">

			<?php if ( $settings['description'] ) : ?>
			<div class="text scrolla-element-anim-1 scroll-animate" data-animate="active">
				<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
					<?php echo wp_kses_post( $settings['description'] ); ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( $settings['more_text'] ) : ?>
			<a<?php if ( $settings['more_link'] ) : ?><?php if ( $settings['more_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['more_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['more_link']['url'] ); ?>"<?php endif; ?> class="btn scrolla-element-anim-1 scroll-animate" data-animate="active">
				<?php echo esc_html( $settings['more_text'] ); ?>
			</a>
			<?php endif; ?>
			<?php if ( $settings['image'] ) : $image = wp_get_attachment_image_url( $settings['image']['id'], 'ober_600xAuto' ); ?>
			<!-- slide -->
			<div class="signature scrolla-element-anim-1 scroll-animate" data-animate="active">
				<img src="<?php echo esc_url( $image ); ?>" alt="" />
			</div>
			<?php endif; ?>

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
	protected function content_template() { ?>

	<#
	view.addInlineEditingAttributes( 'description', 'advanced' );
	#>

	<!-- Section Profile -->
	<div class="profile-box">

		<# if ( settings.description ) { #>
		<div class="text scrolla-element-anim-1 scroll-animate" data-animate="active">
			<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
		</div>
		<# } #>
		<# if ( settings.more_text ) { #>
		<a<# if ( settings.link ) { #><# if ( settings.link.is_external ) { #> target="_blank"<# } #><# if ( settings.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ settings.link.url }}}"<# } #> class="btn scrolla-element-anim-1 scroll-animate" data-animate="active">
			{{{ settings.more_text }}}
		</a>
		<# } #>
		<# if ( settings.image ) { #>
		<div class="signature scrolla-element-anim-1 scroll-animate" data-animate="active">
			<img src="{{{ settings.image.url }}}" alt="" />
		</div>
		<# } #>

	</div>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_About_Profile_Widget() );
