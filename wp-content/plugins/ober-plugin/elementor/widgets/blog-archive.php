<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Ober Archive Widget.
 *
 * @since 1.0
 */
class Ober_Archive_Widget extends Widget_Base {

	public function get_name() {
		return 'ober-archive';
	}

	public function get_title() {
		return esc_html__( 'Archive', 'ober-plugin' );
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
				'options' => $this->get_blog_categories(),
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
				'placeholder' => 6,
				'default'     => 6,
			]
		);

		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Sorting By', 'ober-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'date',
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
				'default' => 'desc',
				'options' => [
					'asc'  => __( 'ASC', 'ober-plugin' ),
					'desc' => __( 'DESC', 'ober-plugin' ),
				],
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
			'item_details_color',
			[
				'label'     => esc_html__( 'Details Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .archive-item .desc .category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_details_typography',
				'label'     => esc_html__( 'Details Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .archive-item .desc .category',
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .archive-item .desc .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .archive-item .desc .title',
			]
		);

		$this->add_control(
			'item_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .archive-item .desc .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_text_typography',
				'label'     => esc_html__( 'Text Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .archive-item .desc .text',
			]
		);

		$this->add_control(
			'item_readmore_color',
			[
				'label'     => esc_html__( 'Readmore Color', 'ober-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .archive-item .desc .readmore .lnk' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_readmore_typography',
				'label'     => esc_html__( 'Readmore Typography', 'ober-plugin' ),
				'selector' => '{{WRAPPER}} .archive-item .desc .readmore .lnk',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Categories List.
	 *
	 * @since 1.0
	 */
	protected function get_blog_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'category',
			'pad_counts'	=> false
		);

		$blog_categories = get_categories( $args );

		foreach ( $blog_categories as $category ) {
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
			'taxonomy'		=> 'category',
			'pad_counts'	=> false,
			'include'		=> $cat_ids
		);

		$bp_categories = get_categories( $cat_args );

		$args = array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page'	=> $settings['limit'],
			'paged' 			=> $paged
		);

		if( $settings['source'] == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $cat_ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}

		$q = new \WP_Query( $args );

		?>

		<!-- Archive -->
		<?php if ( $q->have_posts() ) : ?>

		<div class="blog-items">
			<?php
				while ( $q->have_posts() ) : $q->the_post();
					get_template_part( 'template-parts/content' );
				endwhile;
			?>
		</div>

		<div class="pager">
			<?php
				$big = 999999999; // need an unlikely integer

				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $q->max_num_pages,
					'prev_text' => '<i class="icon-arrow"></i>',
					'next_text' => '<i class="icon-arrow"></i>',
				) );
			?>
		</div>
		<?php else :
			get_template_part( 'template-parts/content', 'none' );
		endif; wp_reset_postdata(); ?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ober_Archive_Widget() );
