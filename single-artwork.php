<?php
/***
 * 
 * 
 *
 */
get_header(); ?>

<section id="main-artwork-body" class="single-art-body"
    <?php
        while(have_posts()) : the_post();
            
            // $single_artwork_section = load_theme_parts('single-artwork');

            //     foreach ($single_artwork_section as $sections) {
            //         get_template_part( 'template-part/single-artwork/' . $sections[ 'template' ]);
            //     }

            get_template_part('template-part/single-artwork/artwork-header');
            get_template_part('template-part/widget/share-post');
            get_template_part('template-part/single-artwork/singel-gallery');

            

            echo '<div class="comment-section">';
            if (comments_open() || get_comments_number()) {
                comments_template(); // Uses comments.php
            } else {
                echo '<p class="no-comments">Comments are not available.</p>';
            }
            echo '</div>';
        endwhile;
    ?>

<?php get_footer(); ?>