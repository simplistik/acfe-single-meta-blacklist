<?php

add_filter( 'acfe/modules/single_meta/post_types', 'simpl_control_single_meta_post_types' );

simpl_control_single_meta_post_types( $post_types ) {

  /**
   * Exclude specific post types from saving as single meta
   *
   * If you are not using ACFE to register your post types you
   * can skip steps 03 - 05a (comment or delete) and go
   * straight to 05b and use that instead.
   *
   * Alternatively if you only want to get if you want to only get
   * post types registered through ACFE ignore 02, and adjust accordingly.
   *
   * However, 03 will default to an empty array so the logic does not error out.
   */

  // 01. create a list of post types you don't want
  $black_list_post_types = array( 'events' );

  // 02. formats as array( 'post_type' => 'post_type' ), we only want the keys
  $wp_post_types = array_keys( get_post_types( [], 'names' ) );

  // 03. ACFE's post types don't register with get_post_types() so we have to fetch separately, just want the keys again :)
  $acfe_post_types = array_keys( acfe_get_settings( 'modules.post_types', [] ) );

  // 04. merge these bad boys
  $all_post_types = [ ...$wp_post_types, ...$acfe_post_types ];

  // 05a. remove the black list from your final array
  $post_types = array_diff( $all_post_types,  $black_list_post_types );

  // 05b. remove the black list from your final array
  // $post_types = array_diff( $wp_post_types,  $black_list_post_types );

  return $post_types;
}
