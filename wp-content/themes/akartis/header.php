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
                                <?php echo get_theme_mod('hero_title', 'Sitraka Nomenjahahary'); ?>
                            </h1>
                            <p class="hero-subtitle">
                                <?php echo get_theme_mod('hero_subtitle', 'Développeur et intégrateur Web'); ?>
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
                    </div>
                </div>
            </section>
            
            <nav class="nav-menu" id="main-header">
                <div class="container-fluid header-container">

                    <div class="nav-logo">
                        <a href="<?= home_url(); ?>" class="nav-link">LOGO</a>
                    </div>

                    <div class="nav-menu-content">
                        <?php 
                            wp_nav_menu(
                                array(
                                    'theme_location'      => is_user_logged_in() ? 'primary' : 'primary',
                                    'container'             => false,
                                    'menu_class'            => 'nav-menu-item'
                                )
                            );  
                        ?>
                        <?php //echo get_search_form(); ?>
                    </div>

                    <div class="nav-menu-item contatc-us">
                        <a href="#contact-us" class="nav-link">CONTACT</a>
                    </div>
                </div>
            </nav>
        </header>