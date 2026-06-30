<?php ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="eba-site">
<header class="eba-header">
	<div class="eba-topbar">
		<div class="eba-topbar-inner">
			<div class="eba-topbar-left">
				<span class="eba-top-date notranslate" id="eba-current-date"><?php echo wp_date( 'F j, Y' ); ?></span>
			</div>
			<div class="eba-topbar-right">
				<div class="eba-top-nav">
					<a href="<?php echo esc_url( eba_url( 'register' ) ); ?>">Register</a>
					<span>|</span>
					<a href="<?php echo esc_url( eba_url( 'contact' ) ); ?>">Contact Us</a>
					<span>|</span>
					<a href="<?php echo esc_url( eba_url( 'user' ) ); ?>">User</a>
				</div>
				<div class="eba-lang-selector notranslate">
					<div class="eba-lang-switcher" id="eba-lang-switcher">
						<button class="eba-lang-btn" id="eba-translate-trigger" type="button" aria-haspopup="true" aria-expanded="false">
							<span class="eba-lang-current notranslate" id="eba-lang-current">EN</span>
							<span class="eba-lang-arrow notranslate">&#9660;</span>
						</button>
						<ul class="eba-lang-dropdown notranslate" id="eba-lang-dropdown" role="menu">
							<li role="menuitem"><button type="button" data-lang="en" data-label="English">English</button></li>
							<li role="menuitem"><button type="button" data-lang="am" data-label="አማርኛ">አማርኛ</button></li>
							<li role="menuitem"><button type="button" data-lang="es" data-label="Español">Español</button></li>
							<li role="menuitem"><button type="button" data-lang="zh-CN" data-label="中文">中文</button></li>
							<li role="menuitem"><button type="button" data-lang="ar" data-label="العربية">العربية</button></li>
							<li role="menuitem"><button type="button" data-lang="de" data-label="Deutsch">Deutsch</button></li>
							<li role="menuitem"><button type="button" data-lang="fr" data-label="Français">Français</button></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="eba-brand">
		<div class="eba-brand-inner">
			<a class="eba-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( eba_asset( 'eba-logo1.png' ) ); ?>" alt="Ethiopian Bankers Association">
			</a>
			<div class="eba-brand-right">
				<form id="eba-header-search" class="eba-header-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label class="screen-reader-text" for="s">Search</label>
					<input type="search" id="s" name="s" placeholder="Search" value="<?php echo esc_attr( get_search_query() ); ?>">
					<button type="submit" aria-label="Search"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></button>
				</form>
			</div>
		</div>
	</div>

	<!-- Google Translate Element -->
	<div id="google_translate_element" style="visibility:hidden; position:absolute; left:-9999px; width:1px; height:1px;"></div>

	<!-- Menu Overlay -->
	<div class="eba-menu-overlay" id="eba-menu-overlay"></div>

	<div class="eba-menu-bar">
		<div class="eba-menu-inner">
			<button class="eba-menu-toggle" type="button" aria-label="Menu"><span></span><span></span><span></span></button>
			<ul class="eba-menu" id="eba-menu">
				<li class="eba-menu-close">
					<button class="eba-menu-close-btn" type="button" aria-label="Close menu">✕</button>
				</li>
				<?php get_template_part( 'template-parts/header-nav' ); ?>
			</ul>
		</div>
	</div>
</header>
