<?php
/**
 * Contact page — custom form (CF7 bypassed)
 */
get_header();
$sent = isset( $_GET['sent'] );
?>
<main class="eba-main eba-inner">
	<div class="eba-wrap eba-columns">
		<div class="eba-content">
			<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
			<h1 class="eba-page-title">Contact Us</h1>
			<div class="eba-contact-layout">
				<div class="eba-contact-map">
					<iframe
						title="EBA Office Location"
						src="https://maps.google.com/maps?q=Meskel+Square+Addis+Ababa+Ethiopia&output=embed"
						width="100%"
						height="320"
						style="border:0;"
						allowfullscreen=""
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<div class="eba-contact-form-col">
					<?php if ( $sent ) : ?><p class="eba-notice ok">Message sent successfully.</p><?php endif; ?>
					<form class="eba-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
						<input type="hidden" name="action" value="eba_contact">
						<?php wp_nonce_field( 'eba_contact', 'eba_contact_nonce' ); ?>
						<div class="eba-form-group">
							<label for="eba-contact-name">Your Name *</label>
							<input type="text" id="eba-contact-name" name="name" placeholder="Your full name" required>
						</div>
						<div class="eba-form-group">
							<label for="eba-contact-email">Your Email *</label>
							<input type="email" id="eba-contact-email" name="email" placeholder="your@email.com" required>
						</div>
						<div class="eba-form-group">
							<label for="eba-contact-message">Your Message *</label>
							<textarea id="eba-contact-message" name="message" rows="5" placeholder="How can we help you?" required></textarea>
						</div>
						<div class="eba-form-group">
							<button type="submit">Send Message</button>
						</div>
					</form>
				</div>
			</div>
			<div class="eba-contact-addresses">
				<div class="eba-contact-block">
					<h4>MAIN OFFICE</h4>
					<p>Meakel Square, Lion Building 2, 3rd Floor</p>
					<p><strong>EMAIL</strong><br>ethbankers@yahoo.com<br>info@ethiopianbankers.com</p>
				</div>
				<div class="eba-contact-block">
					<h4>PHONE &amp; FAX</h4>
					<p><strong>PHONE</strong> +251-115-533-874</p>
					<p><strong>FAX</strong> +251-115-580-148</p>
					<p><strong>P.O.Box</strong> 23850/1000</p>
				</div>
			</div>
		</div>
		<?php get_template_part( 'template-parts/sidebar' ); ?>
	</div>
</main>
<?php get_footer(); ?>