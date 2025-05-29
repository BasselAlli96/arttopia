<?php 
/**
 * 
 * 
 * page section code
 */

get_header(); ?>

<main id="main-page" class="main-page">
    <?php 
        while (have_posts()) :

            the_post();

            // get_template_part('template-parts/content/content', 'page');

            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

            bloginfo('name');

        endwhile;
    ?>

</main>

<?php get_footer(); ?>