<?php
    function akartis_register_assets() {
		wp_register_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
		wp_register_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js', ['jquery'], false, true);
		wp_enqueue_style('bootstrap-css');
		wp_enqueue_script('bootstrap-js');

		wp_register_style('akartis-style', get_template_directory_uri() . '/style.css');
		wp_enqueue_style('akartis-style');
	}
	add_action('wp_enqueue_scripts', 'akartis_register_assets');