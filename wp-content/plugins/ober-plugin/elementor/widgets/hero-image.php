<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Hero Image Widget.
 *
 * @since 1.0
 */
class Ober_Hero_Image_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-hero-image';
	}

	public function get_title() {
		return esc_html__( 'Hero Image', 'ober-plugin' );
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

		$this->add_control(
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subtitle', 'ober-plugin' ),
				'default'     => esc_html__( 'Subtitle', 'ober-plugin' ),
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
			'image',
			[
				'label'       => esc_html__( 'Image', 'ober-plugin' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Label', 'ober-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter label', 'ober-plugin' ),
				'default' => esc_html__( 'Enter label', 'ober-plugin' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Info List', 'ober-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_tab',
			[
				'label' => esc_html__( 'Social', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon', [
				'label'       => esc_html__( 'Icon', 'myour-plugin' ),
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
			'settings_tab',
			[
				'label' => esc_html__( 'Settings', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_styling',
			[
				'label'     => esc_html__( 'Content', 'ober-plugin' ),
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
					'{{WRAPPER}} .section.hero-started .titles .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .titles .title',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .titles .subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .titles .subtitle',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'     => esc_html__( 'Description Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .description',
			]
		);

		$this->add_control(
			'social_color',
			[
				'label'     => esc_html__( 'Social Icons Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .social-links a i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'infolist_color',
			[
				'label'     => esc_html__( 'Info List Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .info-list ul li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'infolist_typography',
				'label'     => esc_html__( 'Info List Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .info-list ul li',
			]
		);

		$this->add_control(
			'circle_1_color',
			[
				'label'     => esc_html__( 'Circle 1 Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .circle-1 svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'circle_2_color',
			[
				'label'     => esc_html__( 'Circle 2 Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .circle-2 svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'circle_3_color',
			[
				'label'     => esc_html__( 'Circle 3 Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .circle-3 svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'circle_4_color',
			[
				'label'     => esc_html__( 'Circle 4 Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .circle-4 svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'circle_5_color',
			[
				'label'     => esc_html__( 'Circle 5 Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .circle-5 svg path' => 'fill: {{VALUE}};',
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

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_inline_editing_attributes( 'subtitle', 'basic' );
		$this->add_inline_editing_attributes( 'description', 'advanced' );

		?>

		<!-- Section Hero Started -->
		<div class="section hero-started">
			<?php if ( $settings['image'] ) : $image = wp_get_attachment_image_url( $settings['image']['id'], 'full' ); ?>
			<div class="slide scrolla-element-anim-1 scroll-animate" data-animate="active">
				<img src="<?php echo esc_url( $image ); ?>" alt="" />
				<span class="circle circle-1">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="749px" height="375px"><path fill-rule="evenodd" fill="#ff8059" d="M749.000,0.000 C749.000,206.786 581.459,374.514 374.608,374.514 C167.758,374.514 -0.000,206.786 -0.000,0.000 "/></svg>
				</span>
				<span class="circle circle-2">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="416px" height="209px"><path fill-rule="evenodd"  fill="#3aafc9" d="M-0.000,209.000 C-0.000,94.252 93.051,0.745 207.835,0.745 C322.619,0.745 416.000,94.252 416.000,209.000 "/></svg>
				</span>
				<span class="circle circle-3">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="416px" height="209px"><path fill-rule="evenodd"  fill="#b9d1e4" d="M-0.000,209.000 C-0.000,94.252 93.051,0.745 207.835,0.745 C322.619,0.745 416.000,94.252 416.000,209.000 "/></svg>
				</span>
				<span class="circle circle-4">
					<svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="121px" height="241px"><path fill-rule="evenodd"  fill="#676cdb" d="M0.000,0.000 C66.624,0.000 120.402,54.096 120.402,120.733 C120.402,187.371 66.624,241.000 0.000,241.000 "/></svg>
				</span>
				<span class="circle circle-5">
					<svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="232px" height="117px"><path fill-rule="evenodd"  fill="rgb(255, 208, 65)" d="M232.000,0.000 C232.000,64.151 180.376,116.580 116.238,116.580 C52.100,116.580 0.000,64.151 0.000,0.000 "/></svg>
				</span>
			</div>
			<?php endif; ?>
			<div class="content">
				<?php if ( $settings['title'] || $settings['subtitle'] ) : ?>
				<div class="titles">
					<?php if ( $settings['subtitle'] ) : ?>
					<div class="subtitle splitting-text-anim-2 scroll-animate" data-splitting="chars" data-animate="active">
						<span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
							<?php echo wp_kses_post( $settings['subtitle'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $settings['title'] ) : ?>
					<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title splitting-text-anim-1 scroll-animate" data-splitting="chars" data-animate="active">
						<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
							<?php echo wp_kses_post( $settings['title'] ); ?>
						</span>
					</<?php echo esc_attr( $settings['title_tag'] ); ?>>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ( $settings['description'] || $settings['items'] ) : ?>
				<div class="description scrolla-element-anim-1 scroll-animate" data-animate="active">
					<?php if ( $settings['description'] ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
						<?php echo wp_kses_post( $settings['description'] ); ?>
					</div>
					<?php endif; ?>
					<?php if ( $settings['items'] ) : ?>
					<div class="social-links">
						<?php foreach ( $settings['items'] as $index => $item ) : ?>
						<a<?php if ( $item['link'] ) : ?><?php if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php endif; ?>>
							<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</a>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
			<?php if ( $settings['list'] ) : ?>
			<div class="info-list">
				<ul>
          <?php foreach ( $settings['list'] as $index => $item ) :
              $item_name = $this->get_repeater_setting_key( 'name', 'list', $index );
              $this->add_inline_editing_attributes( $item_name, 'basic' );
            ?>
						<li class="scrolla-element-anim-1 scroll-animate" data-animate="active">
							<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
								<?php echo wp_kses_post( $item['name'] ); ?>
							</span>
						</li>
					<?php endforeach; ?>
				</ul>
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
	view.addInlineEditingAttributes( 'title', 'basic' );
	view.addInlineEditingAttributes( 'subtitle', 'basic' );
	view.addInlineEditingAttributes( 'description', 'advanced' );
	#>

	<!-- Section Hero Started -->
	<div class="section hero-started">

		<# if ( settings.image ) { #>
		<div class="slide scrolla-element-anim-1 scroll-animate" data-animate="active">
			<img src="{{{ settings.image.url }}}" alt="" />
      <span class="circle circle-1">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="749px" height="375px"><path fill-rule="evenodd" fill="#ff8059" d="M749.000,0.000 C749.000,206.786 581.459,374.514 374.608,374.514 C167.758,374.514 -0.000,206.786 -0.000,0.000 "/></svg>
      </span>
      <span class="circle circle-2">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="416px" height="209px"><path fill-rule="evenodd"  fill="#3aafc9" d="M-0.000,209.000 C-0.000,94.252 93.051,0.745 207.835,0.745 C322.619,0.745 416.000,94.252 416.000,209.000 "/></svg>
      </span>
      <span class="circle circle-3">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="416px" height="209px"><path fill-rule="evenodd"  fill="#b9d1e4" d="M-0.000,209.000 C-0.000,94.252 93.051,0.745 207.835,0.745 C322.619,0.745 416.000,94.252 416.000,209.000 "/></svg>
      </span>
      <span class="circle circle-4">
        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="121px" height="241px"><path fill-rule="evenodd"  fill="#676cdb" d="M0.000,0.000 C66.624,0.000 120.402,54.096 120.402,120.733 C120.402,187.371 66.624,241.000 0.000,241.000 "/></svg>
      </span>
      <span class="circle circle-5">
        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="232px" height="117px"><path fill-rule="evenodd"  fill="rgb(255, 208, 65)" d="M232.000,0.000 C232.000,64.151 180.376,116.580 116.238,116.580 C52.100,116.580 0.000,64.151 0.000,0.000 "/></svg>
      </span>
		</div>
		<# } #>

    <div class="content">
      <# if ( settings.title || settings.subtitle ) { #>
      <div class="titles">
        <# if ( settings.subtitle ) { #>
        <div class="subtitle splitting-text-anim-2 scroll-animate" data-splitting="chars" data-animate="active">
          <span {{{ view.getRenderAttributeString( 'subtitle' ) }}}>{{{ settings.subtitle }}}</span>
        </div>
        <# } #>
        <# if ( settings.title ) { #>
        <div class="title splitting-text-anim-1 scroll-animate" data-splitting="chars" data-animate="active">
          <span {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</span>
        </div>
        <# } #>
      </div>
      <# } #>
      <# if ( settings.description || settings.items ) { #>
      <div class="description scrolla-element-anim-1 scroll-animate" data-animate="active">
        <# if ( settings.description ) { #>
        <div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
        <# } #>
        <# if ( settings.items ) { #>
				<div class="social-links">
					<# _.each( settings.items, function( item, index ) {
						var iconHTML = elementor.helpers.renderIcon( view, item.icon, { 'aria-hidden': true }, 'i' , 'object' );
					#>
					<a<# if ( item.link ) { #><# if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}"<# } #>>
						{{{ iconHTML.value }}}
					</a>
					<# }); #>
				</div>
				<# } #>
      </div>
      <# } #>
    </div>

    <# if ( settings.list ) { #>
    <div class="info-list">
      <ul>
        <# _.each( settings.list, function( item, index ) {
            var item_name = view.getRepeaterSettingKey( 'name', 'list', index );
            view.addInlineEditingAttributes( item_name, 'basic' );
          #>
          <li class="scrolla-element-anim-1 scroll-animate" data-animate="active">
            <span {{{ view.getRenderAttributeString( item.name ) }}}>{{{ item.name }}}</span>
          </li>
        <# }); #>
      </ul>
    </div>
    <# } #>

	</div>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Hero_Image_Widget() );
