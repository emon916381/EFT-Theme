<?php
/**
* ====================
*  @Package EFT Theme
* ====================
*/

function eft_style_and_js_file(){
    $theme_ver = wp_get_theme() -> get('Version');
    wp_enqueue_style( 'fontweasome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all' );
    wp_enqueue_style( 'bootstrap-style-min', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), '4.4.1', 'all' );
    wp_enqueue_style( 'theme_css', get_theme_file_uri('/css/theme.css'), array(), $theme_ver, 'all' );
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );



    
    wp_enqueue_script( 'jquery-min', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', array(), 
    '3.4.1', true );
    wp_enqueue_script( 'jquery-min-poper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array('jquery-min'), '1.16.0', true );
    wp_enqueue_script( 'bootstrap-jquery', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery-min'), '4.4.1', true );
    
    // wp_enqueue_script( 'fontweasome-jquery', 'https://kit.fontawesome.com/70e15e6b6d.js', array('jquery-min'), '', true );
    

}
add_action( 'wp_enqueue_scripts','eft_style_and_js_file' );


function eft_admin_style_and_js_file(){
    $theme_ver = wp_get_theme() -> get('Version');
    wp_enqueue_style( 'theme_admin_css', get_theme_file_uri('/css/eft-admin.css'), array(), $theme_ver, 'all' );

}
add_action( 'admin_enqueue_scripts','eft_admin_style_and_js_file' );








