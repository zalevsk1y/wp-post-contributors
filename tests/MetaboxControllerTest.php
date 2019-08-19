<?php
use ContributorsPlugin\Controllers\MetaboxController;
use ContributorsPlugin\View\TemplateRender;
use Spatie\Snapshots\MatchesSnapshots;

class MetaboxControllerTest extends \WP_UnitTestCase{

    use MatchesSnapshots;
    public $users=[];
    public $controller;
    public $postId;
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
        $admin_template=__DIR__.'/../templates/contributors-plugin-admin-template.php';
        $post_template=__DIR__.'/../templates/contributors-plugin-post-template.php';
        $this->controller=new MetaboxController(new TemplateRender($admin_template),new TemplateRender($post_template));
        $this->postId=$this->factory->post->create(['post_author'=>$this->users[1]['id']]);
        $nonce=wp_create_nonce(CONTRIBUTORS_PLUGIN_NONCE_ACTION);
        $_POST[CONTRIBUTORS_PLUGIN_NONCE]=$nonce;
        
       
    }
    public function testSaveMetaData(){
        $_POST[CONTRIBUTORS_PLUGIN_FIELD]=[1,2];
        do_action('save_post',$this->postId);
        $meta=get_post_meta($this->postId, CONTRIBUTORS_PLUGIN_META, true);
        $this->assertEquals('1,2',$meta);
    }


}