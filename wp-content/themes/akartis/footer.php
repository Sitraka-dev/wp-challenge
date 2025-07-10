            <footer>
                <!-- CTA Section -->
                <section class="cta-section">
                    <div class="container">
                        <div class="cta-content">
                            <h2 class="cta-title">
                                <?php echo get_theme_mod('cta_title', 'Prêt à Commencer Votre Projet ?'); ?>
                            </h2>
                            <p class="cta-description">
                                <?php echo get_theme_mod('cta_description', 'Contactez-nous dès aujourd\'hui pour discuter de vos besoins et obtenir un devis personnalisé.'); ?>
                            </p>
                            <div class="cta-buttons">
                                <a href="<?php echo get_theme_mod('cta_primary_btn_url', '/contact'); ?>" class="btn btn-primary btn-large">
                                    <?php echo get_theme_mod('cta_primary_btn_text', 'Nous Contacter'); ?>
                                </a>
                                <a href="<?php echo get_theme_mod('cta_secondary_btn_url', '/portfolio'); ?>" class="btn btn-outline btn-large">
                                    <?php echo get_theme_mod('cta_secondary_btn_text', 'Voir Notre Portfolio'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <?php do_action('akartis_footer_copyright'); ?>
            </footer>
            <?php do_action('akartis_scroll_to_top'); ?>
            <?php wp_footer(); ?>
        </div>
    </body>
</html>