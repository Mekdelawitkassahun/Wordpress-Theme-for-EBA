<?php get_header(); ?>
<main class="eba-main eba-inner">
	<div class="eba-wrap eba-columns">
		<div class="eba-content">
			<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
			<h1 class="eba-page-title"><?php the_archive_title(); ?></h1>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content-archive' ); ?>
			<?php endwhile; the_posts_pagination(); else : ?>
				<div class="eba-coming-soon-container" style="text-align: center; padding: 60px 20px; background: #fafafa; border: 1px dashed #ccc; border-radius: 8px; margin: 20px 0;">
					<div class="eba-coming-soon-icon" style="font-size: 48px; color: var(--eba-blue); margin-bottom: 20px;">
						<i class="fa fa-clock-o"></i>
					</div>
					<h2 style="font-size: 24px; color: #333; margin-bottom: 10px;">Coming Soon</h2>
					<p style="color: #666; font-size: 14px; max-width: 400px; margin: 0 auto 20px;">We are currently working hard to compile this archive. Please check back later!</p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="eba-coming-soon-btn" style="display: inline-block; background: var(--eba-blue); color: #fff; padding: 10px 20px; border-radius: 4px; font-weight: bold; text-decoration: none; font-size: 13px; transition: background 0.3s;">Go Back Home</a>
				</div>
			<?php endif; ?>
		</div>
		<?php get_template_part( 'template-parts/sidebar' ); ?>
	</div>
</main>
<?php get_footer(); ?>
