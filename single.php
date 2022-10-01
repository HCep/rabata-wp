<?php
get_header(); ?>

<header class="banner-container d-flex flex-column my-0 justify-content-center align-items-center">
	
			<div class="text-container container px-0">
			<h1 class="text-center banner-heading padding-bottom-50">	<?php the_title(); ?></h1>
			<p class="text-white text-center font-20 banner-breadcrumbs">
				<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
				}
				?></p>
			</div>
		
	</div>
</header>


<main class="padding-60">
    <div class="container mx-auto">
       <h1 class="has-text-align-left heading-separator" style="font-size:48px;font-style:normal;font-weight:300;"><?php the_title(); ?> </h1> 
        <?php the_content(); ?>

    </div>
</main>

    <?php get_footer(); ?>
