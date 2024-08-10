<?php

/**
 *@package CPT_Plugin Plugin
 */


/*
Plugin Name: My Team Plugin
Plugin URI: 
Description: This plugin helps create new CPT.
Version: 1.0
Author: Eren Nar
Author URI: 
*/


defined('ABSPATH') or die('Dangar 404');


class CPT_Plugin
{

    function __construct()
    {
        add_action('init',  array($this, 'custom_post_type'));
       
    }

    function register()
    {
        add_action('admin_enqueue_scripts',  array($this, 'enqueue'));
        
       
    }
  


    function activate()
    {
        $this->custom_post_type();
        flush_rewrite_rules();
    }

    function deactivate()
    {
        flush_rewrite_rules();
    }


    function custom_post_type()
    {

        register_post_type(
            'new_plugin',
            // CPT Options
            array(
                'labels' => array(
                    'name' => __('New_Plugin'),
                    'singular_name' => __('New_Plugin'),
                    'add_new' => __('Yeni Ekle'),
                    'add_new_item' => __('Yeni Ekle')

                ),
                
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => '/new-plugin', 'pages' => true),
                'show_ui' => true,
                'menu_position' => 5,
                'show_in_menu'       => true,
                'query_var'          => true,
                'hierarchical'       => true,
                'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'headway-seo'),
                'taxonomies'         => array('category', 'post_tag'),
                'publicly_queryable' => true,
                'menu_icon'             => 'dashicons-megaphone',
                'map_meta_cap' => true,
                'can_export' => true



            )
        );
    }


    function enqueue()
    {
        //wp_enqueue_style('stylesheet', plugins_url('/assets/css/mystyle.css', __FILE__));
    }
}
if (class_exists('CPT_Plugin')) {
    $cptPlugin = new CPT_Plugin();
    $cptPlugin->register();

    
};


//uninstall
register_uninstall_hook("./uninstall.php", array($cptPlugin, 'uninstall'));
