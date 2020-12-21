<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller {

  protected $acf = ['hero_title', 'hero_subtitle', 'hero_actions', 'hero_background'];

  public function siteName() {
    return get_bloginfo('name');
  }

  public function site_notice() {
    $field = get_field('site_notice', 'options');
    if ($field && isset($field['enabled'], $field['dismissible'], $field['content']) && $field['enabled']) {
      $id = md5($field['content']);
      return [
        'id' => $id,
        'dismissible' => $field['dismissible'],
        'content' => $field['content'],
      ];
    }
    return null;
  }

  public static function title() {
    if (is_home()) {
      if ($home = get_option('page_for_posts', true)) {
        return get_the_title($home);
      }
      return __('Latest Posts', 'sage');
    }
    if (is_archive()) {
      return get_the_archive_title();
    }
    if (is_search()) {
      return sprintf(__('Search Results for %s', 'sage'), get_search_query());
    }
    if (is_404()) {
      return __('Not Found', 'sage');
    }
    return get_the_title();
  }

  public function opening_hours() {
    return \App\opening_hours();
  }

  public function hero_title() {
    $field = get_field('hero_title');
    if ($field && !empty($field)) {
      return $field;
    }

    return App::title();
  }

  public function hero_subtitle() {
    $field = get_field('hero_subtitle');
    if ($field && !empty($field)) {
      return $field;
    }

    return null;
  }

  public function hero_actions() {
    $field = get_field('hero_actions');
    if ($field && !empty($field) && is_array($field)) {
      $actions = [];
      foreach ($field as $action) {
        if (isset($action['link']) && is_array($action['link'])) {
          $actions[] = $action['link'];
        }
      }
      return $actions;
    }
    return null;
  }

  public function hero_background() {
    $field = get_field('hero_background');
    if ($field && !empty($field) && is_array($field)) {
      return $field;
    }
    $defaultField = get_field('default_banner', 'options');
    if ($defaultField && !empty($defaultField)) {
      return [$defaultField];
    }
    return null;
  }
}