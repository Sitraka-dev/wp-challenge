            <footer>
                <!-- CTA Section -->
                <section class="cta-section" id="contact-us">
                    <div class="container">
                        <div class="cta-content">
                            <h2 class="cta-title">
                                <?php echo _e('Prêt à commencer votre projet ?', 'akartis'); ?>
                            </h2>
                            <p class="cta-description">
                                <?php echo _e('Contactez-moi dès maintenant pour discuter de votre projet et obtenir un devis personnalisé.', 'akartis'); ?>
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
                </section>
                <?php do_action('akartis_footer_copyright'); ?>
            </footer>
            <?php do_action('akartis_scroll_to_top'); ?>
            <?php wp_footer(); ?>
        </div>
    </body>
</html>