<?php

namespace ContributorsPlugin\View;

/**
 * Class loading template file and render it with args.
 *
 * @author  Evgeniy S.Zalevskiy <2600@ukr.net>
 * @license MIT https://opensource.org/licenses/MIT
 */
class TemplateRender
{
    protected $path;
    protected $args;
    public function __construct(string $template_path, array $args = [])
    {
        if (!file_exists($template_path)) {
            throw new \Exception('Cannot load template file ' . $template_path);
        }
        $this->path = $template_path;
        $this->args = $args;
    }
    /**
     * Render template.
     *
     *
     * @return void
     */
    
    public function render(array $args = [])
    {
        if (count($this->args) > 0) {
            foreach ($this->args as $key => $item) {
                ${$key} = $item;
            }
        }
        if (count($args) > 0) {
            foreach ($args as $key => $item) {
                ${$key} = $item;
            }
        }
        ob_start();
        include $this->path;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
