<?php
    function akartis_register_assets() {
		wp_register_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
		wp_register_style('font-awesome-cdn','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
		wp_register_style('akartis-style', get_template_directory_uri() . '/style.css');
		wp_enqueue_style('google-fonts','https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@300;600&display=swap',false);

		wp_register_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js', ['jquery'], false, true);
		wp_register_script('akartis-js', get_template_directory_uri() . '/assets/js/script.js', ['jquery', 'bootstrap-js'], false, true);

		wp_enqueue_style('bootstrap-css');
		wp_enqueue_style('font-awesome-cdn');
		wp_enqueue_style('akartis-style');

		wp_enqueue_script('bootstrap-js');
		wp_enqueue_script('akartis-js');
	}
	add_action('wp_enqueue_scripts', 'akartis_register_assets');