<?php
use ContributorsPlugin\View\TemplateRender;
use Spatie\Snapshots\MatchesSnapshots;

class TemplateRendreTest extends \WP_UnitTestCase{
    use MatchesSnapshots;
    public  function test_wrong_template_path(){

    }
    public function test_render(){
        $path=__DIR__.'/mock/testRenderMock.php';
        $template=new TemplateRender($path);
        $args=array(
            'test1'=>'test1',
            'test2'=>'test2',
            'test3'=>'test3',
            'test4'=>'test4'
        );
        $this->assertMatchesSnapshot($template->render($args));
    }
}