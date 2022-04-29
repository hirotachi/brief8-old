<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Description Widget.
 *
 * @since 1.0
 */
class Ober_Description_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-description';
	}

	public function get_title() {
		return esc_html__( 'Description', 'ober-plugin' );
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
			'label',
			[
				'label'       => esc_html__( 'Title', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default'     => esc_html__( 'Title', 'ober-plugin' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'content_styling',
			[
				'label'     => esc_html__( 'Description', 'ober-plugin' ),
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
					'{{WRAPPER}} .p-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .p-title',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Text Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'     => esc_html__( 'Text Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .text',
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
    $this->add_inline_editing_attributes( 'label', 'basic' );
		$this->add_inline_editing_attributes( 'description', 'advanced' );

		?>

		<!-- Description -->
    <?php if ( $settings['label'] ) : ?>
    <div class="p-title scrolla-element-anim-1 scroll-animate" data-animate="active">
      <span <?php echo $this->get_render_attribute_string( 'label' ); ?>>
        <?php echo wp_kses_post( $settings['label'] ); ?>
      </span>
    </div>
    <?php endif; ?>
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
	view.addInlineEditingAttributes( 'description', 'advanced' );
	view.addInlineEditingAttributes( 'label', 'basic' );
	#>

	<!-- Section Description -->
  <# if ( settings.label ) { #>
  <div class="p-title">
    <span {{{ view.getRenderAttributeString( 'label' ) }}}>{{{ settings.label }}}</span>
  </div>
  <# } #>
	<# if ( settings.description ) { #>
	<div class="text">
		<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
	</div>
	<# } #>
	<# if ( settings.more_text ) { #>
	<a<# if ( settings.link ) { #><# if ( settings.link.is_external ) { #> target="_blank"<# } #><# if ( settings.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ settings.link.url }}}"<# } #> class="btn">
		{{{ settings.more_text }}}
	</a>
	<# } #>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Description_Widget() );
