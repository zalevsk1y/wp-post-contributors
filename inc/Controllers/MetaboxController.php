<?php
namespace ContributorsPlugin\Controllers;

use ContributorsPlugin\Exception\MyException;
use ContributorsPlugin\View\TemplateRender;

/**
 * Class manage metabox functions.
 *
 * PHP version 5.6
 *
 * @package Menu
 * @author  Evgeniy S.Zalevskiy <2600@ukr.net>
 * @license MIT
 */

class MetaboxController
{
    /**
     * Template file path for post contributors box template
     *
     * @var ContributorsPlugin\View\TemplateRender
     */
    protected $postTemplate;
    /**
     * Template file path for admin select contributors box template
     *
     * @var ContributorsPlugin\View\TemplateRender
     */
    protected $adminTemplate;
    public function __construct(TemplateRender $adminTemplate, TemplateRender $postTemplate)
    {
        $this->adminTemplate = $adminTemplate;
        $this->postTemplate = $postTemplate;
        $this->addActions();
    }
    /**
     * Add WP actions.
     *
     * @return void
     */
    public function addActions()
    {
        \add_action('save_post', array($this, 'saveMetaData'));
        \add_action('the_content', array($this, 'renderPost'));
        \add_action('add_meta_boxes', array($this, 'addContributorsBox'));
    }
    /**
     *  Save contributors data to post meta.
     *
     * @param int $post_id Id of post.
     * @return void|string
     */
    public function saveMetaData($post_id)
    {
        $result_of_permission_check=$this->havePermission($post_id);
        if($this->autosaveCheck()||is_wp_error($result_of_permission_check)){
            return ;
        }
        if (isset($_POST[CONTRIBUTORS_PLUGIN_FIELD])) {
            $contributors = sanitize_meta(CONTRIBUTORS_PLUGIN_META, $_POST[CONTRIBUTORS_PLUGIN_FIELD], 'post');

            if (isset($contributors) && '' !== $contributors) {
                update_post_meta($post_id, CONTRIBUTORS_PLUGIN_META, implode(",", $contributors));
            } else {
                update_post_meta($post_id, CONTRIBUTORS_PLUGIN_META, '');
            }
        }
    }
    /**
     * Check is save action is autosave
     *
     * @return bool 
     */
    public function autosaveCheck()
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return true;
        }
        return false;
    }
    /**
     * Check if user have permission to modify post
     *
     * @param int $post_id
     * @return object $this for chain building
     */
    public function havePermission($post_id)
    {
        if (!isset($_POST[CONTRIBUTORS_PLUGIN_NONCE])) {
            return new \WP_Error(__('Nonce field did not set.',CONTRIBUTORS_PLUGIN_SLUG));
        }
        // there is no need to sanitize nonce data because nonce verification is simple a String comparison
        $nonce = $_POST[CONTRIBUTORS_PLUGIN_NONCE];
        if (!wp_verify_nonce($nonce, CONTRIBUTORS_PLUGIN_NONCE_ACTION)) {
            return new \WP_Error(__('Nonce is not verified.',CONTRIBUTORS_PLUGIN_SLUG));
        }

        if (!current_user_can('edit_post', $post_id)) {
            return new \WP_Error(__('You have no rights to edit this post.',CONTRIBUTORS_PLUGIN_SLUG));
            
        }
        return false;
    }
    /**
     * Render view for post-edit page that allow to add and remove contributors
     *
     * @param int $post
     * @return void
     */
    public function renderPostContributorsBox($post)
    {
        $contributorsIds = get_post_meta($post->ID, CONTRIBUTORS_PLUGIN_META, true);
        $args = array('authors' => get_users('orderby=nicename'));
        if (!empty($contributorsIds)) {
            $contributorsIds = explode(',', $contributorsIds);
            $args['contributors'] = $this->getContributorsData($contributorsIds);
        }

        echo $this->adminTemplate->render($args);
    }
    /**
     * Add metabox "Contributors" to "post_author_meta".Used in add action
     *
     * @return void
     */
    public function addContributorsBox()
    {
        add_meta_box(
            'post_author_meta',
            __('Contributors'),
            array($this, 'renderPostContributorsBox'),
            'post',
            'side',
            'high'
        );
    }

    /**
     * Get contributors nickname by id
     *
     * @param array $contributorsId  array of user ids that marked as contributors
     * @return array of stdClass objects with contributors id and nickname
     */

    protected function getContributorsData($contributorsId)
    {
        $contributors = array();
        foreach ($contributorsId as $id) {
            $user = \get_userdata(intval($id));
            if ($user) {
                $contributors[] = (object) array(
                    'ID' => $user->ID,
                    'nickname' => $user->nickname,
                );
            }
        }
        return $contributors;
    }
    /**
     * Render contributors list to add to the post content
     *
     * @param string $content post content
     * @return string
     */
    public function renderPost($content)
    {
        $meta_data = get_post_meta(get_the_ID(), CONTRIBUTORS_PLUGIN_META, true);
        if ($meta_data == '') {
            return $content;
        }
        $contributors = explode(",", $meta_data);
        $user_data = [];
        foreach ($contributors as $contributor) {
            $contributor_data = get_userdata($contributor);
            if (!$contributor_data) {
                continue;
            }
            $user_data[] = (object) array(
                'nickname' => esc_html($contributor_data->nickname),
                'link' => esc_url(get_author_posts_url($contributor_data->ID)),
                'avatar_tag' => get_avatar($contributor, 40),
            );
        }
        $contributors_box = $this->postTemplate->render(array('contributors' => $user_data));
        return $content . $contributors_box;
    }
}
