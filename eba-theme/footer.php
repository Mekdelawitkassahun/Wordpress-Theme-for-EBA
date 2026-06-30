	<section class="eba-members" id="eba-members">
		<div class="eba-members-inner">
			<div class="eba-members-title-bar"><h3>EBA Member Banks</h3></div>
			<div class="eba-members-carousel" data-members>
				<div class="eba-members-nav">
					<button class="eba-m-prev" type="button" aria-label="Previous"></button>
					<button class="eba-m-next" type="button" aria-label="Next"></button>
				</div>
				<div class="eba-members-viewport">
					<div class="eba-members-track">
						<?php foreach ( eba_members() as $bank ) : ?>
							<div class="eba-member">
								<div class="eba-member-thumb">
									<a href="<?php echo esc_url( $bank['url'] ); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( eba_asset( 'banks/' . $bank['logo'] ) ); ?>" alt="<?php echo esc_attr( $bank['name'] ); ?>" width="112" height="85"></a>
								</div>
								<h5><a href="<?php echo esc_url( $bank['url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $bank['name'] ); ?></a></h5>
								<?php if ( ! empty( $bank['slogan'] ) ) : ?>
									<div class="eba-member-slogan" style="font-size: 10px; color: var(--eba-muted); margin-top: 4px; font-style: italic; line-height: 1.2; text-transform: none;"><?php echo esc_html( $bank['slogan'] ); ?></div>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="eba-floating">
		<div class="eba-wrap eba-floating-inner">
			<ul class="eba-bottom-menu">
				<li><a href="<?php echo esc_url( eba_url( 'news' ) ); ?>">What’s new</a></li>
				<li><a href="<?php echo esc_url( eba_url( 'about' ) ); ?>">About Us</a></li>
				<li><a href="<?php echo esc_url( eba_url( 'contact' ) ); ?>">Contact Us</a></li>
			</ul>
		</div>
	</div>
	<footer class="eba-footer">
		<div class="eba-wrap eba-footer-grid">
			<div class="eba-footer-col eba-footer-about" id="eba-about-us">
				<h3>About Us</h3>
				<div class="eba-footer-about-img">
					<img src="<?php echo esc_url( eba_asset( 'eba-about.png' ) ); ?>" alt="About Us">
				</div>
				<p>EBA stands with all the capacity to be sole lobbying agent for member banks, the association aspires to evolve into dependable training, networking and sectorial research institute that serves the entire financial sector</p>
			</div>
			<div class="eba-footer-col">
				<h3>Quick Links</h3>
				<ul class="eba-footer-quick-links">
					<?php foreach ( eba_footer_sections() as $link ) : ?>
						<li><a href="<?php echo esc_url( $link['url'] ); ?>"><span class="eba-quick-link-arrow">▶</span> <?php echo esc_html( $link['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="eba-footer-col">
				<h3>Financial Story</h3>
				<?php foreach ( eba_financial_stories() as $story ) : ?>
					<div class="eba-fin-story">
						<a class="eba-fin-thumb" href="<?php echo esc_url( eba_url( $story['slug'], 'post' ) ); ?>"><img src="<?php echo esc_url( eba_asset( $story['image'] ) ); ?>" alt="" width="80" height="60"></a>
						<div class="eba-fin-text">
							<h4><a href="<?php echo esc_url( eba_url( $story['slug'], 'post' ) ); ?>"><?php echo esc_html( $story['title'] ); ?></a></h4>
							<p><?php echo esc_html( $story['excerpt']); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="eba-footer-col">
				<h3>Subscribe</h3>
				<?php eba_render_subscribe(); ?>
				<div style="margin-top: 20px;">
					<h3>Contact Info</h3>
					<p style="font-size: 11px; line-height: 1.4; margin-bottom: 8px;"><i class="fa fa-map-marker" style="color: var(--eba-orange); margin-right: 4px;"></i> Meskel Square, Lion Building 2, 3rd Floor</p>
					<p style="font-size: 11px; margin-bottom: 4px;"><i class="fa fa-phone" style="color: var(--eba-orange); margin-right: 4px;"></i> Tel: +251-115-533-874</p>
					<p style="font-size: 11px; margin-bottom: 8px;"><i class="fa fa-envelope" style="color: var(--eba-orange); margin-right: 4px;"></i> info@ethiopianbankers.com</p>
					<div style="margin-top: 15px;">
						<h4 style="margin: 0 0 6px; font-size: 12px; text-transform: uppercase; color: #aaa; font-weight: 700;">Follow Us</h4>
						<ul class="eba-footer-social">
							<li><a href="https://www.facebook.com/eba.page" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://t.me/ethiopianbankers" target="_blank" rel="noopener" aria-label="Telegram"><i class="fa fa-telegram"></i></a></li>
							<li><a href="http://vn.linkedin.com/in/eba" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="eba-copyright">
			<div class="eba-copy-inner">
				<p>Copyright &copy; 2026 Ethiopian Bankers Association. All Rights Reserved. Designed by <a href="http://agpsystems.com" target="_blank" rel="noopener">agpsystems.com</a></p>
			</div>
		</div>
	</footer>
	<div id="eba-translate" class="eba-translate-panel" hidden>
		<p>Select language:</p>
		<ul><li><a href="#">English</a></li><li><a href="#">Amharic</a></li><li><a href="#">Arabic</a></li></ul>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
