<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Video Widget.
 *
 * @since 1.0
 */
class Ober_Section_Video_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-section-video';
	}

	public function get_title() {
		return esc_html__( 'Section Video', 'ober-plugin' );
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
			'video',
			[
				'label'       => esc_html__( 'Video ID (Youtube)', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'	  => 'Gu6z6kIukgg',
				'placeholder' => esc_html__( 'Gu6z6kIukgg', 'ober-plugin' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Video Poster (Image)', 'ober-plugin' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
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

		if ( $settings['image']['id'] ) {
			$image = wp_get_attachment_image_url( $settings['image']['id'], 'ober_1920xAuto' );
		} else {
			$image = $settings['image']['url'];
		}

		?>

		<!-- Video -->
		<div class="m-video-large">
			<div class="video scrolla-element-anim-1 scroll-animate" data-animate="active">
				<?php if ( $image ) : ?>
				<div class="img js-parallax" style="background-image: url(<?php echo esc_url( $image ); ?>);"></div>
				<?php endif; ?>
				<?php if ( $settings['video'] ) : ?>
				<iframe class="js-video-iframe" data-src="https://www.youtube.com/embed/<?php echo esc_attr( $settings['video'] ); ?>?showinfo=0&rel=0&autoplay=1"></iframe>
				<?php endif; ?>
				<div class="play"></div>
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
	protected function content_template() { ?>

		<!-- Video -->
		<div class="m-video-large">
			<div class="video scrolla-element-anim-1 scroll-animate" data-animate="active">
				<# if ( settings.image ) { #>
				<div class="img js-parallax" style="background-image: url({{{ settings.image.url }}});"></div>
				<# } #>
				<# if ( settings.video ) { #>
				<iframe class="js-video-iframe" data-src="https://www.youtube.com/embed/{{{ settings.video }}}?showinfo=0&rel=0&autoplay=1"></iframe>
				<# } #>
				<div class="play"></div>
			</div>
		</div>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Section_Video_Widget() );
