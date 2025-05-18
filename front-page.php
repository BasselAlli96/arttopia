<?php 
/**
 * front page section
 * 
 * 
 */
get_header();
?>

<section id="front-page" class="front-page">
    <!-- add get template part here -->

    <?php

    $front_sections = load_theme_parts('front-page');

        foreach ($front_sections as $section) {
            get_template_part( 'template-part/front-page/' . $section['template']);
        }

    ?>

</section>

<?php get_footer(); ?>