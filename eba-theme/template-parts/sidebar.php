<?php
$videos = array(
	array( 'id' => 'P-Z1FScVkmI', 'title' => 'Shadow Bank' ),
	array( 'id' => 'euhkIesmW7E', 'title' => 'Video 2' ),
	array( 'id' => 'O_ards5jBfc', 'title' => 'Video 3' ),
);
?>
<aside class="eba-sidebar">
	<div class="eba-widget">
		<h3>EBA upcoming events</h3>
		<div class="eba-widget-body">
			<p>Editorial Board Meeting Every Thursday [3:00PM - EBA Meeting room]</p>
		</div>
	</div>
	<div class="eba-widget eba-widget-video">
		<h3>Top Videos</h3>
		<div class="eba-widget-body">
			<div class="eba-video-slider" data-video-slider>
				<div class="eba-video-viewport">
					<div class="eba-video-track">
						<?php foreach ( $videos as $i => $v ) : ?>
							<div class="eba-video-slide<?php echo 0 === $i ? ' active' : ''; ?>">
								<div class="eba-video-wrap">
									<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $v['id'] ); ?>" title="<?php echo esc_attr( $v['title'] ); ?>" allowfullscreen loading="lazy"></iframe>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<button class="eba-v-prev" type="button" aria-label="Previous video">&lsaquo;</button>
				<button class="eba-v-next" type="button" aria-label="Next video">&rsaquo;</button>
			</div>
			<div class="eba-video-thumbs">
				<?php foreach ( $videos as $i => $v ) : ?>
					<button type="button" class="<?php echo 0 === $i ? 'active' : ''; ?>" data-index="<?php echo (int) $i; ?>">
						<img src="https://img.youtube.com/vi/<?php echo esc_attr( $v['id'] ); ?>/mqdefault.jpg" alt="">
					</button>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="eba-widget">
		<h3>Vacancies</h3>
		<div class="eba-widget-body">
			<ul class="eba-vacancies">
				<li><a href="<?php echo esc_url( eba_url( 'contact' ) ); ?>"><strong>DRIVER/MESSENGER</strong><span>Addis Ababa &bull; EBA &bull; Full Time</span></a></li>
			</ul>
		</div>
	</div>
</aside>
