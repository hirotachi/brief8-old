<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Project Gallery Grid Widgets.
 *
 * @since 1.0
 */
class Ober_Project_Gallery_Grid_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-projects-gallery-grid';
	}

	public function get_title() {
		return esc_html__( 'Project Gallery Grid', 'ober-plugin' );
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
			'name', [
				'label_block' => true,
				'label' => esc_html__( 'Name', 'ober-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter name', 'ober-plugin' ),
				'placeholder' => esc_html__( 'Enter name', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'ober-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
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
				'title_field' => '{{{ name }}}',
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
		$settings = $this->get_settings_for_display(); ?>

		<!-- Section Gallery -->
		<div class="m-gallery">
			<?php if ( $settings['items'] ) : ?>
			<div class="row">
				<?php
				foreach ( $settings['items'] as $item ) : $image_full = wp_get_attachment_image_url( $item['image']['id'], 'ober_1920xAuto' ); $image = wp_get_attachment_image_url( $item['image']['id'], 'ober_920x1080' ); ?>

				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="works-item">
						<div class="image scrolla-element-anim-1 scroll-animate" data-animate="active">
							<div class="img">
								<a href="<?php echo esc_url( $image ); ?>" class="has-popup-image"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" /></a>
							</div>
						</div>
					</div>
				</div>

				<?php endforeach; ?>

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

		<!-- Gallery -->
		<div class="m-gallery">
			<# if ( settings.items ) { #>
			<div class="row">

				<# _.each( settings.items, function( item, index ) { #>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="works-item">
						<div class="image scrolla-element-anim-1 scroll-animate" data-animate="active">
							<div class="img">
								<a href="{{{ item.image.url }}}" class="has-popup-image"><img src="{{{ item.image.url }}}" alt="{{{ item.name }}}" /></a>
							</div>
						</div>
					</div>
				</div>
				<# }); #>

			</div>
			<# } #>
		</div>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Project_Gallery_Grid_Widget() );
