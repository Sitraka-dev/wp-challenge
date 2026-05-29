<?php

/**
 * Section Prestataire - Customizer
 */
add_action( 'customize_register', function( $wp_customize ) {

    // SECTION
    $wp_customize->add_section( 'prestataire_section', array(
        'title'       => __( 'Prestataire', 'akartis' ),
        'priority'    => 160,
        'description' => __( 'Informations du prestataire', 'akartis' ),
    ) );

    // NOM
    $wp_customize->add_setting( 'prestataire_nom', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'prestataire_nom', array(
        'label'    => __( 'Nom', 'textdomain' ),
        'section'  => 'prestataire_section',
        'type'     => 'text',
    ) );

    // PRESTATION
    $wp_customize->add_setting( 'prestataire_prestation', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'prestataire_prestation', array(
        'label'    => __( 'Prestation', 'textdomain' ),
        'section'  => 'prestataire_section',
        'type'     => 'text',
    ) );

    // DESCRIPTION
    $wp_customize->add_setting( 'prestataire_description', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'prestataire_description', array(
        'label'    => __( 'Description', 'textdomain' ),
        'section'  => 'prestataire_section',
        'type'     => 'textarea',
    ) );

    // BACKGROUND PRESTATAIRE
    $wp_customize->add_setting( 'prestataire_background', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'prestataire_background',
            array(
                'label'     => __( 'Bannière de fond du prestataire', 'akartis' ),
                'section'   => 'prestataire_section',
                'mime_type' => 'image',
            )
        )
    );

    // COULEUR PRINCIPALE
    $wp_customize->add_setting( 'prestataire_color_primary', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'prestataire_color_primary',
            array(
                'label'   => __( 'Couleur principale', 'akartis' ),
                'section' => 'prestataire_section',
            )
        )
    );

    // COULEUR SECONDAIRE
    $wp_customize->add_setting( 'prestataire_color_secondary', array(
        'default'           => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'prestataire_color_secondary',
            array(
                'label'   => __( 'Couleur secondaire', 'akartis' ),
                'section' => 'prestataire_section',
            )
        )
    );

    // COULEUR D’ACCENT
    $wp_customize->add_setting( 'prestataire_color_accent', array(
        'default'           => '#22c55e',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'prestataire_color_accent',
            array(
                'label'   => __( 'Couleur d’accent (CTA)', 'akartis' ),
                'section' => 'prestataire_section',
            )
        )
    );

    // COULEUR TEXTE
    $wp_customize->add_setting( 'prestataire_color_text', array(
        'default'           => '#1f2933',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'prestataire_color_text',
            array(
                'label'   => __( 'Couleur du texte', 'akartis' ),
                'section' => 'prestataire_section',
            )
        )
    );
});
