<?php 
/**
 * 
 * Related post wedgit
 * 
 * 
 */
?>

<!-- define  -->
<?php 

$post_id =  $post->ID ?? get_queried_object_id();
$posts_per_page = 4;
$related_posts = get_related_post($post_id, $posts_per_page);

?>

<div id="related-post" class="related-post-section">
    <p class="related-post-header">مواضيع ذات صلة</p>

    <?php if ($related_posts && $related_posts->have_posts()) : ?>

        <div class="related-post-continer">

            <?php while($related_posts->have_posts()) : $related_posts->the_post();  ?>

                <span class="related-post">

                    <a href="<?php the_permalink(); ?>">
                        
                        <?php if (has_post_thumbnail()) : ?>

                            <div class="related-post-thumbnail">
                                <?php the_post_thumbnail('medium', ['class' => 'related-thumb']); ?>
                            </div>

                        <?php endif; ?>

                        <h4 class="related-post-title"><?php the_title(); ?></h4>

                        <time class="related-post-date" datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date('M j, Y'); ?>
                        </time>
                    </a>

                </span>

            <?php endwhile; ?>
        </div>

        <!-- if there is no posts print this message -->
        <?php else : ?>
            <div class="no-related-posts">لا يوجد محتوى ومواضيع حاليا.</div>

    <?php endif; ?>
</div>