<?php
namespace ContributorsPlugin\Controllers;

use ContributorsPlugin\View\TemplateRender;

class MetaboxController
{   protected $postTemplate;
    protected $adminTemplate;
    public function __construct(TemplateRender $adminTemplate,TemplateRender $postTemplate)
    {
        $this->adminTemplate = $adminTemplate;
        $this->postTemplate = $postTemplate;
        $this->addActions();
    }
    public function addActions()
    {
        \add_action('save_post', array($this, 'saveMetaData'));
        \add_action('the_content',array($this,'renderPost'));
    }
    public function saveMetaData($post_id)
    {
        if (!$this->havePermission($post_id)) {
            return $post_id;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
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
    protected function havePermission($post_id)
    {
        if (!isset($_POST[CONTRIBUTORS_PLUGIN_NONCE])) {
            return false;
        }

        $nonce = $_POST[CONTRIBUTORS_PLUGIN_NONCE];
        if (!wp_verify_nonce($nonce, CONTRIBUTORS_PLUGIN_NONCE_ACTION)) {
            return false;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return false;
        }
        return true;

    }
    public function renderPostContributorsBox($post)
    {
        $contributorsIds = get_post_meta($post->ID, CONTRIBUTORS_PLUGIN_META, true);
        $args = array('authors' => get_users('orderby=nicename'));
        if (!empty($contributorsIds)) {
            $contributorsIds = explode(',', $contributorsIds);
            $args['contributors'] = $this->getContributorsData($args['authors'], $contributorsIds);
        }

        wp_nonce_field(CONTRIBUTORS_PLUGIN_NONCE_ACTION, CONTRIBUTORS_PLUGIN_NONCE);

        echo $this->adminTemplate->render($args);
    }
    protected function getContributorsData(array $authors, array $contributorsId = array(1))
    {
        $contributors = array();
        foreach ($authors as $author) {
            if (in_array($author->ID, $contributorsId)) {
                $contributors[] = (object) array(
                    'ID' => $author->ID,
                    'nickname' => $author->nickname,

                );
            }
        }
        return $contributors;
    }
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
