<?php
get_header(); ?>

<header class="banner-container d-flex flex-column my-0 justify-content-center align-items-center">
	
			<div class="text-container container px-0">
			<h1 class="text-center banner-heading padding-bottom-50">	<?php the_title(); ?></h1>
			<p class="text-white text-center  font-20 banner-breadcrumbs">
				<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
				}
				?></p>
			</div>
		
	</div>
</header>


<main>
    <div class="container-fluid px-0 mx-0">
        <?php the_content(); 
		
		if(is_page('portfolio')):
		?>
		<div class="container">

		
		<div class="d-flex  flex-wrap text-center">

		
		
		<?php
			
			$args = array(
                    'post_type'      => 'portfolio',
                    'posts_per_page' => '16',
					'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :
  
        while($query->have_posts()) :
  
            $query->the_post() ;
                      ?>
      <div class="portfolio-item col-md-3 px-0 mb-2"><a href="<?php the_permalink(); ?>">
        <div class="portfolio-back"><img src="<?php the_post_thumbnail_url(); ?>"></div>
        <div class="portfolio-name text-center upper text-white font-weight-bold w-100"><?php the_title(); ?> <p class="font-40">...</p> </div>
        </a></div>
  
       <?php endwhile;
	
		?>
		<div class="pagintaion-container">
		<div class="pagintaion-content">
		<?php 
		$img_right_arrow = "<img src='$template_url/images/arrow-right-pagination.svg'>";
		$img_left_arrow = "<img src='$template_url/images/arrow-left-pagination.svg'>";
		$url_right_arrow = get_template_directory_uri().'/images/arrow-right-pagination.svg';
		$url_left_arrow = get_template_directory_uri().'/images/arrow-left-pagination.svg';
		$big = 999999999; 
		echo paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $query->max_num_pages,
		'prev_text'    => '.',
        'next_text'    => '.',
		) );

		wp_reset_postdata();
		?>
		</div>
		</div>
		
        
		
  <?php
    endif;    
		
		endif;
	if(is_page('nasze-projekty')):
		 
			
	$the_query = new WP_Query( array( 'post_type' => 'projekty', 'posts_per_page' => 4, 'paged' => get_query_var('paged') ? get_query_var('paged') : 1, ) ); 
	
	
	
	if ( $the_query->have_posts() ) {?>
		<div class="container">
		<?php while ( $the_query->have_posts() ) {
			$the_query->the_post();
				if ( has_post_thumbnail() ) {?>
	
				<div class="row flex-wrap pb-3">
					<div class="col-md-3 px-0 image-project-cnt">
						<a href="<?php echo the_permalink(); ?>" rel="bookmark">
							<img src="<?php echo the_post_thumbnail_url($post_id, "full" ); ?>" class="img-fluid filter-dark"></a>
					</div>
					<div class="col-md-9 px-0">
						<a class="title-projects" href="<?php echo the_permalink(); ?>" rel="bookmark"><?php echo the_title();?></a>
						<?php if(!the_excerpt()): ?>
						<?php else: ?>
						<p class="excerpt-projects pt-3" ><?php echo the_excerpt(); ?></p>
						<?php endif; ?>
						<button class="show-more-projects d-block mb-3">
							<a href="<?php echo the_permalink(); ?>" rel="bookmark">Zobacz więcej</a>
						</button>
					</div>
				</div>
				<?php } else { ?>
	
					<div class="col-md-9 px-0">
						<a class="title-projects" href="<?php echo the_permalink(); ?>" rel="bookmark"><?php echo the_title();?></a>
						<?php if(!the_excerpt()): ?>
						<?php else: ?>
						<p class="excerpt-projects pt-3" ><?php echo the_excerpt(); ?></p>
						<?php endif; ?>
						<button class="show-more-projects d-block mb-3">
							<a href="<?php echo the_permalink(); ?>" rel="bookmark">Zobacz więcej</a>
						</button>
					</div>
	<?php
				}
	
	
				}
	
	
		} else {
	
	}?>
	
	</div>
	<div class="pagintaion-container">
	<div class="pagintaion-content">
	<?php
	$img_right_arrow = "<img src='$template_url/images/arrow-right-pagination.svg'>";
	$img_left_arrow = "<img src='$template_url/images/arrow-left-pagination.svg'>";
	$url_right_arrow = get_template_directory_uri().'/images/arrow-right-pagination.svg';
	$url_left_arrow = get_template_directory_uri().'/images/arrow-left-pagination.svg';
	$big = 999999999; 
	echo paginate_links( array(
	'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $the_query->max_num_pages,
	'prev_text'    => '.',
	'next_text'    => '.',
	) );
	wp_reset_postdata();
	?>
	

</div></div>
		
		<?php endif;?>
		<style>
	
		.page-numbers:first-child:after{
			top:0px;
			left:-30px;
			background-image:url(<?php echo $url_left_arrow ?>);
			

		}
		.page-numbers:last-child:before{
			top:0;
			right:-30px;
			background-image:url(<?php echo $url_right_arrow ?>);
			
		}
		
		</style>

	<?php	if ( have_posts() ) : ?>
			<div class="container">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php materialwp_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
			
		</div>

		<?php endif; ?>


	</div>
</main>

<?php get_footer(); ?>
