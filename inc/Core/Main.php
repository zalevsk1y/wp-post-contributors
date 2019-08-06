<?php
namespace ContributorsPlugin\Core;

use ContributorsPlugin\Controllers\MetaboxController;

class Main
{
    protected $sreen = 'post';
    protected $metabox;
    public function __construct(MetaboxController $metabox)
    {
        $this->metabox = $metabox;
        $this->addActions();

    }
    protected function addActions()
    {
        add_action('add_meta_boxes', array($this, 'addContributorsBox'));
        add_action('admin_enqueue_scripts', array($this, 'setStyles'));
    }
    public function setStyles($hook)
    {
        if ($hook == 'post.php') {

            \wp_enqueue_style(CONTRIBUTORS_PLUGIN_SLUG . '-style', CONTRIBUTORS_PLUGIN_URL . '/public/css/plugin-custom-styles.css');
            \wp_enqueue_style(CONTRIBUTORS_PLUGIN_SLUG . '-fonts', CONTRIBUTORS_PLUGIN_URL . '/public/css/font.css');
            wp_enqueue_script(CONTRIBUTORS_PLUGIN_SLUG . '-script', CONTRIBUTORS_PLUGIN_URL . '/public/js/contributor-script.js');
        }

    }
    public function addContributorsBox()
    {
        add_meta_box(
            'post_author_meta',
            __('Contributors'),
            array($this->metabox, 'renderPostContributorsBox'),
            'post',
            'side',
            'high'
        );
    }
    

}
