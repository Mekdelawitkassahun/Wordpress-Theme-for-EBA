<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function eba_categories() {
	return array(
		array(
			'name'  => 'Finance',
			'slug'  => 'finance',
			'color' => 'red',
			'posts' => array(
				array( 'slug' => 'nbe-june-monetary-policy', 'title' => 'NBE Unveils June 2026 Monetary Policy to Support Growth', 'date' => 'June 25, 2026', 'image' => 'finance-news.jpg', 'featured' => true ),
				array( 'slug' => 'banking-sector-job-creation-2026', 'title' => 'Ethiopian Banks Create 12,000+ Jobs in First Half 2026', 'date' => 'June 20, 2026', 'image' => 'news-2.jpg', 'featured' => false ),
				array( 'slug' => 'nbe-digital-transaction-growth', 'title' => 'Digital Banking Transactions Surge 45% YoY in Q2 2026', 'date' => 'June 15, 2026', 'image' => 'news-1.jpg', 'featured' => false ),
			),
		),
		array(
			'name'  => 'Global Economy',
			'slug'  => 'global-economy',
			'color' => 'blue',
			'posts' => array(
				array( 'slug' => 'world-bank-ethiopia-resilience-program', 'title' => 'World Bank Approves $500M for Ethiopia Economic Recovery', 'date' => 'June 22, 2026', 'image' => 'global-economy.jpg', 'featured' => true ),
				array( 'slug' => 'ethiopia-export-growth-2026', 'title' => 'Ethiopian Exports Hit $4.2B in First Five Months of 2026', 'date' => 'June 10, 2026', 'image' => 'investment.jpg', 'featured' => false ),
				array( 'slug' => 'african-development-bank-ethiopia-infrastructure', 'title' => 'AfDB Supports Ethiopia Power and Telecom Infrastructure', 'date' => 'June 8, 2026', 'image' => 'finance-news.jpg', 'featured' => false ),
			),
		),
		array(
			'name'  => 'Investment',
			'slug'  => 'investment',
			'color' => 'orange',
			'posts' => array(
				array( 'slug' => 'esx-june-trading-update', 'title' => 'ESX Trading Volume Reaches New Record in June 2026', 'date' => 'June 23, 2026', 'image' => 'investment.jpg', 'featured' => true ),
				array( 'slug' => 'ethiopia-green-investment-summit-2026', 'title' => 'Ethiopia Hosts 3rd Annual Investment Summit', 'date' => 'June 12, 2026', 'image' => 'popular-1.jpg', 'featured' => false ),
				array( 'slug' => 'new-foreign-banks-license-2026', 'title' => 'Two New Foreign Banks Receive NBE Approval', 'date' => 'June 6, 2026', 'image' => 'popular-2.jpg', 'featured' => false ),
			),
		),
	);
}

function eba_popular_news() {
	return array(
		array(
			'slug'    => 'nbe-june-monetary-policy',
			'title'   => 'NBE Unveils June 2026 Monetary Policy',
			'date'    => 'June 25, 2026',
			'image'   => 'popular-main.jpg',
			'excerpt' => 'National Bank of Ethiopia introduces new measures to stabilize exchange rate and boost private sector lending.',
		),
		array(
			'slug'    => 'world-bank-ethiopia-resilience-program',
			'title'   => 'World Bank $500M for Ethiopia Recovery',
			'date'    => 'June 22, 2026',
			'image'   => 'popular-2.jpg',
			'excerpt' => 'Funds target climate resilience, private sector development, and digital transformation.',
		),
		array(
			'slug'    => 'esx-june-trading-update',
			'title'   => 'ESX Trading Volume Record',
			'date'    => 'June 23, 2026',
			'image'   => 'popular-1.jpg',
			'excerpt' => 'Over 1.2 million shares traded in single day, market cap up 18%.',
		),
		array(
			'slug'    => 'banking-sector-job-creation-2026',
			'title'   => 'Banking Sector Jobs Surge',
			'date'    => 'June 20, 2026',
			'image'   => 'popular-3.jpg',
			'excerpt' => '12,300 new positions added, 85% digital-first banks.',
		),
	);
}

function eba_sidebar_popular() {
	$extra = array(
		array(
			'slug'    => 'ethiopia-export-growth-2026',
			'title'   => 'Ethiopian Exports $4.2B',
			'date'    => 'June 10, 2026',
			'image'   => 'news-2.jpg',
			'excerpt' => 'Coffee, flowers, and manufacturing lead export growth in 2026.',
		),
	);
	return array_merge( eba_popular_news(), $extra );
}

function eba_members() {
	return array(
		array(
			'name'    => 'ABAY BANK',
			'logo'    => 'Abay-Bank.png',
			'url'     => 'https://www.abaybanksc.com',
			'address' => 'Addis Ababa, Zequala Complex, Joseph Tito St.',
			'slogan'  => 'The Trustworthy Bank',
		),
		array(
			'name'    => 'ADDIS INTERNATIONAL BANK',
			'logo'    => 'ADDIS-INTERNATIONAL-BANK.png',
			'url'     => 'https://addisbanksc.com/',
			'address' => 'Addis Ababa, Jomo Kenyatta St.',
			'slogan'  => 'Your Partner for Prosperity',
		),
		array(
			'name'    => 'AWASH BANK',
			'logo'    => 'Awash-Bank.png',
			'url'     => 'https://awashbank.com/',
			'address' => 'Addis Ababa, Awash Towers, Ras Abebe Aregay St.',
			'slogan'  => 'Nurturing Like Mother Earth',
		),
		array(
			'name'    => 'AMHARA BANK',
			'logo'    => 'Amhara-Bank.png',
			'url'     => 'https://www.amharabank.com.et/',
			'address' => 'Addis Ababa, Ras Mekonnen Ave.',
			'slogan'  => 'Beyond Financing',
		),
		array(
			'name'    => 'BANK OF ABYSSINIA',
			'logo'    => 'image_2025-05-23_141619134.png',
			'url'     => 'https://www.bankofabyssinia.com/',
			'address' => 'Addis Ababa, Legehar, Ras Abebe Aregay St.',
			'slogan'  => 'Choice for All',
		),
		array(
			'name'    => 'BERHAN BANK',
			'logo'    => 'Birhan-2.png',
			'url'     => 'https://berhanbanksc.com/',
			'address' => 'Addis Ababa, TK Building, Bole Road',
			'slogan'  => 'Light of Prosperity',
		),
		array(
			'name'    => 'BUNA BANK',
			'logo'    => 'bunna-1.png',
			'url'     => 'https://bunnabanksc.com/',
			'address' => 'Addis Ababa, Arat Kilo',
			'slogan'  => 'Bank for the Visionary',
		),
		array(
			'name'    => 'COMMERCIAL BANK OF ETHIOPIA',
			'logo'    => 'cbe-2.png',
			'url'     => 'https://combanketh.et/',
			'address' => 'Addis Ababa, CBE Temple, Churchill Road',
			'slogan'  => 'The Bank you can always rely on',
		),
		array(
			'name'    => 'COOPERATIVE BANK OF OROMIA',
			'logo'    => 'COOPERATIVE-BANK-OF-OROMIA.png',
			'url'     => 'https://coopbankoromia.com.et/',
			'address' => 'Addis Ababa, Fillo Tower, Bole Road',
			'slogan'  => 'Coop Bank for All',
		),
		array(
			'name'    => 'DASHEN BANK',
			'logo'    => 'DASHEN-BANK.png',
			'url'     => 'https://dashenbanksc.com/',
			'address' => 'Addis Ababa, Dashen Bank Tower, Sudan St.',
			'slogan'  => 'Always One Step Ahead',
		),
		array(
			'name'    => 'GLOBAL BANK ETHIOPIA',
			'logo'    => 'GLOBAL-BANK-ETHIOPIA.png',
			'url'     => 'https://www.globalbankethiopia.com/',
			'address' => 'Addis Ababa, Head Office, Yeha City Center',
			'slogan'  => 'Your Trustworthy Partner',
		),
		array(
			'name'    => 'ENAT BANK',
			'logo'    => 'ENAT-BANK.png',
			'url'     => 'https://www.enatbanksc.com/',
			'address' => 'Addis Ababa, Enat Tower, Bambis',
			'slogan'  => 'The Bank for Women',
		),
		array(
			'name'    => 'GEDA BANK',
			'logo'    => 'GEDA-BANK.png',
			'url'     => 'https://gadaabank.com.et/',
			'address' => 'Addis Ababa, Bole, near Friendship City Center',
			'slogan'  => 'Bank for Growth',
		),
		array(
			'name'    => 'GOH BETOCH BANK',
			'logo'    => 'GOH-BETOCH-BANK.png',
			'url'     => 'https://www.gohbetbank.com/',
			'address' => 'Addis Ababa, Abenet',
			'slogan'  => 'Your Gateway to Home Ownership',
		),
		array(
			'name'    => 'LION INTERNATIONAL BANK',
			'logo'    => 'LION-INTERNATIONAL-BANK.png',
			'url'     => 'https://anbesabank.com/',
			'address' => 'Addis Ababa, Lex Plaza Building, Haile Gebreselassie St.',
			'slogan'  => 'The Bank that Roars',
		),
		array(
			'name'    => 'NIB BANK',
			'logo'    => 'NIB-BANK.png',
			'url'     => 'https://www.nibbanksc.com/',
			'address' => 'Addis Ababa, Nib Tower, Dembel City Center',
			'slogan'  => 'Your Partner for Growth',
		),
		array(
			'name'    => 'OROMIA BANK',
			'logo'    => 'Oromia-Bank.png',
			'url'     => 'https://oromiabank.com/',
			'address' => 'Addis Ababa, Bole Road, near Getu Commercial Center',
			'slogan'  => 'Empowering Your Life',
		),
		array(
			'name'    => 'SIINQEE BANK',
			'logo'    => 'SIINQEE-BANK.png',
			'url'     => 'https://siinqeebank.com/',
			'address' => 'Addis Ababa, Joseph Tito St.',
			'slogan'  => 'Empowering Your Life',
		),
		array(
			'name'    => 'SIDAMA BANK',
			'logo'    => 'SIDAMA-BANK.png',
			'url'     => 'https://sidamabanksc.com/',
			'address' => 'Hawassa, Head Office / Addis Ababa Branch',
			'slogan'  => 'Empowering Communities',
		),
		array(
			'name'    => 'TSEDEY BANK',
			'logo'    => 'TSEDEY-BANK.png',
			'url'     => 'https://tsedeybank-sc.com/',
			'address' => 'Addis Ababa, Head Office',
			'slogan'  => 'Growing Together',
		),
		array(
			'name'    => 'TSEHAY BANK',
			'logo'    => 'TSEHAY-BANK.png',
			'url'     => 'https://tsehaybank.com.et/',
			'address' => 'Addis Ababa, Senper Building, Bole',
			'slogan'  => 'Sun of Prosperity',
		),
		array(
			'name'    => 'UNITED BANK',
			'logo'    => 'UNITED-BANK.png',
			'url'     => 'https://www.hibretbank.com.et/',
			'address' => 'Addis Ababa, Hibrut Tower, Ras Abebe Aregay St.',
			'slogan'  => 'United, We Prosper',
		),
		array(
			'name'    => 'WEGAGEN BANK',
			'logo'    => 'WEGAGEN-BANK.png',
			'url'     => 'https://www.wegagen.com/',
			'address' => 'Addis Ababa, Wegagen Tower, Ras Mekonnen Ave.',
			'slogan'  => 'Empowering Your Dreams',
		),
		array(
			'name'    => 'ZEMEN BANK',
			'logo'    => 'zemen.png',
			'url'     => 'https://www.zemenbank.com/',
			'address' => 'Addis Ababa, Zemen Tower, Joseph Tito St.',
			'slogan'  => 'Your Strategic Partner',
		),
		array(
			'name'    => 'ZEMEZEM BANK',
			'logo'    => 'ZEMEZEM-BANK.png',
			'url'     => 'https://zamzambank.com/',
			'address' => 'Addis Ababa, Bole Road',
			'slogan'  => 'Pioneer in Islamic Banking',
		),
		array(
			'name'    => 'AHADU BANK',
			'logo'    => 'ADDIS-INTERNATIONAL-BANK.png', // Placeholder Logo
			'url'     => 'https://ahadubank.com',
			'address' => 'Addis Ababa, Sunshine Building, Bole Road',
			'slogan'  => 'Together We Rise',
		),
		array(
			'name'    => 'HIJRA BANK',
			'logo'    => 'ZEMEZEM-BANK.png', // Placeholder Logo
			'url'     => 'https://hijrabank.com.et',
			'address' => 'Addis Ababa, Olympia, near Dembel City Center',
			'slogan'  => 'Committed to Halal Path',
		),
		array(
			'name'    => 'RAMMIS BANK',
			'logo'    => 'Oromia-Bank.png', // Placeholder Logo
			'url'     => 'https://rammisbanksc.com',
			'address' => 'Addis Ababa, Bole, near Japan Embassy',
			'slogan'  => 'Your Ethical Banking Partner',
		),
	);
}

function eba_all_posts() {
	$posts = array();
	foreach ( eba_sidebar_popular() as $p ) {
		$posts[ $p['slug'] ] = array_merge( $p, array( 'excerpt' => $p['excerpt'] ?? $p['title'] ) );
	}
	foreach ( eba_categories() as $cat ) {
		foreach ( $cat['posts'] as $p ) {
			if ( ! isset( $posts[ $p['slug'] ] ) ) {
				$posts[ $p['slug'] ] = array_merge( $p, array( 'excerpt' => $p['title'] ) );
			}
		}
	}
	return array_values( $posts );
}

function eba_pages() {
	return array(
		'home'              => array( 'title' => 'Home',              'content' => '' ),
		'coming-soon'       => array( 'title' => 'Coming Soon',       'content' => '' ),
		'about'             => array( 'title' => 'About Us',          'content' => '<p>About the Ethiopian Bankers Association.</p>' ),
		'news'              => array( 'title' => 'News',              'content' => '' ),
		'contact'           => array( 'title' => 'Contact Us',        'content' => '<p>Contact the Ethiopian Bankers Association.</p>' ),
		'members-arena'      => array( 'title' => 'Members Arena',      'content' => '' ),
		'resources'         => array( 'title' => 'Resources',         'content' => '' ),
		'useful-links'      => array( 'title' => 'Useful Links',      'content' => '' ),
		'register'          => array( 'title' => 'Register',          'content' => '<p>Register for EBA membership and services.</p>' ),
		'user'              => array( 'title' => 'User',              'content' => '<p>Member user portal.</p>' ),
		'valuation-manual'  => array( 'title' => 'Valuation Manual',  'content' => '' ),
		'training-material' => array( 'title' => 'Training Material', 'content' => '' ),
		'publication'       => array( 'title' => 'Publication',       'content' => '' ),
		'announcements'     => array( 'title' => 'Announcements',     'content' => '' ),
		'gallery'           => array( 'title' => 'Gallery',           'content' => '' ),
	);
}

/**
 * Data structures / placeholders for EBA resources, directives, annual reports, and ESG guidelines.
 */
function eba_placeholder_resources() {
	return array(
		'bylaw' => array(
			array( 'title' => 'EBA Bylaws (Approved version)', 'file_size' => '2.4 MB', 'format' => 'PDF' ),
		),
		'directives' => array(
			array( 'title' => 'NBE Banking Business Proclamation No. 592/2008', 'file_size' => '3.1 MB', 'format' => 'PDF' ),
			array( 'title' => 'NBE Asset Classification and Provisioning Directive', 'file_size' => '1.8 MB', 'format' => 'PDF' ),
			array( 'title' => 'Latest Banking Business Directives (June 2026)', 'file_size' => '4.2 MB', 'format' => 'PDF' ),
		),
		'training' => array(
			array( 'title' => 'Credit Analysis & Risk Management Modules', 'file_size' => '8.5 MB', 'format' => 'ZIP' ),
			array( 'title' => 'International Trade Finance Guide', 'file_size' => '5.2 MB', 'format' => 'PDF' ),
		),
		'publications' => array(
			array( 'title' => 'EBA ESG Guideline 2026', 'file_size' => '3.8 MB', 'format' => 'PDF' ),
			array( 'title' => 'EBA Annual Review 2025', 'file_size' => '6.4 MB', 'format' => 'PDF' ),
			array( 'title' => 'EBA Annual Report 2024/2025', 'file_size' => '7.1 MB', 'format' => 'PDF' ),
			array( 'title' => 'EBA Quarterly Banking Bulletins', 'file_size' => '4.0 MB', 'format' => 'PDF' ),
		),
		'industry_news' => array(
			array( 'title' => 'Ethiopian Financial Sector Reforms and Opportunities', 'date' => 'May 2026' ),
			array( 'title' => 'Digital Payment Landscape Assessment', 'date' => 'April 2026' ),
		),
		'gallery_images' => array(
			array( 'image' => 'slider1.png', 'caption' => 'EBA General Assembly 2025' ),
			array( 'image' => 'slider2.png', 'caption' => 'Signing Ceremony with National Bank of Ethiopia' ),
			array( 'image' => 'slider3.png', 'caption' => 'Member Banks Leadership Training Workshop' ),
			array( 'image' => 'finance-news.jpg', 'caption' => 'EBA Panel Discussion on Monetary Policy' ),
			array( 'image' => 'global-economy.jpg', 'caption' => 'Financial Technology Exhibition' ),
			array( 'image' => 'investment.jpg', 'caption' => 'Annual Bankers Networking Dinner' ),
		)
	);
}

