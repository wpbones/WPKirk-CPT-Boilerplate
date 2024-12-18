<?php

namespace WPKirk\CustomTaxonomyTypes;

use WPKirk\WPBones\Foundation\WordPressCustomTaxonomyTypeServiceProvider as ServiceProvider;

class MyCustomTaxonomy extends ServiceProvider
{
  /**
   * Taxonomy key. Must not exceed 32 characters and may only contain
   * lowercase alphanumeric characters, dashes, and underscores. See sanitize_key().
   *
   * It's the `$taxonomy` parameter used in
   * `register_taxonomy( $taxonomy, $object_type, $args = array() )`
   *
   * @var string
   */
  protected $id = 'wp_kirk_tax';

  /**
   * Name for one object of this taxonomy. Default 'Tag'/'Category'.
   *
   * @var string
   */
  protected $name = 'ShipClass';

  /**
   * General name for the taxonomy, usually plural.
   * The same as and overridden by `$tax->label`. Default 'Tags'/'Categories'.
   *
   * @var string
   */
  protected $plural = 'ShipClasses';

  /**
   * Object type or array of object types with which the taxonomy should be associated.
   *
   * It's the `$object_type` parameter used in
   * `register_taxonomy( $taxonomy, $object_type, $args = array() )`
   *
   * @var string
   */
  protected $objectType = 'wp_kirk_startship';

  /**
   * Whether the taxonomy is hierarchical (e.g. category).
   * Defaults to false.
   *
   * @var bool
   */
  protected $hierarchical = true;
}
