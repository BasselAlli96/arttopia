
        <footer id="site-footer" class="site-footer">

            <div class="footer-wedgits-area">

                <?php dynamic_sidebar('footer_wedgit_one'); ?>
        
                <?php dynamic_sidebar('footer_wedgit_second'); ?>

                <?php dynamic_sidebar('footer_wedgit_third'); ?>
                
            </div>

            <div class="footer-endside">
                <span class="webside-copyrights">
                    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
                </span>
            </div>

        </footer>

    <?php wp_footer(); ?>
    </body>
</html>