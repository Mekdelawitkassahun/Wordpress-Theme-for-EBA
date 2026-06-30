<?php get_header(); ?>
<main class="eba-main eba-inner">
	<div class="eba-wrap eba-columns">
		<div class="eba-content">
			<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
			<h1 class="eba-page-title">Search: <?php echo esc_html( get_search_query() ); ?></h1>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content-archive' ); ?>
			<?php endwhile; else : ?>
				<p>No results found.</p>
			<?php endif; ?>
		</div>
		<?php get_template_part( 'template-parts/sidebar' ); ?>
	</div>
</main>
<?php get_footer(); ?>
