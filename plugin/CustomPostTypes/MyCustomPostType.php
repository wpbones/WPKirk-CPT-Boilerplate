<?php

namespace WPKirk\CustomPostTypes;

use WPKirk\WPBones\Foundation\WordPressCustomPostTypeServiceProvider as ServiceProvider;

class MyCustomPostType extends ServiceProvider
{
  /**
   * Post type key. Must not exceed 20 characters and may only contain
   * lowercase alphanumeric characters, dashes, and underscores. See sanitize_key().
   *
   * `register_post_type( $post_type, $args = array() )`
   *
   * @var string
   */
  protected $id = 'wp_kirk_startship';

  /**
   * Name of the post type shown in the menu. Usually plural.
   * You may also set up this property in the `boot` method.
   *
   * @var string
   */
  protected $name = 'Starship';

  /**
   * Name of the post type shown in the menu as plural.
   * You may also set up this property in the `boot` method.
   *
   * @var string
   */
  protected $plural = 'Starships';

  /**
   * Whether a post type is intended for use publicly either via the admin interface or by front-end users.
   * Defaults to false.
   * While the default settings of exclude_from_search, publicly_queryable, show_ui, and show_in_nav_menus are
   * inherited from public, each does not rely on this relationship and controls a very specific intention.
   *
   * @var bool
   */
  protected $public = true;

  /**
   * Sets the query_var key for this post type. Defaults to $post_type key
   * If false, a post type cannot be loaded at ?{query_var}={post_slug}
   * If specified as a string, the query ?{query_var_string}={post_slug} will be valid.
   *
   * @var string
   */
  protected $queryVar = 'wp_kirk_startship';

  /**
   * The url to the icon to be used for this menu. Defaults to use the posts icon.
   * Pass a base64-encoded SVG using a data URI, which will be colored to match the color scheme.
   * This should begin with 'data:image/svg+xml;base64,'.
   * Pass the name of a Dashicons helper class to use a font icon, e.g. 'dashicons-piechart'.
   * Pass 'none' to leave div.wp-menu-image empty so an icon can be added via CSS.
   *
   * @var string
   */
  protected $menuIcon = 'dashicons-universal-access-alt';

  /**
   * Whether to exclude posts with this post type from front end search results.
   * If not set, the opposite of public's current value is used.
   *
   * @var bool
   */
  protected $excludeFromSearch = false;

  /**
   * Whether to use the internal default meta capability handling. Defaults to false.
   *
   * @var bool
   */
  protected $mapMetaCap = true;

  /**
   * To specify rewrite rules, an array can be passed with any of these keys
   *
   *   'slug' => string Customize the permastruct slug. Defaults to $post_type key
   *   'with_front' => bool Should the permastruct be prepended with WP_Rewrite::$front. Defaults to true.
   *   'feeds' => bool Should a feed permastruct be built for this post type. Inherits default from has_archive.
   *   'pages' => bool Should the permastruct provide for pagination. Defaults to true.
   *   'ep_mask' => const Assign an endpoint mask.
   *
   * If not specified and permalink_epmask is set, inherits from permalink_epmask.
   * If not specified and permalink_epmask is not set, defaults to EP_PERMALINK
   *
   * @return array
   */
  protected $rewrite = [
    'slug' => 'startship',
    'with_front' => true,
    'pages' => true,
    'ep_mask' => EP_PERMALINK,
  ];

  /*
  |--------------------------------------------------------------------------
  | Boot and override methods
  |--------------------------------------------------------------------------
  |
  */

  /**
   * You may override this method in order to register your own actions and filters.
   */
  public function boot()
  {
    // To do...
  }

  /**
   * You may override this method in order to register your own supports.
   *
   * @param array $defaults Default supports
   *
   * @since 1.9.0
   * @return array
   */
  public function registerSupports($defaults)
  {
    // You may override this method
    return ['title', 'editor'];
  }

  /**
   * Register post meta
   */
  public function registerPostMeta()
  {
    // You may override this method
    // see register_post_meta()
    return [
      'wp_kirk_startship_code_name' => [
        'single' => true,
        'show_in_rest' => true,
        'type' => 'string',
      ]
    ];
  }

  /**
   * This action is called when you can add the meta box
   */
  public function registerMetaBoxes()
  {
    return [
      [
        'id' => 'wp_kirk_startship_code_name',
        'title' => __('Starship Code', 'wp-kirk'),
        'view' => [$this, 'metaBoxStartshipCodeView'],
        'context' => 'normal',
        'priority' => 'high',
      ]
    ];
  }

  /**
   * This method is called by the meta box
   */
  public function metaBoxStartshipCodeView($post)
  {
    echo WPKirk()->view('cpt.code')->with('starship', $post);
  }

  /**
   * Override this method to save/update your custom data.
   * This method is called by hook action save_post_{post_type}`.
   *
   * @param int|string $post_id Post ID
   * @param object	 $post	Optional. Post object
   */
  public function update($post_id, $post)
  {
    // Sanitize the user input.
    $wp_kirk_startship_code_name = isset($_POST['wp_kirk_startship_code_name']) ? sanitize_text_field($_POST['wp_kirk_startship_code_name']) : '';

    // Collect the meta data
    $meta = [
      'wp_kirk_startship_code_name' => $wp_kirk_startship_code_name,
    ];

    // Save the meta data
    foreach ($meta as $key => $value) {
      update_post_meta($post_id, $key, $value);
    }
  }

  /**
   * You may override this method in order to register your own columns.
   *
   * @param array $columns
   *
   * @since 1.8.2
   *
   * @return array
   */
  public function registerColumns($columns)
  {
    return [
      [
        'id' => 'wp_kirk_startship_code_name',
        'title' => __('Starship Code', 'wp-kirk'),
      ]
    ];
  }

  /**
   * This action is called when you can add the column content
   */
  public function columnContent($column_id, $value, $post)
  {
    error_log("columnContent: {$column_id} - {$value}");

    if ($column_id === 'wp_kirk_startship_code_name') {
      echo "[{$value}]";
    }
  }

  /**
   * Return the placeholder title.
   * You may override this method to return your own placeholder title.
   *
   * @param string $placeholder Default 'Enter title here'.
   *
   * @return string
   */
  public function registerPlaceholderTitle($placeholder)
  {
    return __('Enter Starship Name', 'wp-kirk');
  }

  /**
   * Add content after title
   *
   * @since 1.9.0
   * @return void
   */
  public function registerAfterTitleView()
  {
    global $post;

    echo WPKirk()->view('cpt.after-title')->with('starship', $post);
  }
}
