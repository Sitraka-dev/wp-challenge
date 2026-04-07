<?php
/**
 * Template Name: Page d'Accueil
 * Description: Template personnalisé pour la page d'accueil
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php _e('Mes services', 'akartis'); ?></h2>
                <p class="section-subtitle">Découvrez ce que nous pouvons faire pour vous</p>
            </div>
            <div class="services-grid">
                <?php

                $all_services = get_posts( [
                    'post_type'   => 'services',
                    'post_status' => 'publish',
                    'numberposts' => -1,
                    'orderby'     => 'date',
                    'order'       => 'ASC',
                ] );

                if (!empty($all_services)) :
                    foreach ($all_services as $service) : ?>

                        <?php
                            setup_postdata($service);
                            $service_fontawesome = get_post_meta($service->ID, '_service_fontawesome', true) ? get_post_meta($service->ID, '_service_fontawesome', true) : '';
                        ?>
                        
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas <?php echo esc_attr($service_fontawesome); ?>"></i>
                            </div>
                            <h3 class="service-title"><?php echo $service->post_title; ?></h3>
                            <p class="service-description"><?php echo $service->post_excerpt; ?></p>
                            <a href="<?php echo get_permalink($service->ID); ?>" class="service-link">En savoir plus</a>
                        </div>

                        <?php wp_reset_postdata(); ?>

                    <?php endforeach;
                endif; ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="about-title">
                        <?php echo get_theme_mod('about_title', 'À Propos de Nous'); ?>
                    </h2>
                    <p class="about-description">
                        <?php echo get_theme_mod('about_description', 'Nous sommes une équipe passionnée dédiée à créer des expériences digitales exceptionnelles. Avec des années d\'expérience dans le domaine, nous mettons notre expertise au service de vos projets.'); ?>
                    </p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <span class="stat-number"><?php echo get_theme_mod('stat_1_number', '150+'); ?></span>
                            <span class="stat-label"><?php echo get_theme_mod('stat_1_label', 'Projets Réalisés'); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo get_theme_mod('stat_2_number', '5+'); ?></span>
                            <span class="stat-label"><?php echo get_theme_mod('stat_2_label', 'Années d\'Expérience'); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo get_theme_mod('stat_3_number', '100%'); ?></span>
                            <span class="stat-label"><?php echo get_theme_mod('stat_3_label', 'Clients Satisfaits'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <?php 
                    $about_image = get_theme_mod('about_image');
                    if ($about_image) : ?>
                        <img src="<?php echo esc_url($about_image); ?>" alt="À propos" class="about-img">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Posts Section -->
    <section class="blog-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Derniers articles</h2>
                <p class="section-subtitle">Restez informé avec nos dernières publications</p>
            </div>
            <div class="blog-grid">
                <?php
                $recent_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                ));
                
                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                        <article class="blog-card">
                            <div class="blog-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array('class' => 'blog-img')); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-date"><?php echo get_the_date(); ?></span>
                                    <span class="blog-category">
                                        <?php 
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            echo esc_html($categories[0]->name);
                                        }
                                        ?>
                                    </span>
                                </div>
                                <h3 class="blog-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                <a href="<?php the_permalink(); ?>" class="read-more">Lire la suite</a>
                            </div>
                        </article>
                    <?php endwhile;
                    wp_reset_postdata();
                endif; ?>
            </div>
            <div class="blog-cta">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn btn-outline">
                    Voir tous les articles
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" style="display: none;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Témoignages</h2>
                <p class="section-subtitle">Ce que nos clients disent de nous</p>
            </div>
            <div class="testimonials-slider">
                <?php
                $testimonials = get_theme_mod('testimonials_list', array());
                if (!empty($testimonials)) :
                    foreach ($testimonials as $testimonial) : ?>
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <p class="testimonial-text">"<?php echo esc_html($testimonial['text']); ?>"</p>
                                <div class="testimonial-author">
                                    <div class="author-info">
                                        <h4 class="author-name"><?php echo esc_html($testimonial['name']); ?></h4>
                                        <span class="author-position"><?php echo esc_html($testimonial['position']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                else :
                    // Témoignages par défaut
                    $default_testimonials = array(
                        array(
                            'text' => 'Excellent travail, équipe très professionnelle et à l\'écoute. Je recommande vivement !',
                            'name' => 'Marie Dubois',
                            'position' => 'Directrice Marketing'
                        ),
                        array(
                            'text' => 'Un service de qualité, dans les délais et avec un excellent suivi. Parfait !',
                            'name' => 'Jean Martin',
                            'position' => 'Entrepreneur'
                        )
                    );
                    foreach ($default_testimonials as $testimonial) : ?>
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <p class="testimonial-text">"<?php echo esc_html($testimonial['text']); ?>"</p>
                                <div class="testimonial-author">
                                    <div class="author-info">
                                        <h4 class="author-name"><?php echo esc_html($testimonial['name']); ?></h4>
                                        <span class="author-position"><?php echo esc_html($testimonial['position']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                endif; ?>
            </div>
        </div>
    </section>
    
    <!-- Skill Section -->
    <section>
        <div class="container">
            
        </div>
    </section>
</main>


<?php get_footer(); ?>