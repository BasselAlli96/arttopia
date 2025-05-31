<?php if (have_comments() || comments_open()) : ?>
    <div class="comments-area">
        <?php comment_form(); ?>
        <?php wp_list_comments(['avatar_size' => 0]); ?>
    </div>
<?php endif; ?>