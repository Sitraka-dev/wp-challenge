<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div>
        <header>

            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-container">
                    <div class="hero-content">
                        <div class="hero-text">
                            <h1 class="hero-title">
                                <?php echo get_theme_mod('hero_title', 'Bienvenue sur Notre Site'); ?>
                            </h1>
                            <p class="hero-subtitle">
                                <?php echo get_theme_mod('hero_subtitle', 'Découvrez notre univers et nos services exceptionnels'); ?>
                            </p>
                            <div class="hero-buttons">
                                <a href="<?php echo get_theme_mod('hero_primary_btn_url', '#services'); ?>" class="btn btn-primary">
                                    <?php echo get_theme_mod('hero_primary_btn_text', 'Nos Services'); ?>
                                </a>
                                <a href="<?php echo get_theme_mod('hero_secondary_btn_url', '#about'); ?>" class="btn btn-secondary">
                                    <?php echo get_theme_mod('hero_secondary_btn_text', 'En Savoir Plus'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="hero-image">
                            <?php 
                            $hero_image = get_theme_mod('hero_image');
                            if ($hero_image) : ?>
                                <img src="<?php echo esc_url($hero_image); ?>" alt="Hero Image" class="hero-img">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            
            <nav class="nav-menu">
                <div class="container-fluid">

                    <div class="nav-menu-content">
                        <?php 
                            wp_nav_menu(
                                array(
                                    'theme_location'      => is_user_logged_in() ? 'primary' : 'primary',
                                    'container'             => false,
                                    'menu_class'            => 'nnav-menu-item'
                                )
                            );  
                        ?>

                        <?php //echo get_search_form(); ?>
                    </div>
                </div>
            </nav>
        </header>