

<nav class="arttopia-header">
    
    <div class="nav-header-mob">

        <!-- Mobile Toggle Button (Hidden by Default) -->
        <button class="mobile-menu-toggle" aria-expanded="false" aria-controls="main-nav">
            ≡ <!-- Or use an SVG icon -->
        </button>

        <a class="logo-mobail-continer" href="<?php bloginfo('url'); ?>">
            <img class="arttopia-logo-mob" src="<?php echo get_template_directory_uri(); ?>/assets/images/arttopia-logo.png">
        </a>

    </div>

    <!-- Existing UL (Will be hidden/shown responsively) -->
    <ul class="nav-ul" id="main-nav">
        <div class="li-continer">
            <li><a href="<?php bloginfo('url'); ?>">المنزل</a></li>
            <li><a href="<?php bloginfo('url'); ?>/gallary.php">المعرض</a></li>
            <li class="li-img">
                <a href="<?php bloginfo('url'); ?>">
                    <img class="arttopia-logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/arttopia-logo.png">
                </a>
            </li>
            <li class="call-us-list"><a href="<?php bloginfo('url'); ?>/call-us.php">اتصل بنا</a></li>
            <li><a href="<?php bloginfo('url'); ?>/who-us.php">من نحن</a></li>
        </div>
    </ul>
</nav>