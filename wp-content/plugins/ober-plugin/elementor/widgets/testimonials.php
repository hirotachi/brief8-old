<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Testimonials Widget.
 *
 * @since 1.0
 */
class Ober_Testimonials_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-testimonials';
	}

	public function get_title() {
		return esc_html__( 'Testimonials', 'ober-plugin' );
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
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'text', [
				'label'       => esc_html__( 'Text', 'ober-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter text', 'ober-plugin' ),
				'default' => esc_html__( 'Enter text', 'ober-plugin' ),
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

		$repeater->add_control(
			'author', [
				'label'       => esc_html__( 'Author', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter author', 'ober-plugin' ),
				'default' => esc_html__( 'Enter author', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'ober-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
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
				'default'	=> 'center',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_styling',
			[
				'label' => esc_html__( 'Items', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_text_color',
			[
				'label' => esc_html__( 'Text Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .testimonials-item .text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonials-item .text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_text_typography',
				'label' => esc_html__( 'Text Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .testimonials-item .text',
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label' => esc_html__( 'Title Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .testimonials-item .info .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_title_typography',
				'label' => esc_html__( 'Title Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .testimonials-item .info .name',
			]
		);

		$this->add_control(
			'item_author_color',
			[
				'label' => esc_html__( 'Author Color', 'ober-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .testimonials-item .info .author' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_author_typography',
				'label' => esc_html__( 'Author Typography:', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .testimonials-item .info .author',
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

		<!-- Testimonials -->
		<?php if ( $settings['items'] ) : ?>
		<div class="m-testimonials">
	    <div class="swiper-container js-testimonials">
		    <div class="swiper-wrapper">
			  	<?php foreach ( $settings['items'] as $index => $item ) :
		        $item_title = $this->get_repeater_setting_key( 'title', 'items', $index );
		    		$this->add_inline_editing_attributes( $item_title, 'none' );

		    		$item_text = $this->get_repeater_setting_key( 'text', 'items', $index );
		    		$this->add_inline_editing_attributes( $item_text, 'basic' );

		    		$item_author = $this->get_repeater_setting_key( 'author', 'items', $index );
		    		$this->add_inline_editing_attributes( $item_author, 'none' );
		      ?>
          <div class="swiper-slide">
          	<div class="testimonials-item scrolla-element-anim-1 scroll-animate" data-animate="active">
							<?php if ( $item['text'] ) : ?>
							<div class="text">
								<div class="icon">
									<svg width="58" height="44" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 58 44"><defs></defs><g><g><path d="M24.15697,5.25606c-5.87975,2.24304 -9.65698,8.89397 -9.65698,14.29844h9.62551v24.44363h-24.12552v-18.06641c0,-13.94272 9.05766,-23.39363 21.74995,-25.93231zM57.98788,5.25606c-5.87734,2.24304 -9.65458,8.89397 -9.65458,14.29844h9.6666v24.44363h-24.12552v-18.06641c0,-13.94272 9.01657,-23.39363 21.70887,-25.93231zM54.21305,2.82419c-11.10706,2.9459 -17.92202,11.65104 -17.92202,23.10753v15.62309h19.29222v-19.55605h-9.6666v-2.44427c0,-5.29194 3.09334,-12.05826 8.87878,-15.45906zM20.37974,2.82133v0l0.58239,1.27411c-5.78556,3.4008 -8.8789,10.16712 -8.8789,15.45906v2.44427v0h9.62563v0v19.55605v0h-19.29222v0v-15.62309c0,-11.45458 6.83189,-20.15972 17.9631,-23.11039" fill="#ffffff" fill-opacity="1"></path></g></g></svg>
								</div>
								<div <?php echo $this->get_render_attribute_string( $item_text ); ?>><?php echo wp_kses_post( $item['text'] ); ?></div>
							</div>
							<?php endif; ?>
							<?php if ( $item['image'] ) : $image = wp_get_attachment_image_url( $item['image']['id'], 'ober_800x800' ); ?>
					    <div class="image">
					    	<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" />
					    </div>
				    	<?php endif; ?>
							<?php if ( $item['title'] || $item['author'] ) : ?>
							<div class="info">
						    <?php if ( $item['title'] ) : ?>
							  <div class="name">
							  	<span <?php echo $this->get_render_attribute_string( $item_title ); ?>><?php echo esc_html( $item['title'] ); ?></span>
							  </div>
							  <?php endif; ?>
							  <?php if ( $item['author'] ) : ?>
								<div class="author">
									<span <?php echo $this->get_render_attribute_string( $item_author ); ?>><?php echo esc_html( $item['author'] ); ?></span>
								</div>
								<?php endif; ?>
							</div>
						  <?php endif; ?>
						</div>
					</div>
					<?php endforeach; ?>
        </div>
				<div class="swiper-button-prev scrolla-element-anim-1 scroll-animate" data-animate="active">
					<svg width="13" height="25" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 13 25"><defs></defs><g><g><path d="M0.27409,11.8138l11.13338,-11.53183c0.36484,-0.37766 0.95535,-0.37766 1.3195,0.00191c0.36392,0.37861 0.36301,0.99277 -0.00183,1.37043l-10.47066,10.84518v0l10.471,10.84423c0.36484,0.37861 0.36575,0.99087 0.00195,1.37043c-0.18253,0.18883 -0.42171,0.28515 -0.6609,0.28515c-0.23849,0 -0.47676,-0.09537 -0.65895,-0.28229l-11.1335,-11.53183c-0.17567,-0.18215 -0.2742,-0.4282 -0.2742,-0.68569c0,-0.25749 0.09888,-0.50449 0.2742,-0.68569z" fill="#ffffff" fill-opacity="1"></path></g></g></svg>
				</div>
				<div class="swiper-button-next scrolla-element-anim-1 scroll-animate" data-animate="active">
					<svg width="13" height="25" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 13 25"><defs></defs><g><g><path d="M0.27409,11.8138l11.13338,-11.53183c0.36484,-0.37766 0.95535,-0.37766 1.3195,0.00191c0.36392,0.37861 0.36301,0.99277 -0.00183,1.37043l-10.47066,10.84518v0l10.471,10.84423c0.36484,0.37861 0.36575,0.99087 0.00195,1.37043c-0.18253,0.18883 -0.42171,0.28515 -0.6609,0.28515c-0.23849,0 -0.47676,-0.09537 -0.65895,-0.28229l-11.1335,-11.53183c-0.17567,-0.18215 -0.2742,-0.4282 -0.2742,-0.68569c0,-0.25749 0.09888,-0.50449 0.2742,-0.68569z" fill="#ffffff" fill-opacity="1"></path></g></g></svg>
				</div>
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
	protected function content_template() { ?>

		<!-- Testimonials -->
		<# if ( settings.items ) { #>
		<div class="m-testimonials">
	    <div class="swiper-container js-testimonials">
		    <div class="swiper-wrapper">
			    <# _.each( settings.items, function( item, index ) {
		        var item_title = view.getRepeaterSettingKey( 'title', 'items', index );
		    		view.addInlineEditingAttributes( item_title, 'none' );

		    		var item_text = view.getRepeaterSettingKey( 'text', 'items', index );
		    		view.addInlineEditingAttributes( item_text, 'basic' );

		    		var item_author = view.getRepeaterSettingKey( 'author', 'items', index );
		    		view.addInlineEditingAttributes( item_author, 'none' );
		      #>
          <div class="swiper-slide">
            <div class="testimonials-item scrolla-element-anim-1 scroll-animate" data-animate="active">
							<# if ( item.text ) { #>
							<div class="text">
								<div class="icon">
									<svg width="58" height="44" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 58 44"><defs></defs><g><g><path d="M24.15697,5.25606c-5.87975,2.24304 -9.65698,8.89397 -9.65698,14.29844h9.62551v24.44363h-24.12552v-18.06641c0,-13.94272 9.05766,-23.39363 21.74995,-25.93231zM57.98788,5.25606c-5.87734,2.24304 -9.65458,8.89397 -9.65458,14.29844h9.6666v24.44363h-24.12552v-18.06641c0,-13.94272 9.01657,-23.39363 21.70887,-25.93231zM54.21305,2.82419c-11.10706,2.9459 -17.92202,11.65104 -17.92202,23.10753v15.62309h19.29222v-19.55605h-9.6666v-2.44427c0,-5.29194 3.09334,-12.05826 8.87878,-15.45906zM20.37974,2.82133v0l0.58239,1.27411c-5.78556,3.4008 -8.8789,10.16712 -8.8789,15.45906v2.44427v0h9.62563v0v19.55605v0h-19.29222v0v-15.62309c0,-11.45458 6.83189,-20.15972 17.9631,-23.11039" fill="#ffffff" fill-opacity="1"></path></g></g></svg>
								</div>
								<div {{{ view.getRenderAttributeString( 'item_text' ) }}}>{{{ item.text }}}</div>
							</div>
							<# } #>
			    		<# if ( item.image ) { #>
				    	<div class="image">
				    		<img src="{{{ item.image.url }}}" alt="{{{ item.author }}}" />
				    	</div>
				    	<# } #>
							<# if ( item.title || item.author ) { #>
							<div class="info">
                <# if ( item.title ) { #>
					    	<div class="name">
					    		<span {{{ view.getRenderAttributeString( 'item_title' ) }}}>{{{ item.title }}}</span>
					    	</div>
					    	<# } #>
					    	<# if ( item.author ) { #>
					    	<div class="author">
					    		<span {{{ view.getRenderAttributeString( 'item_author' ) }}}>{{{ item.author }}}</span>
					    	</div>
					    	<# } #>
							</div>
							<# } #>
						</div>
					</div>
					<# }); #>
        </div>
				<div class="swiper-button-prev">
					<svg width="13" height="25" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 13 25"><defs></defs><g><g><path d="M0.27409,11.8138l11.13338,-11.53183c0.36484,-0.37766 0.95535,-0.37766 1.3195,0.00191c0.36392,0.37861 0.36301,0.99277 -0.00183,1.37043l-10.47066,10.84518v0l10.471,10.84423c0.36484,0.37861 0.36575,0.99087 0.00195,1.37043c-0.18253,0.18883 -0.42171,0.28515 -0.6609,0.28515c-0.23849,0 -0.47676,-0.09537 -0.65895,-0.28229l-11.1335,-11.53183c-0.17567,-0.18215 -0.2742,-0.4282 -0.2742,-0.68569c0,-0.25749 0.09888,-0.50449 0.2742,-0.68569z" fill="#ffffff" fill-opacity="1"></path></g></g></svg>
				</div>
				<div class="swiper-button-next">
					<svg width="13" height="25" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 13 25"><defs></defs><g><g><path d="M0.27409,11.8138l11.13338,-11.53183c0.36484,-0.37766 0.95535,-0.37766 1.3195,0.00191c0.36392,0.37861 0.36301,0.99277 -0.00183,1.37043l-10.47066,10.84518v0l10.471,10.84423c0.36484,0.37861 0.36575,0.99087 0.00195,1.37043c-0.18253,0.18883 -0.42171,0.28515 -0.6609,0.28515c-0.23849,0 -0.47676,-0.09537 -0.65895,-0.28229l-11.1335,-11.53183c-0.17567,-0.18215 -0.2742,-0.4282 -0.2742,-0.68569c0,-0.25749 0.09888,-0.50449 0.2742,-0.68569z" fill="#ffffff" fill-opacity="1"></path></g></g></svg>
				</div>
			</div>
		</div>
		<# } #>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Testimonials_Widget() );
