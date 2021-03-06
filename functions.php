<?php
/**
 * ====================
 *  @Package EFT Theme
 * ====================
 */

 
function eft_theme_support() {
    /**  
     * ===============
     * All Theme Support
     * ===============
     */
    add_theme_support( 'html5' );
    add_theme_support(
        'post-formats',
        array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        )
    );
    add_theme_support( 'custom-logo', array(
        'height' => 50,
        'width'  => 50,
    ) );

    add_theme_support('title-tag');
    add_theme_support( 'custom-header' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );





    # Menu Register 
    $location = array(
        'primary_menu' => 'Nav Menu',
    );
    register_nav_menus( $location );

}
add_action('after_setup_theme' , 'eft_theme_support');


/**
   *All file includ here
 */
include_once get_template_directory()."/inc_functions/eft-style.php";//all stylesheet calling

include_once get_template_directory()."/inc_functions/eft_walker_nav.php"; //nav menu walker
include_once get_template_directory()."/inc_functions/popular.php"; //popular_post
include_once get_template_directory()."/inc_functions/eft-widget.php"; //popular_post

include_once get_template_directory()."/inc_functions/custom_functions.php"; //All theme Custom functions


/** Make Theme Options */

require get_template_directory()."/theme_option/ReduxCore/framework.php";

require_once get_template_directory()."/theme_option/sample/sample-config.php";


add_action( "customize_register", "default_customizer_opt" );
function default_customizer_opt( $wp_customize ) {

 //=============================================================
 // Remove header image and widgets option from theme customizer
 //=============================================================
 $wp_customize->remove_control("header_image");

 //=============================================================
 // Remove Colors, Background image, and Static front page 
 // option from theme customizer     
 //=============================================================
 $wp_customize->remove_section("colors");
 $wp_customize->remove_section("background_image");
 $wp_customize->remove_section("static_front_page");

}