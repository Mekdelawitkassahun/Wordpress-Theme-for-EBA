<?php get_header(); ?>
<main class="eba-main eba-inner">
	<div class="eba-wrap eba-columns">
		<div class="eba-content">
			<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
			<h1 class="eba-page-title">News</h1>
			<?php 
			// Use the same data as home page for consistent dates
			$all_posts = eba_all_posts();
			if ( ! empty( $all_posts ) ) : 
				foreach ( $all_posts as $post ) : 
					$slug = $post['slug'];
					$image = eba_post_image( $slug );
					$full_content = eba_post_full_content( $slug );
					$date = $post['date'];
					$timestamp = strtotime( $date );
			?>
				<article class="eba-archive-item">
					<div class="eba-archive-row">
						<div class="eba-date-block">
							<span class="eba-date-day"><?php echo esc_html( date( 'j', $timestamp ) ); ?></span>
							<span class="eba-date-month"><?php echo esc_html( date( 'M', $timestamp ) ); ?></span>
						</div>
						<div class="eba-archive-body">
							<h3 class="eba-archive-title"><a href="<?php echo esc_url( eba_url( $slug, 'post' ) ); ?>"><?php echo esc_html( $post['title'] ); ?></a></h3>
							<div class="eba-archive-meta">
								<em><?php echo esc_html( eba_relative_date( $date ) ); ?> ago</em>
								<span class="eba-meta-sep">|</span>
								<span>0 Comments</span>
							</div>
							<?php if ( $image ) : ?>
								<a class="eba-archive-thumb" href="<?php echo esc_url( eba_url( $slug, 'post' ) ); ?>"><img src="<?php echo esc_url( eba_asset( $image ) ); ?>" alt=""></a>
							<?php endif; ?>
							<div class="eba-archive-excerpt"><?php echo esc_html( $full_content ); ?></div>
						</div>
					</div>
				</article>
			<?php 
				endforeach; 
			else : 
			?>
				<p>No news posts found.</p>
			<?php endif; ?>
		</div>
		<?php get_template_part( 'template-parts/sidebar' ); ?>
	</div>
</main>
<?php get_footer(); ?>
