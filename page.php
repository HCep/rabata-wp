<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package materialwp
 */

get_header(); ?>

<section class="baner-container page-baner my-0 py-0">
		<?php 
		$baner_imagee = get_field('baner-image');
		

		?>
		<div class="baner" style="background-image:url('<?php echo $baner_imagee; ?>'); top:-20px; background-repeat:no-repeat; background-size:cover">	
			<div class="dark-overlay "></div>
		<div class="text-container">
				<h1 class="has-text-align-center baner-title "><?php the_title(); ?></h1>
				
		</diV>
	
	</div>
			
		
		
	
</section>
<div class="container">
	<div class="row">

		<div id="primary" class="col-xs-12">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
