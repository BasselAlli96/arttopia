<?php 
/**
 * front page section
 * 
 * 
 */
get_header();
?>

<section id="main-page" class="main-front-page">
    <!-- add get template part here -->
    <?php

    $front_sections = load_theme_parts('front-website');

        foreach ($front_sections as $sections) {
            get_template_part( 'template-part/front-page/' . $sections[ 'template' ]);
        }

    ?>

</section>

<?php get_footer(); ?>