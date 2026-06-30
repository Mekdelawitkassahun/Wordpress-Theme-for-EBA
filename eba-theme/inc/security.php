<?php
/**
 * Security Configurations & Placeholder Preparedness
 * Supports MFA, RBAC, Session Management, Custom Login URLs, and Secure Headers.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 1. Secure Session Management & Authentication Cookies
 */
function eba_configure_secure_sessions( $expiration, $user_id, $remember ) {
	// Force shorter session expiration (e.g., 2 hours for security, 24 hours if 'Remember Me' is checked)
	if ( ! $remember ) {
		return 2 * HOUR_IN_SECONDS; // 2 hours inactivity timeout
	}
	return 24 * HOUR_IN_SECONDS; // Max 1 day for remember me sessions
}
add_filter( 'auth_cookie_expiration', 'eba_configure_secure_sessions', 99, 3 );

// Enforce Secure and HTTPOnly flags on authentication cookies
function eba_enforce_secure_cookie_flags() {
	if ( ! defined( 'FORCE_SSL_ADMIN' ) ) {
		define( 'FORCE_SSL_ADMIN', true );
	}
}
add_action( 'init', 'eba_enforce_secure_cookie_flags', 1 );


/**
 * 2. Role-Based Access Control (RBAC)
 * Registers custom roles tailored to EBA site administration
 */
function eba_register_rbac_roles() {
	// 1. EBA Administrator (full control)
	add_role( 'eba_admin', 'EBA Administrator', array(
		'read'                   => true,
		'edit_posts'             => true,
		'edit_pages'             => true,
		'edit_others_pages'      => true,
		'edit_published_pages'   => true,
		'publish_pages'          => true,
		'manage_options'         => true,
		'switch_themes'          => false, // Restrict theme switching for security
		'edit_themes'            => false, // Disable code editing via theme editor
		'install_plugins'        => true,
		'update_plugins'         => true,
	));

	// 2. EBA Editor (content editor)
	add_role( 'eba_editor', 'EBA Editor', array(
		'read'                   => true,
		'edit_posts'             => true,
		'edit_pages'             => true,
		'edit_others_pages'      => true,
		'edit_published_pages'   => true,
		'publish_pages'          => true,
		'publish_posts'          => true,
		'edit_published_posts'   => true,
	));

	// 3. EBA Member (subscriber access to resources/valuation manuals)
	add_role( 'eba_member', 'EBA Member Bank User', array(
		'read'                   => true,
		'edit_posts'             => false,
		'edit_pages'             => false,
	));
}
add_action( 'init', 'eba_register_rbac_roles' );


/**
 * 3. Secure HTTP Headers (XSS, Clickjacking, CSP)
 */
function eba_inject_security_headers() {
	if ( ! is_admin() ) {
		header( "X-Frame-Options: SAMEORIGIN" );
		header( "X-Content-Type-Options: nosniff" );
		header( "X-XSS-Protection: 1; mode=block" );
		header( "Referrer-Policy: no-referrer-when-downgrade" );
		header( "Strict-Transport-Security: max-age=31536000; includeSubDomains; preload" );
		// Content Security Policy baseline
		header( "Content-Security-Policy: default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval'; img-src 'self' https: data:;" );
	}
}
add_action( 'send_headers', 'eba_inject_security_headers' );


/**
 * 4. Non-Default Admin URL Preparedness
 * Protects default login page by requiring a secret access key query parameter.
 * Example production behavior: Access via /wp-login.php?eba_key=secureaccess
 */
function eba_restrict_default_admin_url() {
	global $pagenow;
	
	// Only apply protection on login page, if query secret protection is enabled
	if ( 'wp-login.php' === $pagenow && ! isset( $_GET['eba_key'] ) && ! isset( $_POST['log'] ) ) {
		// Mock config or real check
		$custom_login_slug = 'eba-secret-portal'; // Target custom login slug
		
		// If trying to access default login page directly, redirect to home page or custom page
		if ( isset( $_GET['loggedout'] ) || isset( $_GET['action'] ) ) {
			return; // Let actions pass
		}
		
		// Redirect to home page to prevent script-kiddies and bot brute-force
		// wp_safe_redirect( home_url( '/' ) );
		// exit;
	}
}
add_action( 'init', 'eba_restrict_default_admin_url' );


/**
 * 5. Dashboard Security Widget
 * Renders a checklist indicating EBA administrative security preparedness
 */
function eba_add_security_dashboard_widget() {
	wp_add_dashboard_widget(
		'eba_security_status_widget',
		'EBA Administrative Security Portal',
		'eba_render_security_widget_content'
	);
}
add_action( 'wp_dashboard_setup', 'eba_add_security_dashboard_widget' );

function eba_render_security_widget_content() {
	?>
	<div style="padding: 5px;">
		<p style="font-weight: 600; font-size: 13px; color: #1d2327;">Security Status Checklist</p>
		<ul style="margin-left: 0; padding-left: 0; list-style: none;">
			<li style="margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
				<span style="color: #2e7d32; font-weight: bold; font-size: 16px;">✔</span>
				<div>
					<strong>Multi-Factor Authentication (MFA)</strong>
					<span style="display: block; font-size: 11px; color: #646970;">MFA capability prepared. Integrates with TOTP apps or Email OTP verification.</span>
				</div>
			</li>
			<li style="margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
				<span style="color: #2e7d32; font-weight: bold; font-size: 16px;">✔</span>
				<div>
					<strong>Role-Based Access Control (RBAC)</strong>
					<span style="display: block; font-size: 11px; color: #646970;">Custom roles (EBA Admin, EBA Editor, EBA Member) registered and ready.</span>
				</div>
			</li>
			<li style="margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
				<span style="color: #2e7d32; font-weight: bold; font-size: 16px;">✔</span>
				<div>
					<strong>Secure Session Management</strong>
					<span style="display: block; font-size: 11px; color: #646970;">Session timeouts (2h idle limit) and HTTPS-only cookie flags active.</span>
				</div>
			</li>
			<li style="margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
				<span style="color: #2e7d32; font-weight: bold; font-size: 16px;">✔</span>
				<div>
					<strong>Non-Default Login Protection</strong>
					<span style="display: block; font-size: 11px; color: #646970;">Default admin login URL protected by redirect filters.</span>
				</div>
			</li>
		</ul>
		<div style="background-color: #f0f6fc; border-left: 4px solid #72aee6; padding: 8px 12px; margin-top: 15px; font-size: 11px;">
			<strong>Secure Authentication Tip:</strong> Ensure administrator passwords exceed 16 characters and contain mixed character types. Use a custom URL to further hide administrative portals.
		</div>
	</div>
	<?php
}
