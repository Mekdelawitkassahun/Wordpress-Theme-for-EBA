<?php get_header(); ?>
<main class="eba-main">
	<!-- Hero Section -->
	<section class="eba-hero">
		<div class="eba-slider" data-slider>
			<div class="eba-slides">
				<div class="eba-slide active">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( eba_asset( 'slider1.png' ) ); ?>" alt="We represent the banking sector" width="749" height="340"></a>
				</div>
				<div class="eba-slide">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( eba_asset( 'slider2.png' ) ); ?>" alt="Dispute settlement" width="749" height="340"></a>
				</div>
				<div class="eba-slide">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( eba_asset( 'slider3.png' ) ); ?>" alt="Banking education" width="749" height="340"></a>
				</div>
			</div>
			<div class="eba-slide-controls">
				<button class="eba-slide-prev" type="button" aria-label="Previous"></button>
				<button class="eba-slide-next" type="button" aria-label="Next"></button>
			</div>
			<div class="eba-slide-dots">
				<button type="button" class="eba-slide-dot active" data-slide="0"></button>
				<button type="button" class="eba-slide-dot" data-slide="1"></button>
				<button type="button" class="eba-slide-dot" data-slide="2"></button>
			</div>
		</div>
	</section>

	<div class="eba-wrap">
		<!-- Three Boxes -->
		<section class="eba-three-boxes">
			<div class="eba-banner-item"><div class="eba-banner-wrap"><img src="<?php echo esc_url( eba_asset( 'banner-21.png' ) ); ?>" alt="Investment Banking"><a href="#">Investment Banking</a></div></div>
			<div class="eba-banner-item"><div class="eba-banner-wrap"><img src="<?php echo esc_url( eba_asset( 'banner-15.png' ) ); ?>" alt="Today Market"><a href="#">Today Market</a></div></div>
			<div class="eba-banner-item"><div class="eba-banner-wrap"><img src="<?php echo esc_url( eba_asset( 'banner-32.png' ) ); ?>" alt="Global Economy"><a href="#">Global Economy</a></div></div>
		</section>

		<!-- Main Content with Sidebar -->
		<div class="eba-columns">
			<div class="eba-content">
				<!-- Three News Categories -->
				<div class="eba-cat-grid">
					<?php foreach ( eba_categories() as $cat ) : ?>
						<section class="eba-cat eba-cat-<?php echo esc_attr( $cat['color'] ); ?>">
							<h3><a href="<?php echo esc_url( eba_cat_url( 'financial-sector-in-ethiopia' ) ); ?>"><?php echo esc_html( $cat['name'] ); ?></a></h3>
							<?php foreach ( $cat['posts'] as $i => $post ) : ?>
								<?php if ( $post['featured'] && ! empty( $post['image'] ) ) : ?>
									<a class="eba-cat-featured-img" href="<?php echo esc_url( eba_url( $post['slug'], 'post' ) ); ?>"><img src="<?php echo esc_url( eba_asset( $post['image'] ) ); ?>" alt=""></a>
								<?php endif; ?>
								<?php if ( $post['featured'] ) : ?>
									<h4 class="eba-cat-title"><a href="<?php echo esc_url( eba_url( $post['slug'], 'post' ) ); ?>"><?php echo esc_html( $post['title'] ); ?></a></h4>
								<?php else : ?>
									<div class="eba-cat-link-row"><a href="<?php echo esc_url( eba_url( $post['slug'], 'post' ) ); ?>"><?php echo esc_html( $post['title'] ); ?></a></div>
								<?php endif; ?>
							<?php endforeach; ?>
						</section>
					<?php endforeach; ?>
				</div>
				<!-- Popular News -->
				<section class="eba-popular-block">
					<h3 class="eba-popular-heading">Popular News</h3>
					<div class="eba-popular-layout">
						<?php $f = eba_popular_news()[0]; ?>
						<article class="eba-popular-main">
							<a href="<?php echo esc_url( eba_url( $f['slug'], 'post' ) ); ?>"><img src="<?php echo esc_url( eba_asset( $f['image'] ) ); ?>" alt=""></a>
							<?php eba_post_meta( $f['date'] ); ?>
							<h4><a href="<?php echo esc_url( eba_url( $f['slug'], 'post' ) ); ?>"><?php echo esc_html( $f['title'] ); ?></a></h4>
							<p><?php echo esc_html( $f['excerpt'] ); ?></p>
						</article>
						<div class="eba-popular-side">
							<?php for ( $i = 1; $i < count( eba_popular_news() ); $i++ ): $p = eba_popular_news()[ $i ]; ?>
								<article>
									<a class="eba-pop-thumb" href="<?php echo esc_url( eba_url( $p['slug'], 'post' ) ); ?>"><img src="<?php echo esc_url( eba_asset( $p['image'] ) ); ?>" alt=""></a>
									<div>
										<?php eba_post_meta( $p['date'] ); ?>
										<h5><a href="<?php echo esc_url( eba_url( $p['slug'], 'post' ) ); ?>"><?php echo esc_html( $p['title'] ); ?></a></h5>
										<p><?php echo esc_html( $p['excerpt'] ); ?></p>
									</div>
								</article>
							<?php endfor; ?>
						</div>
					</div>
				</section>
			</div>
			<?php get_template_part( 'template-parts/sidebar', 'home' ); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
