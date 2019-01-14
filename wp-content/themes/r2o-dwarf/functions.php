<?php
define('THEME_VERSION',rand()); // rand() only for development - otherwise the site becomes very slow


function r2o_stylesheets() {
    if ( ! is_admin() ) {

        wp_register_style( 'reset', get_template_directory_uri() . '/reset.css', null,20110126 );
        wp_register_style('font','https://fonts.googleapis.com/css?family=Encode+Sans:400,700');
        wp_register_style( 'base', get_template_directory_uri() . '/style.css', ["reset","font"],THEME_VERSION );
        wp_register_style( 'bootstrap-grid', get_template_directory_uri() . '/css/bootstrap-grid.css', ["reset","font"],THEME_VERSION );


        wp_enqueue_style( 'reset' );
        wp_enqueue_style( 'font' );
        wp_enqueue_style( 'base' );
        wp_enqueue_style( 'bootstrap-grid' );

        wp_enqueue_script('main',get_bloginfo('template_url').'/js/main.js',array('jquery'),THEME_VERSION);
        wp_localize_script( 'main', 'r2o_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }
}
add_action( 'wp_enqueue_scripts', 'r2o_stylesheets', 99 );

function sess_start() {
    if (!session_id())
    session_start();
}
add_action('init','sess_start');
