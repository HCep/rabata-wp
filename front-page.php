<?php get_header();
$banner_img = get_field('banner_background');
$banner_logo = get_field('banner_logo');
$banner_title = get_field('banner_title');
$banner_content = get_field('banner_content');

?>

<header class="header-banner" style="background-image:url(<?php echo $banner_img['url'];?>); background-repeat:no-repeat;">
    <div class="container px-0">
        <img class="pt-3 logo-banner" src="<?php echo $banner_logo['url'];?>" alt="<?php echo $banner_logo['alt'];?>" width="205">
        <div class="col-lg-7 col-md-10 col-12 mx-auto text-white text-center container-text-banner">
            <h1 class="title-banner font-weight-bold"><?php echo $banner_title;?></h1>
            <p class="content-banner"><?php echo $banner_content;?></p>
        </div>
    </div>
</header>
<main>
    <div class="container-fluid px-0 mx-0">
        <?php the_content(); ?>
    </div>
</main>

<?php get_footer();?>

