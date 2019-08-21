<?php
namespace ContributorsPlugin\Core;

/**
 * Class add
 *
 * @package Menu
 * @author  Evgeniy S.Zalevskiy <2600@ukr.net>
 * @license MIT
 */

class Main
{
    protected $sreen = 'post';
    protected $metabox;
    public function __construct()
    {

        $this->addActions();
    }
    /**
     * Add wp action hook
     *
     * @return void
     */
    protected function addActions()
    {

        add_action('admin_enqueue_scripts', array($this, 'setStyles'));
    }
    /**
     * Add styles
     *
     * @param string $hook
     * @return void
     */
    public function setStyles($hook)
    {
        if ($hook == 'post.php') {
            \wp_enqueue_style(CONTRIBUTORS_PLUGIN_SLUG . '-style', CONTRIBUTORS_PLUGIN_URL . '/public/css/plugin-custom-styles.css');
            \wp_enqueue_style(CONTRIBUTORS_PLUGIN_SLUG . '-fonts', CONTRIBUTORS_PLUGIN_URL . '/public/css/font.css');
            wp_enqueue_script(CONTRIBUTORS_PLUGIN_SLUG . '-script', CONTRIBUTORS_PLUGIN_URL . '/public/js/contributor-script.js');
        }
    }
}
