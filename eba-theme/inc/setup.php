<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function eba_get_post_id_by_slug( $slug ) {
	$p = get_page_by_path( $slug, OBJECT, 'post' );
	if ( $p ) {
		return $p->ID;
	}
	$posts = get_posts(
		array(
			'name'        => $slug,
			'post_type'   => 'post',
			'post_status' => 'publish',
			'numberposts' => 1,
		)
	);
	return ! empty( $posts ) ? $posts[0]->ID : 0;
}

function eba_install() {
	if ( get_option( 'eba_version' ) === EBA_VERSION ) {
		return;
	}

	foreach ( eba_pages() as $slug => $data ) {
		$existing = get_page_by_path( $slug );
		if ( ! $existing ) {
			wp_insert_post(
				array(
					'post_title'   => $data['title'],
					'post_name'    => $slug,
					'post_status'  => 'publish',
					'post_type'    => 'page',
					'post_content' => $data['content'],
				)
			);
		} else {
			wp_update_post(
				array(
					'ID'           => $existing->ID,
					'post_content' => $data['content'],
				)
			);
		}
	}

	$cat_ids = array();
	foreach ( eba_category_defs() as $slug => $name ) {
		$term = get_category_by_slug( $slug );
		if ( ! $term ) {
			$result = wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
			if ( ! is_wp_error( $result ) ) {
				$cat_ids[ $slug ] = (int) $result['term_id'];
			}
		} else {
			$cat_ids[ $slug ] = (int) $term->term_id;
		}
	}

	$seen = array();
	foreach ( eba_all_posts() as $post ) {
		if ( isset( $seen[ $post['slug'] ] ) ) {
			continue;
		}
		$seen[ $post['slug'] ] = true;

		$content = eba_post_full_content( $post['slug'] );
		if ( ! $content ) {
			$content = $post['excerpt'] ?? $post['title'];
		}

		$existing = get_page_by_path( $post['slug'], OBJECT, 'post' );
		$parts  = explode( ' ', $post['date'] );
		$months = array(
			'January' => '01', 'February' => '02', 'March' => '03', 'April' => '04',
			'May' => '05', 'June' => '06', 'July' => '07', 'August' => '08',
			'September' => '09', 'October' => '10', 'November' => '11', 'December' => '12',
		);
		$month = $months[ $parts[0] ] ?? '10';
		$day   = rtrim( $parts[1], ',' );
		$year  = $parts[2] ?? '2014';
		$post_date = sprintf( '%s-%s-%02d 10:00:00', $year, $month, (int) $day );
		if ( ! $existing ) {
			$post_id = wp_insert_post(
				array(
					'post_title'   => $post['title'],
					'post_name'    => $post['slug'],
					'post_status'  => 'publish',
					'post_type'    => 'post',
					'post_content' => '<p>' . esc_html( $content ) . '</p>',
					'post_excerpt' => $content,
					'post_date'    => $post_date,
				)
			);
		} else {
			$post_id = $existing->ID;
			wp_update_post(
				array(
					'ID'           => $post_id,
					'post_content' => '<p>' . esc_html( $content ) . '</p>',
					'post_excerpt' => $content,
					'post_date'    => $post_date,
					'post_date_gmt' => get_gmt_from_date( $post_date ),
				)
			);
		}

		if ( ! empty( $post_id ) && ! is_wp_error( $post_id ) ) {
			$map   = eba_post_category_map();
			$slugs = $map[ $post['slug'] ] ?? array( 'blog' );
			$terms = array();
			foreach ( $slugs as $cslug ) {
				if ( isset( $cat_ids[ $cslug ] ) ) {
					$terms[] = $cat_ids[ $cslug ];
				}
			}
			if ( $terms ) {
				wp_set_post_categories( $post_id, $terms );
			}
			$img = eba_post_image( $post['slug'] );
			if ( $img ) {
				update_post_meta( $post_id, '_eba_image', $img );
			}
		}
	}

	// Ensure every footer category has at least one post.
	foreach ( eba_category_default_post() as $cslug => $pslug ) {
		if ( empty( $cat_ids[ $cslug ] ) ) {
			continue;
		}
		$post_id = eba_get_post_id_by_slug( $pslug );
		if ( ! $post_id ) {
			continue;
		}
		$current = wp_get_post_categories( $post_id );
		if ( ! in_array( $cat_ids[ $cslug ], $current, true ) ) {
			$current[] = $cat_ids[ $cslug ];
			wp_set_post_categories( $post_id, $current );
		}
	}

	update_option( 'permalink_structure', '/%postname%/' );
	flush_rewrite_rules();

	$home = get_page_by_path( 'home' );
	if ( $home ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home->ID );
	}
	$news = get_page_by_path( 'news' );
	if ( $news ) {
		update_option( 'page_for_posts', $news->ID );
	}

	update_option( 'blogname', 'Ethiopian Bankers Association' );
	update_option( 'blogdescription', 'Ethiopian Bankers Association' );
	update_option( 'date_format', 'F j, Y' );

	if ( post_type_exists( 'wpcf7_contact_form' ) && ! get_option( 'eba_cf7_subscribe' ) ) {
		$id = wp_insert_post( array( 'post_title' => 'Subscribe', 'post_type' => 'wpcf7_contact_form', 'post_status' => 'publish' ) );
		if ( $id ) {
			update_post_meta( $id, '_form', "[email* your-email placeholder \"Your email address\"]\n[submit \"Subscribe\"]" );
			update_post_meta( $id, '_mail', array(
				'subject'   => 'EBA Subscribe',
				'sender'    => '[your-email]',
				'body'      => 'Subscribe: [your-email]',
				'recipient' => get_option( 'admin_email' ),
			) );
			update_option( 'eba_cf7_subscribe', '[contact-form-7 id="' . $id . '" title="Subscribe"]' );
		}
	}

	if ( post_type_exists( 'wpcf7_contact_form' ) && ! get_option( 'eba_cf7_contact' ) ) {
		$cid = wp_insert_post( array( 'post_title' => 'Contact', 'post_type' => 'wpcf7_contact_form', 'post_status' => 'publish' ) );
		if ( $cid ) {
			update_post_meta( $cid, '_form', "<div class=\"eba-form-group\">
<label for=\"your-name\">Name *</label>
[text* your-name id:your-name placeholder \"Your full name\"]
</div>
<div class=\"eba-form-group\">
<label for=\"your-email\">Email *</label>
[email* your-email id:your-email placeholder \"your@email.com\"]
</div>
<div class=\"eba-form-group\">
<label for=\"your-message\">Message *</label>
[textarea* your-message id:your-message placeholder \"How can we help you?\" rows:5]
</div>
<div class=\"eba-form-group\">
[submit \"Send Message\"]
</div>" );
			update_post_meta( $cid, '_mail', array(
				'subject'   => 'EBA Contact',
				'sender'    => '[your-email]',
				'body'      => "From: [your-name] <[your-email]>\n\n[your-message]",
				'recipient' => get_option( 'admin_email' ),
			) );
			update_option( 'eba_cf7_contact', '[contact-form-7 id="' . $cid . '" title="Contact"]' );
		}
	}

	update_option( 'eba_version', EBA_VERSION );
}
add_action( 'after_switch_theme', 'eba_install' );

function eba_register_polylang_languages() {
	if ( ! function_exists( 'pll_languages_list' ) ) {
		return;
	}

	$desired_languages = array(
		array(
			'code' => 'en',
			'name' => 'English',
			'locale' => 'en_US',
			'text_dir' => 0,
		),
		array(
			'code' => 'es',
			'name' => 'Español',
			'locale' => 'es_ES',
			'text_dir' => 0,
		),
		array(
			'code' => 'zh-CN',
			'name' => '中文',
			'locale' => 'zh_CN',
			'text_dir' => 0,
		),
		array(
			'code' => 'ar',
			'name' => 'العربية',
			'locale' => 'ar',
			'text_dir' => 1,
		),
		array(
			'code' => 'de',
			'name' => 'Deutsch',
			'locale' => 'de_DE',
			'text_dir' => 0,
		),
		array(
			'code' => 'fr',
			'name' => 'Français',
			'locale' => 'fr_FR',
			'text_dir' => 0,
		),
	);

	$current_languages = pll_languages_list( array( 'fields' => 'slug' ) );
	if ( ! is_array( $current_languages ) ) {
		$current_languages = array();
	}

	$model = PLL()->model;
	if ( ! $model ) {
		return;
	}

	foreach ( $desired_languages as $lang ) {
		if ( ! in_array( $lang['code'], $current_languages, true ) ) {
			$model->add_language( $lang );
		}
	}
}
add_action( 'init', 'eba_register_polylang_languages', 20 );

function eba_check_version() {
	if ( get_option( 'eba_version' ) !== EBA_VERSION ) {
		eba_install();
	}
}
add_action( 'init', 'eba_check_version', 5 );
