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
    <?php wpkirk_section(__('Config Service Provider', 'wp-kirk')); ?>

    <?php wpkirk_code("@/config/plugin.php", [
      'line-numbers' => true,
      'line' => '76,87'
    ]) ?>

    <?php wpkirk_section(__('Custom Post Type Service Provider', 'wp-kirk')); ?>
    <?php wpkirk_code("@/plugin/CustomPostTypes/MyCustomPostType.php") ?>

    <?php wpkirk_section(__('Custom Taxonomy Type Service Provider', 'wp-kirk')); ?>
    <?php wpkirk_code("@/plugin/CustomTaxonomyTypes/MyCustomTaxonomy.php") ?>

  </div>

  <?php wpkirk_toc('Custom Post Type') ?>

</div>