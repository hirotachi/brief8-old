<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Services Widget.
 *
 * @since 1.0
 */
class Ober_Services_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-services';
	}

	public function get_title() {
		return esc_html__( 'Services', 'ober-plugin' );
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
			'services_tab',
			[
				'label' => esc_html__( 'Services', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'serv_label',
			[
				'label'       => esc_html__( 'Title', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default'     => esc_html__( 'Title', 'ober-plugin' ),
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
			'title', [
				'label'       => esc_html__( 'Title', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default' => esc_html__( 'Enter title', 'ober-plugin' ),
			]
		);

    $repeater->add_control(
			'text', [
				'label'       => esc_html__( 'Description', 'ober-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter description', 'ober-plugin' ),
				'default' => esc_html__( 'Enter description', 'ober-plugin' ),
			]
		);

    $repeater->add_control(
			'more_text', [
				'label' => esc_html__( 'Button (Text)', 'ober-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Text', 'ober-plugin' ),
				'default' => esc_html__( 'view work', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'more_link', [
				'label' => esc_html__( 'Button (URL)', 'ober-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
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

		$this->end_controls_section();

		$this->start_controls_section(
			'services_styling',
			[
				'label'     => esc_html__( 'Services Items', 'ober-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .services-item .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Title Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .services-item .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'     => esc_html__( 'Title Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .services-item .title',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .services-item .text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .services-item .text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'     => esc_html__( 'Description Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .services-item .text',
			]
		);

		$this->add_control(
			'lnk_color',
			[
				'label'     => esc_html__( 'Link Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .services-item .lnk' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'lnk_typography',
				'label'     => esc_html__( 'Link Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .services-item .lnk',
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

		$this->add_inline_editing_attributes( 'serv_label', 'basic' );

		?>

		<!-- Services -->
    <?php if ( $settings['serv_label'] ) : ?>
		<div class="p-title scrolla-element-anim-1 scroll-animate" data-animate="active">
			<span <?php echo $this->get_render_attribute_string( 'serv_label' ); ?>>
				<?php echo wp_kses_post( $settings['serv_label'] ); ?>
			</span>
		</div>
		<?php endif; ?>
    <?php if ( $settings['items'] ) : ?>
		<div class="services-items">
			<?php foreach ( $settings['items'] as $index => $item ) :
		    	$item_name = $this->get_repeater_setting_key( 'title', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_name, 'basic' );

          $item_text = $this->get_repeater_setting_key( 'text', 'items', $index );
          $this->add_inline_editing_attributes( $item_text, 'basic' );
		    ?>
      <div class="services-col">
  		  <div class="services-item scrolla-element-anim-1 scroll-animate" data-animate="active">
  		    	<?php if ( $item['icon'] ) : ?>
  		    	<div class="icon">
  						<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
  					</div>
  					<?php endif; ?>
  					<?php if ( $item['title'] ) : ?>
  					<div class="title">
  						<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
  							<?php echo wp_kses_post( $item['title'] ); ?>
  						</span>
  					</div>
  					<?php endif; ?>
            <?php if ( $item['text'] ) : ?>
  					<div class="text">
  						<div <?php echo $this->get_render_attribute_string( $item_text ); ?>>
  							<?php echo wp_kses_post( $item['text'] ); ?>
  						</div>
  					</div>
  					<?php endif; ?>
            <?php if ( $item['more_text'] ) : ?>
  					<a<?php if ( $item['more_link'] ) : ?><?php if ( $item['more_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['more_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['more_link']['url'] ); ?>"<?php endif; ?> class="lnk">
  						<?php echo esc_html( $item['more_text'] ); ?>
  					</a>
  					<?php endif; ?>
  			</div>
      </div>
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
	protected function content_template() { ?>

	<#
	view.addInlineEditingAttributes( 'serv_label', 'basic' );
	#>

	<!-- Services -->
  <# if ( settings.serv_label ) { #>
  <div class="p-title">
    <span {{{ view.getRenderAttributeString( 'serv_label' ) }}}>{{{ settings.serv_label }}}</span>
  </div>
  <# } #>
	<# if ( settings.items ) { #>
	<div class="services-items">
		<# _.each( settings.items, function( item, index ) {
	    	var item_name = view.getRepeaterSettingKey( 'title', 'items', index );
	    	view.addInlineEditingAttributes( item_name, 'basic' );

	      var item_text = view.getRepeaterSettingKey( 'text', 'items', index );
	    	view.addInlineEditingAttributes( item_text, 'basic' );

	    	var iconHTML = elementor.helpers.renderIcon( view, item.icon, { 'aria-hidden': true }, 'i' , 'object' );
	    #>
    <div class="services-col">
  	  <div class="services-item">
  	    	<# if ( item.icon ) { #>
  	    	<div class="icon">
    				{{{ iconHTML.value }}}
    			</div>
    			<# } #>
    			<# if ( item.title ) { #>
    			<div class="title">
    				<span {{{ view.getRenderAttributeString( 'item_name' ) }}}>{{{ item.title }}}</span>
    			</div>
    			<# } #>
          <# if ( item.text ) { #>
          <div class="text">
            <div {{{ view.getRenderAttributeString( 'item_text' ) }}}>{{{ item.text }}}</div>
          </div>
          <# } #>
          <# if ( item.more_text ) { #>
          <a<# if ( item.link ) { #><# if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}"<# } #> class="lnk">
            {{{ item.more_text }}}
          </a>
          <# } #>
  		</div>
    </div>
		<# }); #>
	</div>
	<# } #>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Services_Widget() );
