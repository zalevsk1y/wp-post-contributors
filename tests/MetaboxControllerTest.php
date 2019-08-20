<?php
use ContributorsPlugin\Controllers\MetaboxController;
use ContributorsPlugin\View\TemplateRender;
use Spatie\Snapshots\MatchesSnapshots;

class MetaboxControllerTest extends \WP_UnitTestCase{

    use MatchesSnapshots;
    public $users=[];
    public $controller;
    public $postId;
    public $contributors=[1,6];
    public function setUp(){
        parent::setUp();
        $roles=[
            'administrator',
            'author',
            'contributor',
            'subscriber'
        ];
        foreach($roles as $role){
            $this->users[]=['id'=>$this->factory->user->create(['role'=>$role]),'role'=>$role];
        }
        wp_set_current_user($this->users[0]['id']);
        $admin_template=__DIR__.'/mock/contributors-plugin-admin-template-mock.php';
        $post_template=__DIR__.'/../templates/contributors-plugin-post-template.php';
        $this->controller=new MetaboxController(new TemplateRender($admin_template),new TemplateRender($post_template));
        $this->postId=$this->factory->post->create(['post_author'=>$this->users[1]['id']]);
        $nonce=wp_create_nonce(CONTRIBUTORS_PLUGIN_NONCE_ACTION);
        $_POST[CONTRIBUTORS_PLUGIN_NONCE]=$nonce;
        $_POST[CONTRIBUTORS_PLUGIN_FIELD]=$this->contributors;
        do_action('save_post',$this->postId);
    }
    public function testSaveMetaData(){
        $meta=get_post_meta($this->postId, CONTRIBUTORS_PLUGIN_META, true);
        $this->assertEquals(implode(',',$this->contributors),$meta);
    }
    public function testRenderPostContributorsBox(){
       
        ob_start();
        $this->controller->renderPostContributorsBox(get_post($this->postId));
        $metabox=ob_get_contents();
        ob_end_clean();
        $this->assertMatchesSnapshot($metabox);
    }

}