            <footer>
                <!-- CTA Section -->
                <!-- <section class="cta-section" id="contact-us">
                    <div class="container">
                        <div class="cta-content">
                            <h2 class="cta-title">
                                <?php // _e('Prêt à commencer votre projet ?', 'akartis'); ?>
                            </h2>
                            <p class="cta-description">
                                <?php // _e('Contactez-moi dès maintenant pour discuter de votre projet et obtenir un devis personnalisé.', 'akartis'); ?>
                            </p>
                            <div class="cta-buttons">
                                <ul class="social-links">
                                    <li style="--i:#56CCF2;--j:#2F80ED">
                                        <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                                        <span class="title">Email</span>
                                    </li>
                                    <li style="--i:#a955ff;--j:#ea51ff">
                                        <span class="icon"><i class="fa-brands fa-linkedin-in"></i></span>
                                        <span class="title">Linkedin</span>
                                    </li>
                                    <li style="--i:#FF9966;--j:#FF5E62">
                                        <span class="icon"><i class="fa-brands fa-whatsapp"></i></span>
                                        <span class="title">Whatsapp</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section> -->
                <section class="footer-details">
                    <div class="footer-container">
                        <div class="footer-highlight">
                            <div class="nav-logo">
                                <a href="<?= home_url(); ?>" class="nav-links" data-replace="<?= esc_attr( get_bloginfo( 'name' ) ); ?>">
                                    <span><?= esc_html( get_bloginfo( 'name' ) ); ?></span>
                                </a>
                            </div>
                            <p class="footer-exerpt">
                                <?= get_theme_mod( 'prestataire_description' ) ? get_theme_mod( 'prestataire_description' ) : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'; ?>
                            </p>
                        </div>
                        <div class="footer-sitemap">
                            <?php 
                                wp_nav_menu(
                                    array(
                                        'theme_location'      => is_user_logged_in() ? 'footer' : 'footer',
                                        'container'             => false,
                                        'menu_class'            => 'footer-menu-item'
                                    )
                                );  
                            ?>
                        </div>
                        <div class="footer-contact">
                            <h3 class="footer-title"><?php _e('Contact', 'akartis'); ?></h3>
                            <p class="footer-text">
                                <?= get_theme_mod( 'prestataire_adresse' ) ? get_theme_mod( 'prestataire_adresse' ) : '123 Rue de la Paix, 75000 Paris, France'; ?>
                            </p>
                            <p class="footer-text">
                                <?= get_theme_mod( 'prestataire_telephone' ) ? get_theme_mod( 'prestataire_telephone' ) : '+33 1 23 45 67 89'; ?>
                            </p>
                            <p class="footer-text">
                                <?= get_theme_mod( 'prestataire_email' ) ? get_theme_mod( 'prestataire_email' ) : 'contact@prestashop.com'; ?>
                            </p>
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