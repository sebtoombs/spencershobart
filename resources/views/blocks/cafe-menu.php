<?php
/**
 * Section highlight template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'cafe-menu-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$classes = [];
if (!empty($block['className'])) {
//$classes .= sprintf(' %s', $block['className']);
  $classes[] = $block['className'];
}

if ($is_preview) {
  $classes[] = 'is_block_preview';
}

// Load custom field values.
$post = get_field('post');

$classString = implode(' ', $classes);

$title = $post ? get_the_title($post) : null;
$content = $post ? get_the_content(null, false, $post) : null;
?>

<div class="block-cafe_menu <?php echo esc_attr($classString); ?>" id="<?php echo $id; ?>">
  <?php if ($is_preview): ?>
  <p>Menu: <strong><?php echo $post ? $title : 'Not set'; ?></strong></p>
  <?php elseif ($post): ?>
  <?php echo $content; ?>
  <?php endif;?>
</div>