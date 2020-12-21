<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null) {
  $container = $container ?: Container::getInstance();
  if (!$abstract) {
    return $container;
  }
  return $container->bound($abstract)
  ? $container->makeWith($abstract, $parameters)
  : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null) {
  if (is_null($key)) {
    return sage('config');
  }
  if (is_array($key)) {
    return sage('config')->set($key);
  }
  return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = []) {
  return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = []) {
  return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset) {
  return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates) {
  $paths = apply_filters('sage/filter_templates/paths', [
    'views',
    'resources/views',
  ]);
  $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

  return collect($templates)
    ->map(function ($template) use ($paths_pattern) {
      /** Remove .blade.php/.blade/.php from template names */
      $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

      /** Remove partial $paths from the beginning of template names */
      if (strpos($template, '/')) {
        $template = preg_replace($paths_pattern, '', $template);
      }

      return $template;
    })
    ->flatMap(function ($template) use ($paths) {
      return collect($paths)
        ->flatMap(function ($path) use ($template) {
          return [
            "{$path}/{$template}.blade.php",
            "{$path}/{$template}.php",
          ];
        })
        ->concat([
          "{$template}.blade.php",
          "{$template}.php",
        ]);
    })
    ->filter()
    ->unique()
    ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates) {
  return \locate_template(filter_templates($templates));
}

function filter_alt_custom_logo($default) {
  if (($alt_logo = get_field('alternative_logo', 'options'))) {
    return $alt_logo;
  }
  return $default;
}

function alt_custom_logo() {
  add_filter('theme_mod_custom_logo', __NAMESPACE__ . '\\filter_alt_custom_logo');
  $html = get_custom_logo();
  remove_filter('theme_mod_custom_logo', __NAMESPACE__ . '\\filter_alt_custom_logo');
  return $html;
}

function opening_hours() {
  $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

  $field = get_field('regular_hours', 'options');
  $hours = [];
  if ($field && !empty($field)) {
    foreach ($field as $setting) {
      foreach ($setting['day'] as $day) {
        // $day = 'monday', $blocks = [['open'=>{time}, 'close'=>{time}]]

        $hours[$day] = isset($hours[$day]) ? array_merge($hours[$day], $setting['blocks']) : $setting['blocks'];

      }
    }

    // Sort blocks by start time
    // For now we ignore overlapping blocks. Ne moi problemy
    foreach ($hours as &$dayBlocks) {
      usort($dayBlocks, function ($a, $b) {
        if ($a['open'] < $b['open']) {
          return -1;
        } else if ($a['open'] > $b['open']) {
          return 1;
        }
        return 1;
      });
    }
    uksort($hours, function ($a, $b) use ($days) {
      $indexA = array_search($a, $days);
      $indexB = array_search($b, $days);

      if ($indexA === $indexB) {
        return 0;
      }

      return $indexA < $indexB ? -1 : 1;
    });
    // Sort days by day of week
  }

  $now = new \DateTimeImmutable("now", wp_timezone());

  $dayOfWeekKey = strtolower($now->format("l"));

  return [
    'days' => $hours,
    'todayKey' => $dayOfWeekKey,
    'today' => isset($hours[$dayOfWeekKey]) ? $hours[$dayOfWeekKey] : null,
  ];
}