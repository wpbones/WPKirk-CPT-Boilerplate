<!--
 |
 | In $plugin you'll find an instance of Plugin class.
 | If you'd like can pass variable to this view, for example:
 |
 | return PluginClassName()->view( 'dashboard.index', [ 'var' => 'value' ] );
 |
-->

<?php ob_start() ?>

<div class="wp-kirk wrap wp-kirk-sample">

  <div class="wp-kirk-toc-content">
    <?php wpkirk_section(__('Config Menu', 'wp-kirk')); ?>

    <?php wpkirk_code("@/config/menus.php", [
      'line-numbers' => true,
      'line' => '34'
    ]) ?>

    <?php wpkirk_section(__('Controller', 'wp-kirk')); ?>
    <?php wpkirk_code("@/plugin/Http/Controllers/Dashboard/SettingsController.php") ?>

  </div>

  <?php wpkirk_toc('CPT Settings') ?>

</div>