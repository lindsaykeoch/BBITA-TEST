<?php
/**
 * Plugin Name:  Baseball in the Attic – Elementor Widgets
 * Description:  Custom Elementor widget set for Baseball in the Attic.
 * Version:      1.0.0
 * Author:       Baseball in the Attic
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Elementor tested up to: 3.25
 */

defined( 'ABSPATH' ) || exit;

define( 'BITA_VERSION', '1.0.0' );
define( 'BITA_PATH',    plugin_dir_path( __FILE__ ) );
define( 'BITA_URL',     plugin_dir_url( __FILE__ ) );

/* ── 1. Check Elementor is active ───────────────────────────── */
add_action( 'plugins_loaded', function () {
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', function () {
            echo '<div class="notice notice-error"><p>'
               . '<strong>BITA Widgets</strong> requires Elementor to be installed and activated.'
               . '</p></div>';
        } );
        return;
    }

    /* ── 2. Register widget category ────────────────────────── */
    add_action( 'elementor/elements/categories_registered', function ( $manager ) {
        $manager->add_category( 'bita', [
            'title' => __( 'Baseball in the Attic', 'bita' ),
            'icon'  => 'eicon-star',
        ] );
    } );

    /* ── 3. Enqueue global styles ───────────────────────────── */
    add_action( 'elementor/frontend/after_enqueue_styles', function () {
        wp_enqueue_style(
            'bita-global',
            BITA_URL . 'assets/css/bita-global.css',
            [],
            BITA_VERSION
        );

        // Google Fonts
        wp_enqueue_style(
            'bita-fonts',
            'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,900;1,400;1,900'
            . '&family=Barlow+Condensed:wght@900'
            . '&family=Lexend:wght@700'
            . '&family=Poppins:wght@500'
            . '&display=swap',
            [],
            null
        );
    } );

    /* ── 4. Register widgets ────────────────────────────────── */
    add_action( 'elementor/widgets/register', function ( $manager ) {
        $widgets = [
            'topbar',
            'hero',
            'journey',
            'as-seen-in',
            'different-kind',
            'pillars',
            'who',
            'ready',
            'footer',
        ];

        foreach ( $widgets as $slug ) {
            $file = BITA_PATH . "widgets/class-widget-{$slug}.php";
            if ( file_exists( $file ) ) {
                require_once $file;
            }
        }

        $classes = [
            'BITA\Widgets\Top_Bar',
            'BITA\Widgets\Hero',
            'BITA\Widgets\Journey',
            'BITA\Widgets\As_Seen_In',
            'BITA\Widgets\Different_Kind',
            'BITA\Widgets\Pillars',
            'BITA\Widgets\Who',
            'BITA\Widgets\Ready',
            'BITA\Widgets\Footer',
        ];

        foreach ( $classes as $class ) {
            if ( class_exists( $class ) ) {
                $manager->register( new $class() );
            }
        }
    } );
} );
