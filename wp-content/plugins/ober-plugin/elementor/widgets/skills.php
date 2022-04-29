<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Resume Widget.
 *
 * @since 1.0
 */
class Ober_Skills_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-skills';
	}

	public function get_title() {
		return esc_html__( 'Skills', 'ober-plugin' );
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
			'skills_tab',
			[
				'label' => esc_html__( 'Skills', 'ober-plugin' ),
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default' => esc_html__( 'Enter title', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'value', [
				'label'       => esc_html__( 'Value', 'ober-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Enter value', 'ober-plugin' ),
				'default' => esc_html__( 'Enter value', 'ober-plugin' ),
			]
		);

		$this->add_control(
			'skills',
			[
				'label' => esc_html__( 'Items', 'ober-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
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
			'label_color',
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
				'name'     => 'label_typography',
				'label'     => esc_html__( 'Title Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .p-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'skills_styling',
			[
				'label'     => esc_html__( 'Skills Items', 'ober-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Title Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .skills-item .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'     => esc_html__( 'Title Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .skills-item .name',
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => esc_html__( 'Dots Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .skills-item .dots .dot' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'value_color',
			[
				'label'     => esc_html__( 'Value Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .skills-item .value .num' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'value_typography',
				'label'     => esc_html__( 'Value Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .skills-item .value .num',
			]
		);

		$this->add_control(
			'value_bg_color',
			[
				'label'     => esc_html__( 'Value BG Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .skills-item .value .num' => 'background-color: {{VALUE}};',
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

		$this->add_inline_editing_attributes( 'label', 'basic' );

		?>

		<!-- Skills -->
		<?php if ( $settings['skills'] ) : ?>
		<div class="skills-items">
			<?php if ( $settings['label'] ) : ?>
			<div class="p-title scrolla-element-anim-1 scroll-animate" data-animate="active">
				<span <?php echo $this->get_render_attribute_string( 'label' ); ?>>
					<?php echo wp_kses_post( $settings['label'] ); ?>
				</span>
			</div>
			<?php endif; ?>
			<?php foreach ( $settings['skills'] as $index => $item ) :
		    	$item_name = $this->get_repeater_setting_key( 'name', 'skills', $index );
		    	$this->add_inline_editing_attributes( $item_name, 'basic' );

		    	$item_value = $this->get_repeater_setting_key( 'value', 'skills', $index );
		    	$this->add_inline_editing_attributes( $item_value, 'basic' );
		    ?>
		    <div class="skills-item scrolla-element-anim-1 scroll-animate" data-animate="active">
				<?php if ( $item['name'] ) : ?>
				<div class="name">
					<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
						<?php echo wp_kses_post( $item['name'] ); ?>
					</span>
				</div>
				<?php endif; ?>
				<?php if ( $item['value'] ) : ?>
				<div class="dots dots-<?php echo esc_attr( $item['value'] ); ?>">
					<div class="dots-row">
						<div class="dot"></div>
						<div class="dot"></div>
						<div class="dot"></div>
						<div class="dot"></div>
						<div class="dot"></div>
						<div class="dot"></div>
						<div class="dot"></div>
						<div class="dot"></div>
						<div class="dot"></div>
						<div class="dot"></div>
					</div>
				</div>
				<div class="value"><span class="num"><?php echo esc_html( $item['value'] ); ?>%</span></div>
				<?php endif; ?>
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
	view.addInlineEditingAttributes( 'label', 'basic' );
	#>

	<!-- Skills -->
	<# if ( settings.skills ) { #>
	<div class="skills-items">
		<# if ( settings.label ) { #>
		<div class="p-title">
			<span {{{ view.getRenderAttributeString( 'label' ) }}}>{{{ settings.label }}}</span>
		</div>
		<# } #>
		<# _.each( settings.skills, function( item, index ) {
	    	var item_name = view.getRepeaterSettingKey( 'name', 'skills', index );
	    	view.addInlineEditingAttributes( item_name, 'basic' );

	        var item_value = view.getRepeaterSettingKey( 'value', 'skills', index );
	    	view.addInlineEditingAttributes( item_value, 'basic' );
	    #>
	    <div class="skills-item">
  			<# if ( item.name ) { #>
  			<div class="name">
  				<span {{{ view.getRenderAttributeString( 'name' ) }}}>{{{ item.name }}}</span>
  			</div>
  			<# } #>
  			<# if ( item.value ) { #>
  			<div class="dots dots-{{{ item.value }}}">
  				<div class="dots-row">
  					<div class="dot"></div>
  					<div class="dot"></div>
  					<div class="dot"></div>
  					<div class="dot"></div>
  					<div class="dot"></div>
  					<div class="dot"></div>
  					<div class="dot"></div>
  					<div class="dot"></div>
  					<div class="dot"></div>
  					<div class="dot"></div>
  				</div>
  			</div>
  			<div class="value"><span class="num">{{{ item.value }}}%</span></div>
  			<# } #>
  		</div>
		<# }); #>
	</div>
	<# } #>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Skills_Widget() );
