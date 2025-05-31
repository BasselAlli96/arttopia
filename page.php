<?php 
/**
 * 
 * 
 * page section code
 */

get_header(); ?>

<main id="main-page" class="main-page">
    <?php 
        while (have_posts()) : the_post();



            // get_template_part('template-parts/content/content', 'page');
            if(has_post_thumbnail()) {
                the_post_thumbnail('larg', array('class' => 'page-featured-image'));
            }
            // load the title
            the_title('<h1 class="entry-title">', '</h1>');
            // load the content
            the_content();
   

            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

            // bloginfo('name');

        endwhile;
    ?>

</main>

<?php get_footer(); ?>