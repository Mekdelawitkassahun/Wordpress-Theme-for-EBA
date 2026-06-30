<?php
/**
 * Primary header navigation — rendered from eba_header_nav().
 */
foreach ( eba_header_nav() as $item ) :
	$has_children = ! empty( $item['children'] );
	$li_class       = $has_children ? 'has-sub' : '';
	if ( 'HOME' === $item['label'] && is_front_page() ) {
		$li_class .= ( $li_class ? ' ' : '' ) . 'active';
	}
	?>
<li class="<?php echo esc_attr( trim( $li_class ) ); ?>">
	<a href="<?php echo esc_url( $item['url'] ); ?>">
		<?php echo esc_html( $item['label'] ); ?>
		<?php if ( $has_children ) : ?>
			<span class="nav-arrow">▼</span>
		<?php endif; ?>
	</a>
	<?php if ( $has_children ) : ?>
	<ul class="eba-sub<?php echo ! empty( $item['sub_class'] ) ? ' ' . esc_attr( $item['sub_class'] ) : ''; ?>"
		<?php echo ! empty( $item['sub_style'] ) ? ' style="' . esc_attr( $item['sub_style'] ) . '"' : ''; ?>>
		<?php foreach ( $item['children'] as $child ) : ?>
			<?php if ( ! empty( $child['divider'] ) ) : ?>
				<li class="eba-divider" style="border-top: 1px solid #444; margin: 4px 0;"></li>
			<?php else : ?>
				<li>
					<a href="<?php echo esc_url( $child['url'] ); ?>"
						<?php if ( ! empty( $child['target'] ) ) : ?>
							target="<?php echo esc_attr( $child['target'] ); ?>"
						<?php endif; ?>
						<?php if ( ! empty( $child['rel'] ) ) : ?>
							rel="<?php echo esc_attr( $child['rel'] ); ?>"
						<?php endif; ?>>
						<?php if ( ! empty( $child['icon'] ) ) : ?>
							<i class="fa <?php echo esc_attr( $child['icon'] ); ?>"></i>
						<?php endif; ?>
						<?php echo esc_html( $child['label'] ); ?>
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</li>
	<?php
endforeach;
