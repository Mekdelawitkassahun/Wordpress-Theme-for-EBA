<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'EBA_VERSION', '3.7.1' );
define( 'EBA_DIR', get_template_directory() );
define( 'EBA_URI', get_template_directory_uri() );

function eba_asset( $path ) {
	return EBA_URI . '/assets/images/' . ltrim( $path, '/' );
}

function eba_url( $slug, $type = 'page' ) {
	if ( 'post' === $type ) {
		$p = get_page_by_path( $slug, OBJECT, 'post' );
		if ( $p ) {
			return get_permalink( $p );
		}
		$posts = get_posts(
			array(
				'name'        => $slug,
				'post_type'   => 'post',
				'post_status' => 'publish',
				'numberposts' => 1,
			)
		);
		return ! empty( $posts ) ? get_permalink( $posts[0] ) : home_url( '/' . $slug . '/' );
	}

	if ( 'news' === $slug ) {
		$news_id = (int) get_option( 'page_for_posts' );
		if ( $news_id ) {
			return get_permalink( $news_id );
		}
	}

	$p = get_page_by_path( $slug );
	return $p ? get_permalink( $p ) : home_url( '/' . $slug . '/' );
}

function eba_anchor( $id ) {
	return trailingslashit( home_url( '/' ) ) . '#' . ltrim( $id, '#' );
}

function eba_cat_url( $slug ) {
	$cat = get_category_by_slug( $slug );
	if ( $cat ) {
		return get_category_link( $cat->term_id );
	}
	return home_url( '/category/' . $slug . '/' );
}

function eba_relative_date( $date_string ) {
	$date = strtotime( $date_string );
	$now  = time();
	$diff = $now - $date;
	if ( $diff < 60 ) {
		return '1 minute ago';
	} elseif ( $diff < 3600 ) {
		$minutes = floor( $diff / 60 );
		return $minutes . ' minute' . ( $minutes > 1 ? 's' : '' ) . ' ago';
	} elseif ( $diff < 86400 ) {
		$hours = floor( $diff / 3600 );
		return $hours . ' hour' . ( $hours > 1 ? 's' : '' ) . ' ago';
	} elseif ( $diff < 604800 ) {
		$days = floor( $diff / 86400 );
		return $days . ' day' . ( $days > 1 ? 's' : '' ) . ' ago';
	} elseif ( $diff < 2592000 ) {
		$weeks = floor( $diff / 604800 );
		return $weeks . ' week' . ( $weeks > 1 ? 's' : '' ) . ' ago';
	} else {
		$months = floor( $diff / 2592000 );
		return $months . ' month' . ( $months > 1 ? 's' : '' ) . ' ago';
	}
}

function eba_post_meta( $date = 'March 15, 2025' ) {
	echo '<div class="eba-meta"><span class="eba-meta-date">' . esc_html( eba_relative_date( $date ) ) . '</span><span class="eba-meta-comment">0 Comment</span></div>';
}

function eba_post_images() {
	return array(
		'nbe-june-monetary-policy'                          => 'finance-news.jpg',
		'banking-sector-job-creation-2026'                  => 'news-2.jpg',
		'nbe-digital-transaction-growth'                    => 'news-1.jpg',
		'world-bank-ethiopia-resilience-program'            => 'global-economy.jpg',
		'ethiopia-export-growth-2026'                       => 'investment.jpg',
		'african-development-bank-ethiopia-infrastructure'  => 'finance-news.jpg',
		'esx-june-trading-update'                           => 'investment.jpg',
		'ethiopia-green-investment-summit-2026'             => 'popular-1.jpg',
		'new-foreign-banks-license-2026'                    => 'popular-2.jpg',
	);
}

function eba_post_image( $slug ) {
	$map = eba_post_images();
	return $map[ $slug ] ?? '';
}

function eba_post_full_content( $slug ) {
	$contents = array(
		'nbe-june-monetary-policy' =>
			'Addis Ababa, June 25, 2026 — The National Bank of Ethiopia unveiled its June 2026 monetary policy framework, introducing new measures designed to stabilize the exchange rate and boost private sector lending. The policy represents a continuation of the central bank\'s efforts to balance inflation control with economic growth support. Key measures include adjustments to the policy rate, reserve requirements, and foreign exchange allocation mechanisms. The NBE emphasized the importance of maintaining price stability while ensuring adequate credit flow to productive sectors of the economy. The central bank also announced new initiatives to support export-oriented businesses and import-substituting industries, recognizing their critical role in reducing the trade deficit and strengthening the external position. Source: NBE Press Release, June 2026',

		'banking-sector-job-creation-2026' =>
			'Addis Ababa, June 20, 2026 — Ethiopia\'s banking sector created over 12,000 new jobs in the first half of 2026, demonstrating the industry\'s significant contribution to employment generation. The job creation was driven by branch expansion, digital banking initiatives, and the entry of new players in the liberalized market. According to industry data, 85% of the new positions were in digital-first banks and technology-focused roles, reflecting the sector\'s ongoing digital transformation. The remaining positions were in traditional banking operations, customer service, and support functions. The Ethiopian Bankers Association highlighted that the sector now employs over 100,000 people directly, with indirect employment through related services adding significantly to the total impact on the labor market. Source: EBA Employment Report, June 2026',

		'nbe-digital-transaction-growth' =>
			'Addis Ababa, June 15, 2026 — Digital banking transactions in Ethiopia surged 45% year-over-year in the second quarter of 2026, reaching unprecedented volumes as consumers and businesses increasingly adopt digital financial services. The growth was driven by mobile banking, online payments, and digital wallet adoption. The National Bank of Ethiopia reported that the value of digital transactions exceeded 500 billion birr in Q2 2026, with mobile money accounting for the largest share. The growth reflects successful financial inclusion initiatives and improved digital infrastructure across the banking sector. Major banks including CBE, Dashen, and Awash have invested heavily in their digital platforms, offering user-friendly mobile apps and agent networks that have made digital financial services accessible to previously underserved populations. Source: NBE Digital Payments Report, June 2026',

		'world-bank-ethiopia-resilience-program' =>
			'Addis Ababa, June 22, 2026 — The World Bank approved a $500 million financing package for Ethiopia\'s economic recovery program, focusing on climate resilience, private sector development, and digital transformation. The funding represents continued international support for Ethiopia\'s reform agenda and economic stabilization efforts. The program includes $200 million for climate resilience projects, $150 million for private sector development, and $150 million for digital transformation initiatives. The financing aims to support Ethiopia\'s recovery from recent economic challenges and build resilience against future shocks. World Bank officials praised Ethiopia\'s commitment to economic reforms and highlighted the importance of continued international support during the transition period. The program is expected to create jobs, improve public services, and strengthen economic governance. Source: World Bank Press Release, June 2026',

		'ethiopia-export-growth-2026' =>
			'Addis Ababa, June 10, 2026 — Ethiopian exports reached $4.2 billion in the first five months of 2026, representing a 15% increase compared to the same period in 2025. Coffee, flowers, and manufacturing products led the export growth, demonstrating diversification beyond traditional agricultural commodities. Coffee exports remained the largest contributor, earning $1.8 billion, followed by cut flowers at $800 million. Manufacturing exports, including textiles and leather products, showed strong growth, reaching $900 million. The Ministry of Trade attributed the growth to improved market access, quality improvements, and targeted export promotion strategies. The government has been working to reduce logistical bottlenecks and improve the competitiveness of Ethiopian products in international markets. Source: Ministry of Trade Export Report, June 2026',

		'african-development-bank-ethiopia-infrastructure' =>
			'Addis Ababa, June 8, 2026 — The African Development Bank (AfDB) announced significant support for Ethiopia\'s power and telecommunications infrastructure development. The financing package includes $300 million for energy projects and $200 million for telecommunications upgrades. The energy projects focus on renewable energy development and grid expansion, aiming to increase electricity access and support industrial development. The telecommunications investments will improve connectivity, particularly in rural areas, supporting digital inclusion and economic growth. AfDB officials emphasized the importance of infrastructure development for Ethiopia\'s economic transformation and regional integration. The projects are expected to create thousands of jobs and improve the business environment. Source: AfDB Press Release, June 2026',

		'esx-june-trading-update' =>
			'Addis Ababa, June 23, 2026 — The Ethiopian Securities Exchange (ESX) achieved a new trading volume record in June 2026, with over 1.2 million shares traded in a single day. The market capitalization has grown 18% since the beginning of the year, reflecting strong investor interest in Ethiopian equities. Banking stocks continue to dominate trading activity, with Dashen Bank, Awash Bank, and CBE shares accounting for the majority of volume. The exchange has also seen increased participation from retail investors, indicating growing public awareness and acceptance of capital market investments. The ESX plans to introduce new products including bond trading and exchange-traded funds in the coming months, further expanding investment options for market participants. Source: ESX Market Report, June 2026',

		'ethiopia-green-investment-summit-2026' =>
			'Addis Ababa, June 12, 2026 — Ethiopia hosted its 3rd Annual Green Investment Summit, attracting international investors and development partners interested in the country\'s renewable energy and sustainable development opportunities. The summit focused on solar, wind, and hydroelectric projects, as well as sustainable agriculture initiatives. Over 500 participants from 30 countries attended the event, including representatives from major international financial institutions, renewable energy companies, and development agencies. The summit resulted in signed agreements worth over $2 billion in planned investments. Prime Minister Abiy Ahmed highlighted Ethiopia\'s commitment to green development and the country\'s vast potential for renewable energy generation. The government has set ambitious targets for renewable energy capacity and climate-resilient infrastructure development. Source: Ministry of Planning Press Release, June 2026',

		'new-foreign-banks-license-2026' =>
			'Addis Ababa, June 6, 2026 — The National Bank of Ethiopia granted preliminary approval to two new foreign banks seeking to operate in the country. The approvals mark continued progress in the implementation of Ethiopia\'s banking sector liberalization program. While the names of the approved banks have not been publicly disclosed, sources indicate that one is from the Middle East and the other from Asia. Both banks have been operating representative offices in Ethiopia for several years and have demonstrated strong commitment to the market. The NBE expects to issue full operating licenses within 90 days, subject to final due diligence and compliance with capital requirements. The banks are expected to begin operations in the third quarter of 2026. Source: NBE Licensing Announcement, June 2026',
	);
	return $contents[ $slug ] ?? '';
}

function eba_render_subscribe() {
	$sc = get_option( 'eba_cf7_subscribe', '' );
	if ( $sc && shortcode_exists( 'contact-form-7' ) ) {
		echo do_shortcode( $sc ); // phpcs:ignore
		return;
	}
	$status = isset( $_GET['sub'] ) ? sanitize_text_field( wp_unslash( $_GET['sub'] ) ) : '';
	if ( 'ok' === $status ) {
		echo '<p class="eba-notice ok">Thank you for subscribing!</p>';
	}
	?>
	<form class="eba-subscribe-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="eba_subscribe">
		<?php wp_nonce_field( 'eba_subscribe', 'eba_subscribe_nonce' ); ?>
		<input type="email" name="email" placeholder="Your email address" required>
		<button type="submit">Subscribe</button>
	</form>
	<?php
}

function eba_category_defs() {
	return array(
		'popular-news'                 => 'Popular News',
		'blog'                         => 'Blog',
		'financial-sector-in-ethiopia' => 'Financial Sector in Ethiopia',
	);
}

function eba_post_category_map() {
	return array(
		'nbe-june-monetary-policy'                         => array( 'popular-news', 'blog', 'financial-sector-in-ethiopia' ),
		'banking-sector-job-creation-2026'                 => array( 'popular-news', 'blog' ),
		'nbe-digital-transaction-growth'                   => array( 'popular-news', 'blog' ),
		'world-bank-ethiopia-resilience-program'           => array( 'popular-news', 'blog' ),
		'ethiopia-export-growth-2026'                      => array( 'blog', 'financial-sector-in-ethiopia' ),
		'african-development-bank-ethiopia-infrastructure' => array( 'blog' ),
		'esx-june-trading-update'                          => array( 'popular-news', 'blog', 'financial-sector-in-ethiopia' ),
		'ethiopia-green-investment-summit-2026'            => array( 'blog' ),
		'new-foreign-banks-license-2026'                   => array( 'blog', 'financial-sector-in-ethiopia' ),
	);
}

/**
 * Primary header navigation — single source for header menu and footer Quick Links.
 */
function eba_header_nav() {
	$members_links = array();
	foreach ( eba_members() as $bank ) {
		$members_links[] = array(
			'label'  => $bank['name'],
			'url'    => $bank['url'],
			'target' => '_blank',
			'rel'    => 'noopener noreferrer',
		);
	}

	return array(
		array(
			'label'    => 'HOME',
			'url'      => home_url( '/' ),
			'children' => array(),
		),
		array(
			'label'    => 'ABOUT US',
			'url'      => eba_url( 'about' ),
			'children' => array(
				array( 'label' => 'About EBA', 'url' => eba_url( 'about' ) . '#about-eba' ),
				array( 'label' => 'Board of Directors', 'url' => eba_url( 'about' ) . '#board' ),
				array( 'label' => 'Objectives', 'url' => eba_url( 'about' ) . '#objectives' ),
				array( 'label' => 'Mission', 'url' => eba_url( 'about' ) . '#mission' ),
				array( 'label' => 'Vision', 'url' => eba_url( 'about' ) . '#vision' ),
			),
		),
		array(
			'label'    => 'NEWS & EVENTS',
			'url'      => eba_url( 'news' ),
			'children' => array(
				array( 'label' => 'News', 'url' => eba_url( 'news' ) ),
				array( 'label' => 'Announcements', 'url' => eba_url( 'announcements' ) ),
				array( 'label' => 'Gallery', 'url' => eba_url( 'gallery' ) ),
			),
		),
		array(
			'label'    => 'MEMBERS ARENA',
			'url'      => eba_url( 'coming-soon' ),
			'children' => array(
				array( 'label' => 'Members Arena', 'url' => eba_url( 'coming-soon' ) ),
				array( 'label' => 'Valuation Manual', 'url' => eba_url( 'coming-soon' ) ),
			),
		),
		array(
			'label'    => 'RESOURCES',
			'url'      => eba_url( 'coming-soon' ),
			'children' => array(
				array( 'label' => 'EBA Bylaw', 'url' => eba_url( 'coming-soon' ) ),
				array(
					'label'  => 'Banking Business Directives',
					'url'    => 'http://www.nbe.gov.et/directives/bankingbusiness.html',
					'target' => '_blank',
					'rel'    => 'noopener',
				),
				array( 'label' => 'Training Materials', 'url' => eba_url( 'coming-soon' ) ),
				array( 'label' => 'Publications', 'url' => eba_url( 'coming-soon' ) ),
				array( 'label' => 'Valuation Manual', 'url' => eba_url( 'coming-soon' ) ),
			),
			'sub_class' => 'eba-wide-submenu',
		),
		array(
			'label'    => 'CONTACT US',
			'url'      => eba_url( 'contact' ),
			'children' => array(),
		),
		array(
			'label'    => 'USEFUL LINKS',
			'url'      => eba_url( 'useful-links' ),
			'children' => array_merge(
				array(
					array(
						'label'  => 'National Bank of Ethiopia',
						'url'    => 'http://www.nbe.gov.et',
						'target' => '_blank',
						'rel'    => 'noopener',
					),
					array( 'divider' => true ),
				),
				$members_links
			),
			'sub_class' => 'eba-scrollable-submenu',
			'sub_style' => 'max-height: 400px; overflow-y: auto;',
		),
		array(
			'label'    => 'SOCIAL MEDIA',
			'url'      => '#',
			'children' => array(
				array(
					'label'  => 'Telegram',
					'url'    => 'https://t.me/ethiopianbankers',
					'target' => '_blank',
					'rel'    => 'noopener',
					'icon'   => 'fa-telegram',
				),
				array(
					'label'  => 'Facebook',
					'url'    => 'https://www.facebook.com/eba.page',
					'target' => '_blank',
					'rel'    => 'noopener',
					'icon'   => 'fa-facebook',
				),
				array(
					'label'  => 'LinkedIn',
					'url'    => 'http://vn.linkedin.com/in/eba',
					'target' => '_blank',
					'rel'    => 'noopener',
					'icon'   => 'fa-linkedin',
				),
			),
		),
	);
}

function eba_footer_sections() {
	$links = array();
	foreach ( eba_header_nav() as $item ) {
		if ( 'SOCIAL MEDIA' === strtoupper( $item['label'] ) ) {
			continue;
		}
		$links[] = array(
			'label' => $item['label'],
			'url'   => $item['url'],
		);
	}
	return $links;
}

function eba_financial_stories() {
	return array(
		array(
			'slug'    => 'nbe-june-monetary-policy',
			'title'   => 'NBE Unveils June 2026 Monetary Policy',
			'image'   => 'popular-main.jpg',
			'excerpt' => 'National Bank introduces new measures to stabilize exchange rate and boost private sector lending.',
		),
		array(
			'slug'    => 'world-bank-ethiopia-resilience-program',
			'title'   => 'World Bank Approves $500M for Ethiopia Recovery',
			'image'   => 'global-economy.jpg',
			'excerpt' => 'Funds target climate resilience, private sector development, and digital transformation.',
		),
		array(
			'slug'    => 'esx-june-trading-update',
			'title'   => 'ESX Trading Volume Reaches New Record',
			'image'   => 'investment.jpg',
			'excerpt' => 'Over 1.2 million shares traded in single day, market cap up 18%.',
		),
	);
}

function eba_category_default_post() {
	return array(
		'popular-news'                 => 'nbe-june-monetary-policy',
		'blog'                         => 'banking-sector-job-creation-2026',
		'financial-sector-in-ethiopia' => 'world-bank-ethiopia-resilience-program',
	);
}
