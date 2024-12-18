<?php
// in $startship you will have the post object

if (!defined('ABSPATH')) exit;
?>

<h3>
  <?php _e('Starship Code for the Startship with id', 'wp-kirk'); ?>
  <?php echo $starship->ID ?>
</h3>

<label><?php esc_attr_e('Starship Code', 'wp-kirk'); ?>:
  <?php WPKirk\Html::input()
    ->name('wp_kirk_startship_code_name')
    ->value($starship->wp_kirk_startship_code_name)
    ->render(); ?>
</label>