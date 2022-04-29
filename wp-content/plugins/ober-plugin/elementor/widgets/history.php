<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Resume Widget.
 *
 * @since 1.0
 */
class Ober_History_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-history';
	}

	public function get_title() {
		return esc_html__( 'History', 'ober-plugin' );
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
			'education_tab',
			[
				'label' => esc_html__( 'Education', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'edu_label',
			[
				'label'       => esc_html__( 'Title', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default'     => esc_html__( 'Title', 'ober-plugin' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'date', [
				'label'       => esc_html__( 'Date', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter date', 'ober-plugin' ),
				'default' => esc_html__( 'Enter date', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter name', 'ober-plugin' ),
				'default' => esc_html__( 'Enter name', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'subname', [
				'label'       => esc_html__( 'Subname', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subname', 'ober-plugin' ),
				'default' => esc_html__( 'Enter subname', 'ober-plugin' ),
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

		$this->add_control(
			'education',
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
			'awards_tab',
			[
				'label' => esc_html__( 'Awards', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'awa_label',
			[
				'label'       => esc_html__( 'Title', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default'     => esc_html__( 'Title', 'ober-plugin' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'date', [
				'label'       => esc_html__( 'Date', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter date', 'ober-plugin' ),
				'default' => esc_html__( 'Enter date', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter name', 'ober-plugin' ),
				'default' => esc_html__( 'Enter name', 'ober-plugin' ),
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

		$this->add_control(
			'awards',
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
			'experience_tab',
			[
				'label' => esc_html__( 'Experience', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'exp_label',
			[
				'label'       => esc_html__( 'Title', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'ober-plugin' ),
				'default'     => esc_html__( 'Title', 'ober-plugin' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'date', [
				'label'       => esc_html__( 'Date', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter date', 'ober-plugin' ),
				'default' => esc_html__( 'Enter date', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter name', 'ober-plugin' ),
				'default' => esc_html__( 'Enter name', 'ober-plugin' ),
			]
		);

		$repeater->add_control(
			'subname', [
				'label'       => esc_html__( 'Subname', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subname', 'ober-plugin' ),
				'default' => esc_html__( 'Enter subname', 'ober-plugin' ),
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

		$this->add_control(
			'experience',
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
			'titles_styling',
			[
				'label'     => esc_html__( 'Titles', 'ober-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Titles Color', 'ober-plugin' ),
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
				'label'     => esc_html__( 'Titles Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .p-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_styling',
			[
				'label'     => esc_html__( 'Items', 'ober-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'date_color',
			[
				'label'     => esc_html__( 'Date Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .history-item .date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'date_typography',
				'label'     => esc_html__( 'Date Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .history-item .date',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Name Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .history-item .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'     => esc_html__( 'Name Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .history-item .name',
			]
		);

		$this->add_control(
			'subname_color',
			[
				'label'     => esc_html__( 'Subname Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .history-item .subname' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subname_typography',
				'label'     => esc_html__( 'Subname Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .history-item .subname',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .history-item .text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .history-item .text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'     => esc_html__( 'Text Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .history-item .text',
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

		$this->add_inline_editing_attributes( 'edu_label', 'basic' );
		$this->add_inline_editing_attributes( 'awa_label', 'basic' );
		$this->add_inline_editing_attributes( 'exp_label', 'basic' );

		?>

		<!-- History -->
		<div class="history-left">

			<?php if ( $settings['education'] ) : ?>
			<div class="history-items">
				<?php if ( $settings['edu_label'] ) : ?>
				<div class="p-title scrolla-element-anim-1 scroll-animate" data-animate="active">
					<span <?php echo $this->get_render_attribute_string( 'edu_label' ); ?>>
						<?php echo wp_kses_post( $settings['edu_label'] ); ?>
					</span>
				</div>
				<?php endif; ?>
				<?php foreach ( $settings['education'] as $index => $item ) :
			    	$item_date = $this->get_repeater_setting_key( 'date', 'education', $index );
			    	$this->add_inline_editing_attributes( $item_date, 'basic' );

			    	$item_name = $this->get_repeater_setting_key( 'name', 'education', $index );
			    	$this->add_inline_editing_attributes( $item_name, 'basic' );

			    	$item_subname = $this->get_repeater_setting_key( 'subname', 'education', $index );
			    	$this->add_inline_editing_attributes( $item_subname, 'basic' );

			    	$item_text = $this->get_repeater_setting_key( 'text', 'education', $index );
			    	$this->add_inline_editing_attributes( $item_text, 'basic' );
			    ?>
			    <div class="history-item scrolla-element-anim-1 scroll-animate" data-animate="active">
					<?php if ( $item['date'] ) : ?>
					<div class="date">
						<span <?php echo $this->get_render_attribute_string( $item_date ); ?>>
							<?php echo wp_kses_post( $item['date'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['name'] ) : ?>
					<div class="name">
						<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
							<?php echo wp_kses_post( $item['name'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['subname'] ) : ?>
					<div class="subname">
						<span <?php echo $this->get_render_attribute_string( $item_subname ); ?>>
							<?php echo wp_kses_post( $item['subname'] ); ?>
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
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php if ( $settings['awards'] ) : ?>
			<div class="history-items">
				<?php if ( $settings['awa_label'] ) : ?>
				<div class="p-title scrolla-element-anim-1 scroll-animate" data-animate="active">
					<span <?php echo $this->get_render_attribute_string( 'awa_label' ); ?>>
						<?php echo wp_kses_post( $settings['awa_label'] ); ?>
					</span>
				</div>
				<?php endif; ?>
				<?php foreach ( $settings['awards'] as $index => $item ) :
			    	$item_date = $this->get_repeater_setting_key( 'date', 'awards', $index );
			    	$this->add_inline_editing_attributes( $item_date, 'basic' );

			    	$item_name = $this->get_repeater_setting_key( 'name', 'awards', $index );
			    	$this->add_inline_editing_attributes( $item_name, 'basic' );

			    	$item_text = $this->get_repeater_setting_key( 'text', 'awards', $index );
			    	$this->add_inline_editing_attributes( $item_text, 'basic' );
			    ?>
			    <div class="history-item scrolla-element-anim-1 scroll-animate" data-animate="active">
					<?php if ( $item['date'] ) : ?>
					<div class="date">
						<span <?php echo $this->get_render_attribute_string( $item_date ); ?>>
							<?php echo wp_kses_post( $item['date'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['name'] ) : ?>
					<div class="name">
						<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
							<?php echo wp_kses_post( $item['name'] ); ?>
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
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

		</div>

		<div class="history-right">

			<?php if ( $settings['experience'] ) : ?>
			<div class="history-items">
				<?php if ( $settings['exp_label'] ) : ?>
				<div class="p-title scrolla-element-anim-1 scroll-animate" data-animate="active">
					<span <?php echo $this->get_render_attribute_string( 'exp_label' ); ?>>
						<?php echo wp_kses_post( $settings['exp_label'] ); ?>
					</span>
				</div>
				<?php endif; ?>
				<?php foreach ( $settings['experience'] as $index => $item ) :
			    	$item_date = $this->get_repeater_setting_key( 'date', 'experience', $index );
			    	$this->add_inline_editing_attributes( $item_date, 'basic' );

			    	$item_name = $this->get_repeater_setting_key( 'name', 'experience', $index );
			    	$this->add_inline_editing_attributes( $item_name, 'basic' );

			    	$item_subname = $this->get_repeater_setting_key( 'subname', 'experience', $index );
			    	$this->add_inline_editing_attributes( $item_subname, 'basic' );

			    	$item_text = $this->get_repeater_setting_key( 'text', 'experience', $index );
			    	$this->add_inline_editing_attributes( $item_text, 'basic' );
			    ?>
			    <div class="history-item scrolla-element-anim-1 scroll-animate" data-animate="active">
					<?php if ( $item['date'] ) : ?>
					<div class="date">
						<span <?php echo $this->get_render_attribute_string( $item_date ); ?>>
							<?php echo wp_kses_post( $item['date'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['name'] ) : ?>
					<div class="name">
						<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
							<?php echo wp_kses_post( $item['name'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['subname'] ) : ?>
					<div class="subname">
						<span <?php echo $this->get_render_attribute_string( $item_subname ); ?>>
							<?php echo wp_kses_post( $item['subname'] ); ?>
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
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

		</div>
		<div class="clear"></div>

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
	view.addInlineEditingAttributes( 'edu_label', 'basic' );
	view.addInlineEditingAttributes( 'awa_label', 'basic' );
	view.addInlineEditingAttributes( 'exp_label', 'basic' );
	#>

	<!-- History -->
	<div class="history-left">

		<# if ( settings.education ) { #>
		<div class="history-items">
			<# if ( settings.edu_label ) { #>
			<div class="p-title">
				<span {{{ view.getRenderAttributeString( 'edu_label' ) }}}>{{{ settings.edu_label }}}</span>
			</div>
			<# } #>
			<# _.each( settings.education, function( item, index ) {
		    	var item_date = view.getRepeaterSettingKey( 'date', 'education', index );
		    	view.addInlineEditingAttributes( item_date, 'basic' );

		        var item_name = view.getRepeaterSettingKey( 'name', 'education', index );
		    	view.addInlineEditingAttributes( item_name, 'basic' );

		    	var item_subname = view.getRepeaterSettingKey( 'subname', 'education', index );
		    	view.addInlineEditingAttributes( item_subname, 'basic' );

		    	var item_text = view.getRepeaterSettingKey( 'text', 'education', index );
		    	view.addInlineEditingAttributes( item_text, 'basic' );
		    #>
		    <div class="history-item scrolla-element-anim-1 scroll-animate" data-animate="active">
				<# if ( item.date ) { #>
				<div class="date">
					<span {{{ view.getRenderAttributeString( 'date' ) }}}>{{{ item.date }}}</span>
				</div>
				<# } #>
				<# if ( item.name ) { #>
				<div class="name">
					<span {{{ view.getRenderAttributeString( 'name' ) }}}>{{{ item.name }}}</span>
				</div>
				<# } #>
				<# if ( item.subname ) { #>
				<div class="subname">
					<span {{{ view.getRenderAttributeString( 'subname' ) }}}>{{{ item.subname }}}</span>
				</div>
				<# } #>
				<# if ( item.text ) { #>
				<div class="text">
					<div {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ item.text }}}</div>
				</div>
				<# } #>
			</div>
			<# }); #>
		</div>
		<# } #>

		<# if ( settings.awards ) { #>
		<div class="history-items">
			<# if ( settings.awa_label ) { #>
			<div class="p-title">
				<span {{{ view.getRenderAttributeString( 'awa_label' ) }}}>{{{ settings.awa_label }}}</span>
			</div>
			<# } #>
			<# _.each( settings.awards, function( item, index ) {
		    	var item_date = view.getRepeaterSettingKey( 'date', 'awards', index );
		    	view.addInlineEditingAttributes( item_date, 'basic' );

		        var item_name = view.getRepeaterSettingKey( 'name', 'awards', index );
		    	view.addInlineEditingAttributes( item_name, 'basic' );

		    	var item_text = view.getRepeaterSettingKey( 'text', 'awards', index );
		    	view.addInlineEditingAttributes( item_text, 'basic' );
		    #>
		    <div class="history-item scrolla-element-anim-1 scroll-animate" data-animate="active">
				<# if ( item.date ) { #>
				<div class="date">
					<span {{{ view.getRenderAttributeString( 'date' ) }}}>{{{ item.date }}}</span>
				</div>
				<# } #>
				<# if ( item.name ) { #>
				<div class="name">
					<span {{{ view.getRenderAttributeString( 'name' ) }}}>{{{ item.name }}}</span>
				</div>
				<# } #>
				<# if ( item.text ) { #>
				<div class="text">
					<div {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ item.text }}}</div>
				</div>
				<# } #>
			</div>
			<# }); #>
		</div>
		<# } #>

	</div>

	<div class="history-right">

		<# if ( settings.experience ) { #>
		<div class="history-items">
			<# if ( settings.exp_label ) { #>
			<div class="p-title">
				<span {{{ view.getRenderAttributeString( 'exp_label' ) }}}>{{{ settings.exp_label }}}</span>
			</div>
			<# } #>
		    <# _.each( settings.experience, function( item, index ) {
		    	var item_date = view.getRepeaterSettingKey( 'date', 'experience', index );
		    	view.addInlineEditingAttributes( item_date, 'basic' );

		        var item_name = view.getRepeaterSettingKey( 'name', 'experience', index );
		    	view.addInlineEditingAttributes( item_name, 'basic' );

		    	var item_subname = view.getRepeaterSettingKey( 'subname', 'experience', index );
		    	view.addInlineEditingAttributes( item_subname, 'basic' );

		    	var item_text = view.getRepeaterSettingKey( 'text', 'experience', index );
		    	view.addInlineEditingAttributes( item_text, 'basic' );
		    #>
		    <div class="history-item scrolla-element-anim-1 scroll-animate" data-animate="active">
				<# if ( item.date ) { #>
				<div class="date">
					<span {{{ view.getRenderAttributeString( 'date' ) }}}>{{{ item.date }}}</span>
				</div>
				<# } #>
				<# if ( item.name ) { #>
				<div class="name">
					<span {{{ view.getRenderAttributeString( 'name' ) }}}>{{{ item.name }}}</span>
				</div>
				<# } #>
				<# if ( item.subname ) { #>
				<div class="subname">
					<span {{{ view.getRenderAttributeString( 'subname' ) }}}>{{{ item.subname }}}</span>
				</div>
				<# } #>
				<# if ( item.text ) { #>
				<div class="text">
					<div {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ item.text }}}</div>
				</div>
				<# } #>
			</div>
			<# }); #>
		</div>
		<# } #>

	</div>
	<div class="clear"></div>

	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_History_Widget() );
