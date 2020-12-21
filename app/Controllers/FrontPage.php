<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller {

  public function links() {
    $field = get_field('home_links');
    if ($field && !empty($field) && is_array($field)) {
      return array_map(function ($link) {
        return array_merge([
          'heading' => $link['heading'],
        ], $link['link']);
      }, $field);
    }
    return null;
  }

  public function home_widget() {
    $field = get_field('home_widget');
    if ($field && !empty($field)) {
      return $field;

    }
    return null;
  }

  public function home_gallery() {
    $field = get_field('home_gallery');
    if ($field && !empty($field)) {
      return $field;

    }
    return null;
  }

  public function home_posts() {
    $posts = get_posts([
      'type' => 'post',
      'post_status' => 'publish',
      'limit' => 4,
    ]);
    if ($posts && !empty($posts)) {
      return array_map(function ($_post) {
        setup_postdata($GLOBALS['post'] = &$_post);
        global $post;
        $excerpt = has_excerpt() ? $post->post_excerpt : $post->post_content;
        return [
          'title' => get_the_title(),
          'excerpt' => wp_trim_words(wp_strip_all_tags($excerpt), 15, false),
          'permalink' => get_the_permalink(),
        ];
      }, $posts);
      \wp_reset_postdata();
    }
    return null;
  }
}