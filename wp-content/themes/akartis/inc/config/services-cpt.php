<?php

    function akartis_register_post_types() {
        $labels = array(
            'name'               => __('My services', 'akartis'),
            'singular_name'      => __('Services', 'akartis'),
            'menu_name'          => __('Services', 'akartis'),
            'add_new'            => __('Add new services', 'akartis'),
            'add_new_item'       => __('Add new service', 'akartis'),
            'edit_item'          => __('Edit services', 'akartis'),
            'new_item'           => __('New services', 'akartis'),
            'view_item'          => __('View services', 'akartis'),
            'search_items'       => __('Search services', 'akartis'),
            'not_found'          => __('No services found', 'akartis'),
            'not_found_in_trash' => __('No services found in trash', 'akartis'),
        );
        
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => false,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'services'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-admin-site',
            'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        );
        
        register_post_type('services', $args);
    }
    add_action('init', 'akartis_register_post_types');
    
    function akartis_flush_rewrite_rules() {
        flush_rewrite_rules();
    }
    add_action('init', 'akartis_flush_rewrite_rules');
