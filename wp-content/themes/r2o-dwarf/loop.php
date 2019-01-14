<?php
namespace overview;
if ( ! have_posts() ) :
	?>
	<h1>Nothing found</h1>
	<?php
endif; ?>

<?php if(have_posts()) : ?>
	<div id="post_container">
		<?php
		//while ( have_posts() ) : the_post();
		?>
			<div class="entry_content">
				<?php if ( is_home() || is_archive() || is_search() || is_page('shop') ) : ?>
					<div class="content-archive">
						<?php 	
						if(is_search()) {
							echo get_the_search_content(200);
						} else {
							the_excerpt();
						} ?>
					
						<p class="readmore">
						<?php 
							get_template_part('controller/product-overview-controller');
							?></a>
						</p>
					</div>
					<!--  auszug -->
				<?php else : ?>
				<h1 class="header-single"><?php the_title(); ?></h1>
					<div class="content-single">
						<?php the_content(); 
						if( is_page('checkout') ) {
							get_template_part('controller/checkout-controller');
						 }
						 if( is_page('success') ) {
							get_template_part('controller/success-controller');
						 } 
						?>
					</div><!-- inhalt -->
				<?php endif;  ?>
			</div>
		<?php
		//endwhile;
		?>
	</div><!-- post_container div -->
<?php endif; ?>

<?php
