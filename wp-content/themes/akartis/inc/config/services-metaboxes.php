<?php 
    function add_service_meta_boxes() {
        add_meta_box(
            'services_details',
            __('Service details', 'akartis'),
            'service_details_callback',
            'services',
            'normal',
            'high'
        );
    }
    add_action('add_meta_boxes', 'add_service_meta_boxes');

    function service_details_callback($post) {
        wp_nonce_field('service_details_nonce', 'service_details_nonce');
        
        $service_fontawesome = get_post_meta($post->ID, '_service_fontawesome', true);
        
        echo '<table class="form-table">';
        echo '<tr>';
        echo '<th><label for="service_fontawesome">' . __('Icon', 'akartis') . '</label></th>';
        echo '<td><input type="text" id="service_fontawesome" name="service_fontawesome" value="' . esc_attr($service_fontawesome) . '" /></td>';
        echo '</tr>';
        echo '</table>';
    }

    function save_services_meta_boxes($post_id) {
        // Verify nonce
        if (!isset($_POST['service_details_nonce']) || !wp_verify_nonce($_POST['service_details_nonce'], 'service_details_nonce')) {
            return;
        }
        
        // Check if autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        // Check permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        // Save property details
        $fields = array(
            'service_fontawesome'
        );
        
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
    add_action('save_post', 'save_services_meta_boxes');