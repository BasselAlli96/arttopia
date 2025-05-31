<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage arrtopia-template
 */

get_header(); ?>

<main id="primary" class="site-main single-post-wide">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Post Meta Above Featured Image -->
            <div class="post-meta-above">
                <span class="post-date"><i class="fas fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                <span class="post-time"><i class="fas fa-clock"></i> <?php the_time(); ?></span>
                <span class="post-author"><i class="fas fa-user"></i> <?php the_author(); ?></span>
            </div>

            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="featured-image-wrapper">
                    <?php the_post_thumbnail('full', array('class' => 'featured-image')); ?>
                    <div class="post-title-overlay">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Post Content -->
            <div class="entry-content">
                <?php the_content(); ?>
            </div>

        </article>
    <?php endwhile; ?>
</main>

<?php get_template_part('template-part/widget/share-post'); ?>
<?php get_template_part('template-part/widget/related-content'); ?>

<?php get_footer(); ?>