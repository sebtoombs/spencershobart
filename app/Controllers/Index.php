<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Index extends Controller {

  public function custom_excerpt() {
    global $post;
    $excerpt = has_excerpt() ? $post->post_excerpt : $post->post_content;
    return wp_trim_words(wp_strip_all_tags($excerpt), 15, false);
  }
}