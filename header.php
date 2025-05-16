<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header id="site-header" class="site-header">
        <div class="header-top">
            <div id="site-header-continer" class="header-container">
                <!-- Home button -->
                <button id="nav-button" class="nav-button home">
                    <span id="nav-menu" class="nav-menu home">
                        <a class="home-bottun" href="<?php bloginfo('url'); ?>">المنزل</a>
                    </span>
                </button>

                <!-- gallary button -->
                <button id="nav-button" class="nav-button gallary">
                    <span id="nav-menu" class="nav-menu gallary">
                        <a class="gallary-bottun" href="<?php bloginfo('url') . '/gallary.php'; ?>">المعرض</a>
                    </span>
                </button>

                <!-- Logo -->
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>" class="main-logo">
                        </a>
                    <?php endif; ?>
                </div>

                <!-- who button -->
                <button id="nav-button" class="nav-button who">
                    <span id="nav-menu" class="nav-menu who">
                        <a class="who-bottun" href="<?php bloginfo('url') . '/who.php'; ?>">من نحن</a>
                    </span>
                </button>

                <!-- call button -->
                <button id="nav-button" class="nav-button call">
                    <span id="nav-menu" class="nav-menu call">
                        <a class="call-bottun" href="<?php bloginfo('url') . '/call.php'; ?>">اتصل بنا</a>
                    </span>
                </button>
            </div>

        </div>
    </header>