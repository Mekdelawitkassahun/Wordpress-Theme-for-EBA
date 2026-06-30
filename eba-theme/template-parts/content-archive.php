<?php
/**
 * Archive / news list item — matches original date block layout.
 */
$slug  = get_post_field( 'post_name', get_the_ID() );
$image = eba_post_image( $slug );
if ( ! $image ) {
	$image = get_post_meta( get_the_ID(), '_eba_image', true );
}
$full_content = eba_post_full_content( $slug );
$ts    = get_the_time( 'U' );
?>
<article <?php post_class( 'eba-archive-item' ); ?>>
	<div class="eba-archive-row">
		<div class="eba-date-block">
			<span class="eba-date-day"><?php echo esc_html( get_the_date( 'j' ) ); ?></span>
			<span class="eba-date-month"><?php echo esc_html( get_the_date( 'M' ) ); ?></span>
		</div>
		<div class="eba-archive-body">
			<h3 class="eba-archive-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="eba-archive-meta">
				<em><?php echo esc_html( human_time_diff( $ts, current_time( 'timestamp' ) ) ); ?> ago</em>
				<span class="eba-meta-sep">|</span>
				<span>0 Comments</span>
			</div>
			<?php if ( $image ) : ?>
				<a class="eba-archive-thumb" href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( eba_asset( $image ) ); ?>" alt=""></a>
			<?php endif; ?>
			<div class="eba-archive-excerpt"><?php echo esc_html( $full_content ); ?></div>
		</div>
	</div>
</article>
