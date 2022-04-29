<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Social Links Widget.
 *
 * @since 1.0
 */
class Ober_Social_Links_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-social-links';
	}

	public function get_title() {
		return esc_html__( 'Social Links', 'ober-plugin' );
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon', [
				'label'       => esc_html__( 'Icon', 'ober-plugin' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'ober-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default' => esc_html__( 'Enter title', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'ober-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default' => esc_html__( 'Enter title', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'link', [
				'label' => esc_html__( 'URL', 'ober-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
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

		$this->end_controls_section();

		$this->start_controls_section(
			'content_styling',
			[
				'label' => esc_html__( 'Social Links', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Icon Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .social-links a i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_active_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .social-links a:hover i' => 'color: {{VALUE}};',
				],
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

		<?php if ( $settings['items'] ) : ?>
		<!-- social -->
		<div class="social-links scrolla-element-anim-1 scroll-animate" data-animate="active">
			<?php foreach ( $settings['items'] as $index => $item ) :
		    	$item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_name, 'basic' );
		    ?>
			<a<?php if ( $item['link'] ) : ?><?php if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php endif; ?>>
				<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</a>
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
	protected function content_template() {
		?>

		<# if ( settings.items ) { #>
		<!-- social -->
		<div class="social-links">
			<# _.each( settings.items, function( item, index ) {
				var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
			    view.addInlineEditingAttributes( item_name, 'basic' );

				var iconHTML = elementor.helpers.renderIcon( view, item.icon, { 'aria-hidden': true }, 'i' , 'object' );
			#>
			<a<# if ( item.link ) { #><# if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}"<# } #>>
				{{{ iconHTML.value }}}
			</a>
			<# }); #>
		</div>
		<# } #>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Social_Links_Widget() );
