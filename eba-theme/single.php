<?php get_header(); ?>
<main class="eba-main eba-inner">
	<div class="eba-wrap eba-columns">
		<div class="eba-content">
			<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$slug = get_post_field( 'post_name', get_the_ID() );
				$image = eba_post_image( $slug );
				$full_content = eba_post_full_content( $slug );
				?>
				<article <?php post_class(); ?>>
					<?php if ( $image ) : ?>
						<div class="eba-single-featured">
							<img src="<?php echo esc_url( eba_asset( $image ) ); ?>" alt="" style="width:100%;height:auto;object-fit:cover;border-radius:4px;margin-bottom:20px;">
						</div>
					<?php elseif ( has_post_thumbnail() ) : ?>
						<div class="eba-single-featured">
							<?php the_post_thumbnail( 'large', array( 'style' => 'width:100%;height:auto;object-fit:cover;border-radius:4px;margin-bottom:20px;' ) ); ?>
						</div>
					<?php endif; ?>
					<h1 class="eba-page-title"><?php the_title(); ?></h1>
					<?php eba_post_meta( get_the_date( 'F j, Y' ) ); ?>
					<div class="eba-entry">
						<?php if ( $full_content ) : ?>
							<?php echo $full_content; ?>
						<?php else : ?>
							<?php the_content(); ?>
						<?php endif; ?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<?php get_template_part( 'template-parts/sidebar' ); ?>
	</div>
</main>
<?php get_footer(); ?>
