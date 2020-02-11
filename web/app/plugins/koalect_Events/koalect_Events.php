<?php
/**
 * @package Koalect_Events_Plugin
 * @version 1.0.0
 */
/*
Plugin Name: Koalect Events Plugin
Description: Plugin to add badass cpt events
Version: 1.0.0
Author: Jimmy Morrens
Author URI: https://github.com/Askerx9
*/

add_action('init', 'Koalect_Events_init');

/**
 * Create CPT for events
 */
function Koalect_Events_init () {
  /**
   * CPT
   */
  register_post_type('events', array(
    'public'        => true,
    'label'         => __( 'Events'),
    'labels'        => array(
      'name'            => _x('Events', 'Post Type General Name'),
      'sigular_name'    => _x('Event', 'Post Type Singular Name'),
      'menu_name'       => __( 'Events'),
    ),
    'menu_icon'     => 'dashicons-buddicons-groups',
    'menu_position' => 5
  ));

  /**
   * Taxonomy
   */
  $labels = array(
    'name' => _x( 'Years', 'taxonomy general name' ),
    'singular_name' => _x( 'Year', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Years' ),
    'all_items' => __( 'All Years' ),
    'parent_item' => __( 'Parent Year' ),
    'parent_item_colon' => __( 'Parent Year:' ),
    'edit_item' => __( 'Edit Year' ),
    'update_item' => __( 'Update Year' ),
    'add_new_item' => __( 'Add New Year' ),
    'new_item_name' => __( 'New Year' ),
    'menu_name' => __( 'Years' ),
  );

  register_taxonomy('event_year',array('events'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'event_year' ),
  ));
}
