<?php

namespace Onepage\View;

class Backend extends View {
    
    public static function create($content) {
        $view = new self;
        $view->addTemplate(
            $view->readTemplate('template.php')
        );
        $view->addContent($content);
        return $this;
    }
    
    public function readTemplate($name) {
        $file = createPath(admin_template_path, $name);
        if($file) {
            return file_get_contents($file);
        }
        return null;
    }
    
    public function addPages($pages) {
        foreach($pages as $page) {
            View::wrapContent()
        }
    }
    
}