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
            <!-- banner Section -->
            <section class="banner-section">
                <div class="banner-container">
                    <div class="banner-content">
                        <div class="banner-text">
                            <h1 class="banner-title">
                                <?= get_theme_mod( 'prestataire_nom' ) ? get_theme_mod( 'prestataire_nom' ) : 'John Doe'; ?>
                            </h1>
                            <p class="banner-subtitle">
                                <?= get_theme_mod( 'prestataire_prestation' ) ? get_theme_mod( 'prestataire_prestation' ) : 'Designer'; ?>
                            </p>
                            <div class="line"></div>
                            <p class="banner-exerpt">
                                <?= get_theme_mod( 'prestataire_description' ) ? get_theme_mod( 'prestataire_description' ) : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'; ?>
                            </p>
                            <div class="banner-buttons">
                                <a href="<?php echo home_url() . '/#services'; ?>" class="btn btn-more">
                                    <?php _e('En savoir plus', 'akartis'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <nav class="nav-menu" id="main-header">
                <div class="container-fluid header-container">

                    <div class="nav-logo">
                        <a href="<?= home_url(); ?>" class="nav-links" data-replace="<?= bloginfo( 'name' ); ?>"><span><?= bloginfo( 'name' ); ?></span></a>
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
                    </div>

                    <div class="nav-menu-item contact-us">
                        <a href="#contact-us" class="nav-link"><?php _e('Contactez-nous', 'akartis'); ?></a>
                    </div>
                </div>
            </nav>
        </header>