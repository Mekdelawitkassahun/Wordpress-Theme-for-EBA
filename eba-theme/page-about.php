<?php
/**
 * About Us page — matches original ethiopianbankers.com/about/
 */
get_header();
?>
<main class="eba-main eba-inner">
	<div class="eba-wrap eba-columns">
		<div class="eba-content">
			<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
			<article class="eba-page eba-about-page" id="about-eba">
				<h1 class="eba-page-title">About Us</h1>
				<div class="eba-entry about-us">
					<section id="vision" style="scroll-margin-top: 50px;">
						<h2><span class="title-h2">Vision</span></h2>
						<p>With all the capacity to be sole lobbying agent for member banks, the association aspires to evolve into dependable training, networking and sectorial research institute that serves the entire financial sector.</p>
					</section>

					<section id="mission" style="scroll-margin-top: 50px;">
						<h2><span class="title-h2">Mission</span></h2>
						<p>The mission of EBA is to promote and serve the interests of member banks through training, advocacy, research and networking with the ultimate objective of creating competitive banking industry in Ethiopia.</p>
					</section>

					<section id="objectives" style="scroll-margin-top: 50px;">
						<h2><span class="title-h2">Objectives</span></h2>
						<ul class="eba-list-title">
							<li>Further a co-operative spirit and ventures among member banks</li>
							<li>Organize and facilitate the exchange of information and expertise</li>
							<li>Advocate the passage of legislation, policies and regulations conducive to good banking practices</li>
							<li>Promote and support banking education, training and research</li>
							<li>Organize and advance banking activities of common benefit such as clearing houses, transfers handling, inter-bank lending, money markets, and the like</li>
							<li>Undertake the settlement of disputes that may arise among members through mediation and arbitration</li>
							<li>Develop and recommend a code of conduct for banking practices</li>
							<li>Educate the public on banking services</li>
							<li>Purchase, administer, sell, and transfer the properties of the Association</li>
							<li>Represent the banking sector</li>
							<li>Carry out other activities related to the fulfillment of the purposes of the Association</li>
						</ul>
					</section>

					<section id="board" style="scroll-margin-top: 50px; margin-top: 30px;">
						<div class="eba-team">
							<h3><span class="title-h3">Board of Directors</span></h3>
							<div class="eba-team-grid">
								<?php
								$team = array(
									array( 'name' => 'Ato Abie Sano', 'role' => 'Chairman', 'img' => 'team-abie.jpg' ),
									array( 'name' => 'Ato Asfaw Alemu', 'role' => 'Vice Chairman', 'img' => 'team-asfaw.jpg' ),
									array( 'name' => 'Ato Dereje Zenebe', 'role' => 'Member', 'img' => 'team-dereje2.jpg' ),
									array( 'name' => 'Ato Deribie Asfaw', 'role' => 'Member', 'img' => 'team-deribie.jpg' ),
									array( 'name' => 'Dr Emebet Melese', 'role' => 'Member', 'img' => 'team-emebit.jpg' ),
									array( 'name' => 'Ato Ermias Tefera', 'role' => 'Member', 'img' => 'team-ermias.jpg' ),
									array( 'name' => 'Ato Hailu Alemu', 'role' => 'Member', 'img' => 'team-hailu.jpg' ),
									array( 'name' => 'Ato Mulugeta Alema', 'role' => 'Member', 'img' => 'team-mulugeta.jpg' ),
									array( 'name' => 'Ato Teferi Mekonen', 'role' => 'Member', 'img' => 'team-teferi.jpg' ),
									array( 'name' => 'Woy Tsigereda Tesfaye', 'role' => 'Member', 'img' => 'team-tsigereda.jpg' ),
									array( 'name' => 'Ato Tsehay Shiferaw', 'role' => 'Member', 'img' => 'team-tsehay.jpg' ),
									array( 'name' => 'Ato Yehuala Gessese', 'role' => 'Member', 'img' => 'team-yehuala.jpg' ),
									array( 'name' => 'Ato Demessew Kassa', 'role' => 'Secretary General', 'img' => 'team-demessew.jpg' ),
								);
								foreach ( $team as $person ) :
									?>
									<div class="eba-team-member">
									<figure><img src="<?php echo esc_url( eba_asset( $person['img'] ) ); ?>" alt="<?php echo esc_attr( $person['name'] ); ?>"></figure>
									<h4><?php echo esc_html( $person['name'] ); ?></h4>
									<div class="eba-team-role"><?php echo esc_html( $person['role'] ); ?></div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					</section>
				</div>
			</article>
		</div>
		<?php get_template_part( 'template-parts/sidebar' ); ?>
	</div>
</main>
<?php get_footer(); ?>
