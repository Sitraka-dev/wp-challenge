<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    // Configuration du thème
    require_once get_template_directory() . '/inc/enqueue.php';
    require_once get_template_directory() . '/inc/includes.php';
	require_once get_template_directory() . '/inc/config/theme-setup.php';
    require_once get_template_directory() . '/inc/config/menu-config.php';
    require_once get_template_directory() . '/inc/config/services-cpt.php';
    require_once get_template_directory() . '/inc/config/services-metaboxes.php';