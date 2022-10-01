<?php

?>

	</div><!-- #content -->
	</div><!-- .row -->
			</div>
	<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="container">
				<div class="row justify-content-between align-items-center padding-bottom-50">
					<div class="col-md-3 px-0"><?php get_sidebar('footer'); ?> </div>
					<div class="col-md-6 px-0">
						<?php
						wp_nav_menu( array(
							'theme_location'    => 'primary',
							'depth'             => 2,
							'container'         => false,
							'menu_class'        => 'menu-list-container menu-list-container-footer',
							'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
							'walker'            => new wp_bootstrap_navwalker())
						);?>
					</div>
					
				</div>
				<div class="row padding-bottom-50">
					
					<?php get_sidebar('footer-headings'); ?>
					
				</div>
			</div>
		</div>

		<!-- prawa autorskie -->
		<div class="footer-bottom-row">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="site-info">

						</div><!-- .site-info -->
					</div> <!-- col-lg-12 -->
				<!-- .containr -->
		</div>
		

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/siema@1.5.1/dist/siema.min.js"></script>
<script type="text/javascript">
    const mySiema = new Siema({
      loop: true,
      perPage: {
        300: 1, 
        800: 1,
        1240: 1 
      },
      duration: 200,
  easing: 'ease-out',
  startIndex: 0,
  draggable: true,
    });
    document.querySelector('.prev').addEventListener('click', () => mySiema.prev());
    document.querySelector('.next').addEventListener('click', () => mySiema.next());
  </script>
</body>
</html>
