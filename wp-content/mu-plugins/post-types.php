<?php

function post_types() {
  // Tip Post Type
  register_post_type('Tips', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'tips'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Tips',
      'add_new_item' => 'Add New Tip',
      'edit_item' => 'Edit Tip',
      'all_items' => 'All Tips',
      'singular_name' => 'Tip'
    ),
    'menu_icon' => 'dashicons-performance',
  ));

}

add_action('init', 'post_types');