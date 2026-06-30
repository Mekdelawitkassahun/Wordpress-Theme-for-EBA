<?php
/**
 * Breadcrumbs for inner pages.
 */
if ( is_front_page() ) {
	return;
}
?>
<div class="eba-breadcrumbs">
	<ul>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="eba-bc-sep">&rsaquo;</span></li>
		<li class="active"><span><?php echo esc_html( get_the_title() ); ?></span></li>
	</ul>
</div>
