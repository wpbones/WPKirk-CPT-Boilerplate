# WPKirk-CPT-Boilerplate

Focused demo of **Custom Post Types + Custom Taxonomies** in WP Bones — declared as service
provider classes with declarative properties (no `register_post_type()` boilerplate). Use this
when your plugin needs first-class WordPress content modeling.

## What this demos

Two service providers registered via `config/plugin.php`:

- `plugin/CustomPostTypes/MyCustomPostType.php` — declares a `Starship` post type (id
  `wp_kirk_startship`) by extending `WordPressCustomPostTypeServiceProvider` and setting class
  properties for labels, supports, public visibility, rewrite rules.
- `plugin/CustomTaxonomyTypes/MyCustomTaxonomy.php` — declares a `ShipClass` taxonomy
  (id `wp_kirk_tax`) tied to the starship post type, via `WordPressCustomTaxonomyTypeServiceProvider`.

**Key files to read first:**

| File | What to look at |
| --- | --- |
| `plugin/CustomPostTypes/MyCustomPostType.php` | Post type declaration: `$id`, `$name`, `$plural`, `$supports`, labels |
| `plugin/CustomTaxonomyTypes/MyCustomTaxonomy.php` | Taxonomy declaration: `$id`, `$objectType`, labels |
| `config/plugin.php` | Registers both providers under `custom_post_types` / `custom_taxonomy_types` |
| `plugin/Http/Controllers/Dashboard/DashboardController.php` | Admin dashboard showing the CPT docs |

## Smoke test (manual, ~30s)

With the plugin active:

1. Log in to `wp-admin` — the sidebar should show a **Starship** menu (the custom post type).
2. Click **Starship → All Starships** → the standard WP list table appears (empty at first).
3. Click **Add New**, title + content, optionally assign a **ShipClass** term, Publish.
4. Visit the public archive: `http://your-site.test/?post_type=wp_kirk_startship`.
5. `wp-content/debug.log` should stay clean.

If the menu doesn't appear: flush rewrite rules (`wp rewrite flush --path=...`) or
deactivate/reactivate the plugin.

## Use as a template

```sh
# 1. clone from the GitHub template
gh repo create my-cpt-plugin --template wpbones/WPKirk-CPT-Boilerplate --public --clone
cd my-cpt-plugin

# 2. rename the PHP namespace + plugin slug
composer install
php bones rename "My CPT Plugin"

# 3. build + activate
yarn install && yarn build
wp plugin activate my-cpt-plugin
```

Generate additional CPTs / taxonomies with `php bones make:cpt <Name>` and
`php bones make:ctt <Name>`. Register them in `config/plugin.php` under `custom_post_types` /
`custom_taxonomy_types` arrays.

## Framework surface exercised

This boilerplate is the **regression bed** for the content-modeling layer:

- `WPKirk\WPBones\Foundation\WordPressCustomPostTypeServiceProvider` — registers `init`
  hook, translates class properties to `register_post_type()` args
- `WPKirk\WPBones\Foundation\WordPressCustomTaxonomyTypeServiceProvider` — same for
  `register_taxonomy()`
- `config/plugin.php` → `Plugin::registerProviders()` wiring both into the boot lifecycle
- `php bones make:cpt` / `make:ctt` code generators (stubs from `WPBones/src/Console/stubs/`)
