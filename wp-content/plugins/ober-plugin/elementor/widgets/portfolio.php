<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Portfolio Widget.
 *
 * @since 1.0
 */
class Ober_Portfolio_Module_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-portfolio-module';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Module', 'ober-plugin' );
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
			'filters_tab',
			[
				'label' => esc_html__( 'Filters', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filters_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Filters show only with pagination "Infinite Scrolling", "Button" or "No"', 'ober-plugin' ),
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->add_control(
			'filters',
			[
				'label' => esc_html__( 'Show Filters', 'ober-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ober-plugin' ),
				'label_off' => __( 'Hide', 'ober-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'ober-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'source',
			[
				'label'       => esc_html__( 'Source', 'ober-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all'  => __( 'All', 'ober-plugin' ),
					'categories' => __( 'Categories', 'ober-plugin' ),
				],
			]
		);

		$this->add_control(
			'source_categories',
			[
				'label'       => esc_html__( 'Source', 'ober-plugin' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->get_portfolio_categories(),
				'condition' => [
		            'source' => 'categories'
		        ],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'       => esc_html__( 'Number of Items', 'ober-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => 8,
				'default'     => 8,
			]
		);

		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Sorting By', 'ober-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'menu_order',
				'options' => [
					'date'  => __( 'Date', 'ober-plugin' ),
					'title' => __( 'Title', 'ober-plugin' ),
					'rand' => __( 'Random', 'ober-plugin' ),
					'menu_order' => __( 'Order', 'ober-plugin' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => esc_html__( 'Order', 'ober-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc'  => __( 'ASC', 'ober-plugin' ),
					'desc' => __( 'DESC', 'ober-plugin' ),
				],
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

		$this->add_control(
			'layouts',
			[
				'label'       => esc_html__( 'Layout', 'ober-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'list',
				'options' => [
					'list'  => __( 'List', 'ober-plugin' ),
					'masonry'  => __( 'Masonry', 'ober-plugin' ),
				],
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'       => esc_html__( 'Pagination', 'ober-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'loadmore'  => __( 'Load More', 'ober-plugin' ),
					'button'  => __( 'Button', 'ober-plugin' ),
				],
			]
		);

    $this->add_control(
			'load_more_btn_txt',
			[
				'label'       => esc_html__( 'Button (label)', 'ober-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter button', 'ober-plugin' ),
				'default'     => esc_html__( 'Load More', 'ober-plugin' ),
				'condition' => [
		            'pagination' => 'loadmore'
		        ],
			]
		);

    $this->add_control(
			'more_text', [
				'label' => esc_html__( 'Button (Text)', 'ober-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Text', 'ober-plugin' ),
				'default' => esc_html__( 'view work', 'ober-plugin' ),
        'condition' => [
		            'pagination' => 'button'
		        ],
			]
		);

		$this->add_control(
			'more_link', [
				'label' => esc_html__( 'Button (URL)', 'ober-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
        'condition' => [
		            'pagination' => 'button'
		        ],
			]
		);

		$this->add_control(
			'show_category',
			[
				'label'       => esc_html__( 'Show Category?', 'ober-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'no'  => __( 'No', 'ober-plugin' ),
					'yes' => __( 'Yes', 'ober-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'filters_styling',
			[
				'label'     => esc_html__( 'Filters', 'ober-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'filters_color',
			[
				'label'     => esc_html__( 'Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .filter-links a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'filters_active_color',
			[
				'label'     => esc_html__( 'Active Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .filter-links a.active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'filters_typography',
				'selector' => '{{WRAPPER}} .filter-links a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_styling',
			[
				'label'     => esc_html__( 'Portfolio Items', 'ober-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_list_title_color',
			[
				'label'     => esc_html__( 'Item (List) Title Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .works-items.works-list-items .works-item .desc .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_list_title_typography',
				'label'     => esc_html__( 'Item (List) Title Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .works-items.works-list-items .works-item .desc .name',
			]
		);

		$this->add_control(
			'item_list_cat_color',
			[
				'label'     => esc_html__( 'Item (List) Categories Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .works-items.works-list-items .works-item .desc .category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_list_cat_typography',
				'label'     => esc_html__( 'Item (List) Categories Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .works-items.works-list-items .works-item .desc .category',
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Item (Grid) Title Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Item (Grid) Title Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .name',
			]
		);

		$this->add_control(
			'item_cat_color',
			[
				'label'     => esc_html__( 'Item (Grid) Categories Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_cat_typography',
				'label'     => esc_html__( 'Item (Grid) Categories Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .category',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Categories List.
	 *
	 * @since 1.0
	 */
	protected function get_portfolio_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false
		);

		$portfolio_categories = get_categories( $args );

		foreach ( $portfolio_categories as $category ) {
			$categories[$category->term_id] = $category->name;
		}

		return $categories;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'title', 'basic' );

		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$page_id = get_the_ID();

		if ( $settings['source'] == 'all' ) {
			$cat_ids = '';
		} else {
			$cat_ids = $settings['source_categories'];
		}

		$cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false,
			'include'		=> $cat_ids
		);

		$pf_categories = get_categories( $cat_args );

		$args = array(
			'post_type'			=> 'portfolio',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page'	=> $settings['limit'],
			'paged' 			=> $paged
		);

		if( $settings['source'] == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'portfolio_categories',
					'field'    => 'id',
					'terms'    => $cat_ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}

		$q = new \WP_Query( $args );

		$temp = 'portfolio';

		$item_classes = '';

		if ( $settings['show_category'] == 'no' ) :
			$item_classes .= ' hide_category';
		endif;

		?>

		<!-- Works -->
    <div class="works-box">

  		<?php if ( $settings['filters'] && $pf_categories) : ?>
  		<div class="filter-links scrolla-element-anim-1 scroll-animate" data-animate="active">
  			<a href="#" class="active" data-href=".works-col">
  				<?php echo esc_html__( 'All', 'ober-plugin' ); ?>
  			</a>
  			<?php foreach ( $pf_categories as $category ) : ?>
  			<a href="#" data-href=".sorting-<?php echo esc_attr( $category->slug ); ?>">
  				<?php echo esc_html( $category->name ); ?>
  			</a>
  			<?php endforeach; ?>
  		</div>
  		<?php endif; ?>

  		<?php if ( $q->have_posts() ) : ?>
  		<div class="works-items<?php if ( $settings['layouts'] == 'list' ) : ?> works-list-items<?php endif; ?><?php if ( $settings['layouts'] == 'masonry' ) : ?> works-masonry-items<?php endif; ?> row<?php echo esc_html( $item_classes ); ?>">
  			<?php while ( $q->have_posts() ) : $q->the_post();
  				get_template_part( 'template-parts/content', $temp );
  			endwhile; ?>
  		</div>
      <?php endif; ?>

      <?php if ( $settings['pagination'] == 'loadmore' ) :
        $infinite_scrolling_data = array(
          'url'   => admin_url( 'admin-ajax.php' ),
					'ajax_nonce' => wp_create_nonce('ober_ajax'),
          'max_num' => $q->max_num_pages,
          'page_id' => $page_id,
          'order_by' => $settings['sort'],
          'order' => $settings['order'],
          'per_page' => $settings['limit'],
          'source' => $settings['source'],
          'temp' => $temp,
          'cat_ids' => $cat_ids
        );

        wp_enqueue_script( 'ober-portfolio-load-more-el', get_template_directory_uri() . '/assets/js/portfolio-load-more-el.js', array( 'jquery' ), '1.0', true );
        wp_localize_script( 'ober-portfolio-load-more-el', 'ajax_portfolio_infinite_scroll_data', $infinite_scrolling_data );
      ?>
      <div class="load-more">
        <a href="#" class="btn scrolla-element-anim-1 scroll-animate" data-animate="active"><?php echo esc_html( $settings['load_more_btn_txt'] ); ?></a>
      </div>
      <?php endif; ?>
  		<?php if ( $settings['pagination'] == 'button' ) : ?>
      <div class="load-more-link">
      	<?php if ( $settings['more_text'] ) : ?>
  			<a<?php if ( $settings['more_link'] ) : ?><?php if ( $settings['more_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['more_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['more_link']['url'] ); ?>"<?php endif; ?> class="btn scrolla-element-anim-1 scroll-animate" data-animate="active">
  				<?php echo esc_html( $settings['more_text'] ); ?>
  			</a>
  			<?php endif; ?>
  		</div>
      <?php endif; ?>

		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Portfolio_Module_Widget() );
