<?php get_header(); ?>

<main id="main-content">
    <?php if (have_posts()) :
        # so if there is post get this template-parts/content
        while (have_posts()) : the_post();
            # get the right php folder to render on the page
            get_template_part( 'template-parts/content' , get_post_type());
        endwhile;
    else :
        # if the code did not find anything appeare none /content-none
        get_template_part( 'template-parts/content', 'none' );
    endif; ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>