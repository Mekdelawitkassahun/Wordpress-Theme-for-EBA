<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/data.php';
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/security.php';

function eba_setup_theme() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array( 'primary' => 'Primary Menu' ) );
}
add_action( 'after_setup_theme', 'eba_setup_theme' );

// Remove default admin bar html margin bump styling
add_action( 'init', function() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
} );

function eba_modify_query( $query ) {
	if ( $query->is_main_query() && ( is_home() || is_category() || is_archive() ) && ! is_admin() ) {
		$query->set( 'posts_per_page', -1 );
	}
}
add_action( 'pre_get_posts', 'eba_modify_query' );

function eba_enqueue() {
  wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0' );
  wp_enqueue_style( 'eba-main', EBA_URI . '/assets/css/main.css', array( 'font-awesome' ), EBA_VERSION );
  wp_enqueue_script( 'eba-main', EBA_URI . '/assets/js/main.js', array(), EBA_VERSION, true );
  // Google Translate widget — handles persistent translation across all pages automatically
  wp_enqueue_script( 'google-translate-api', '//translate.google.com/translate_a/element.js?cb=ebaGTInit', array( 'eba-main' ), null, true );
}
add_action('wp_enqueue_scripts', 'eba_enqueue');

// Google Translate Functions - All in footer
function eba_favicon() {
	echo '<link rel="icon" href="' . esc_url( eba_asset( 'favicon.ico' ) ) . '">';
}
add_action( 'wp_head', 'eba_favicon', 1 );

function eba_meta_description() {
	$desc = get_bloginfo( 'description' );
	if ( is_front_page() ) {
		$desc = 'EBA promotes and serves the interests of member banks through training, advocacy, research and networking in Ethiopia.';
	} elseif ( is_singular() ) {
		$desc = wp_strip_all_tags( get_the_excerpt() );
	}
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">';
	}
}
add_action( 'wp_head', 'eba_meta_description', 2 );

function eba_document_title( $title ) {
	return is_front_page() ? 'EBA - Ethiopian Bankers Association' : $title;
}
add_filter( 'pre_get_document_title', 'eba_document_title' );

function eba_subscribe_handler() {
	if ( ! isset( $_POST['eba_subscribe_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['eba_subscribe_nonce'] ) ), 'eba_subscribe' ) ) {
		wp_die( 'Security check failed.' );
	}
	$email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	if ( is_email( $email ) ) {
		wp_mail( get_option( 'admin_email' ), 'EBA Subscribe', 'New subscriber: ' . $email, array( 'Reply-To: ' . $email ) );
	}
	wp_safe_redirect( add_query_arg( 'sub', 'ok', wp_get_referer() ?: home_url( '/' ) ) );
	exit;
}
add_action( 'admin_post_eba_subscribe', 'eba_subscribe_handler' );
add_action( 'admin_post_nopriv_eba_subscribe', 'eba_subscribe_handler' );

function eba_contact_handler() {
	if ( ! isset( $_POST['eba_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['eba_contact_nonce'] ) ), 'eba_contact' ) ) {
		wp_die( 'Security check failed.' );
	}
	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );
	if ( is_email( $email ) && $message ) {
		wp_mail( get_option( 'admin_email' ), 'EBA Contact from ' . $name, $message, array( 'Reply-To: ' . $email ) );
	}
	wp_safe_redirect( add_query_arg( 'sent', '1', eba_url( 'contact' ) ) );
	exit;
}
add_action( 'admin_post_eba_contact', 'eba_contact_handler' );
add_action( 'admin_post_nopriv_eba_contact', 'eba_contact_handler' );
