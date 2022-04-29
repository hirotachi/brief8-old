<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
?>
<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-woo-product-title entry-title">
	<a itemprop="url" class="qodef-woo-product-title-link" href="<?php the_permalink(); ?>">
		<?php the_title(); ?>
	</a>
</<?php echo esc_attr( $title_tag ); ?>>
