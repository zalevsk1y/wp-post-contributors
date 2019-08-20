<?php
/*
Plugin Name: wp-post-contributors
Plugin URI: https://github.com/zalevsk1y/wp-post-contributors
Description: Add contributors to the post..
Version: 1.0.0
Author: Evgeny S.Zalevskiy <2600@ukr.net>
Author URI: https://github.com/zalevsk1y/
License: MIT
 */
?>
<?php
namespace ContributorsPlugin;

if (!defined("ABSPATH")) {
    exit;
}

define("CONTRIBUTORS_PLUGIN_SLUG", "wp-post-contributors");
define("CONTRIBUTORS_PLUGIN_NAMESPACE", "ContributorsPlugin");
define("CONTRIBUTORS_PLUGIN_DIR", plugin_dir_path(__FILE__));
define("CONTRIBUTORS_PLUGIN_URL", plugins_url("", __FILE__));
define("CONTRIBUTORS_PLUGIN_NONCE", "wp_contributors_plugin_nonce");
define("CONTRIBUTORS_PLUGIN_NONCE_ACTION", "wp_contributors_plugin_nonce_action");
define("CONTRIBUTORS_PLUGIN_INPUT_FIELD", "wp_contributors_plugin_value[]");
define("CONTRIBUTORS_PLUGIN_FIELD", "wp_contributors_plugin_value");
define("CONTRIBUTORS_PLUGIN_META", "_wp_contributors_plugin");

require_once "autoload.php";
$adminTemplatePath = apply_filters("contributors_plugin_admin_template", CONTRIBUTORS_PLUGIN_DIR . "/templates/contributors-plugin-admin-template.php");
$postTemplatePath = apply_filters("contributors_plugin_post_template", CONTRIBUTORS_PLUGIN_DIR . "/templates/contributors-plugin-post-template.php");
$modules = [];
$modules["adminTemplate"] = new View\TemplateRender($adminTemplatePath);
$modules["postTemplate"] = new View\TemplateRender($postTemplatePath);
$modules["metabox"] = new Controllers\MetaboxController($modules["adminTemplate"], $modules["postTemplate"]);
$modules["main"] = new Core\Main();
