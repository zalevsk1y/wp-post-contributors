<?php
namespace ContributorsPlugin\Controllers;

use ContributorsPlugin\View\TemplateRender;
use ContributorsPlugin\Exception\MyException;
/**
 * Class manage metabox functions 
 *
 * @package Menu
 * @author  Evgeniy S.Zalevskiy <2600@ukr.net>
 * @license MIT
 */

class MetaboxController
{   protected $postTemplate;
    protected $adminTemplate;
    public function __construct(TemplateRender $adminTemplate,TemplateRender $postTemplate)
    {
        $this->adminTemplate = $adminTemplate;
        $this->postTemplate = $postTemplate;
        $this->addActions();
    }
    /**
     * Add WP actions 
     *
     * @return void
     */
    public function addActions()
    {
        \add_action('save_post', array($this, 'saveMetaData'));
        \add_action('the_content',array($this,'renderPost'));
        \add_action('add_meta_boxes', array($this, 'addContributorsBox'));
    }
    /**
     *  Save contributors data to post meta
     *
     * @param int $post_id 
     * @return void
     */
    public function saveMetaData($post_id)
    {
        try{
            $this->autosaveCheck()->havePermission($post_id);
        }catch(MyException $e){
            return $e->getMessage();
        }
        if (isset($_POST[CONTRIBUTORS_PLUGIN_FIELD])) {
            $contributors = sanitize_meta(CONTRIBUTORS_PLUGIN_META, $_POST[CONTRIBUTORS_PLUGIN_FIELD], 'post');

            if (isset($contributors) && $contributors != '') {
                update_post_meta($post_id, CONTRIBUTORS_PLUGIN_META, implode(",", $contributors));
            } else {
                update_post_meta($post_id, CONTRIBUTORS_PLUGIN_META, '');
            }
        }
    }
    /**
     * Check is save action is autosave
     *
     * @return object $this for chain building
     */
    protected function autosaveCheck(){
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            throw new MyException('Autosave');
        }
        return $this;
    }
    /**
     * Check if user have permission to modify post 
     *
     * @param int $post_id
     * @return object $this for chain building
     */
    protected function havePermission($post_id)
    {
        if (!isset($_POST[CONTRIBUTORS_PLUGIN_NONCE])) {
            throw new MyException(__('Nonce field did not set.',CONTRIBUTORS_PLUGIN_SLUG));
        }

        $nonce = $_POST[CONTRIBUTORS_PLUGIN_NONCE];
        if (!wp_verify_nonce($nonce, CONTRIBUTORS_PLUGIN_NONCE_ACTION)) {
            throw new MyException(__('Nonce is not verified',CONTRIBUTORS_PLUGIN_SLUG));
        }

        if (!current_user_can('edit_post', $post_id)) {
            throw new MyException(__('You have no rights to edit this post',CONTRIBUTORS_PLUGIN_SLUG));
        }
        return $this;

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
            $user=\get_userdata(intval($id));
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
    public function renderPost($content){
        global $post;
        $meta_data = get_post_meta( $post->ID, CONTRIBUTORS_PLUGIN_META, true );
        if($meta_data == '') return $content;
        $contributors = explode( ",", $meta_data );
        $user_data=[];
        foreach ($contributors as $contributor){
            $contributor_data =get_userdata( $contributor );
            $user_data[] =(object)array(
              'nickname'=>esc_html( $contributor_data->nickname ),
               'link'=>esc_url(get_author_posts_url( $contributor_data->ID )),
               'avatar_tag'=>get_avatar( $contributor, 40 )
            ); 
        }
        $contributors_box=$this->postTemplate->render(array('contributors'=>$user_data));
        return $content.$contributors_box;
		
    }
}
