<?php

namespace Onepage\View;

use Onepage\View\Interpreter\Interpreter;

class Helper extends View {
    
    
    public function readTemplate($name) {
        $file = createPath(helper_template_path, $name);
        if($file) {
            return file_get_contents($file);
        }
        return null;
    }
    
    public static function wrapContent($content, $template) {
        self::create()
            ->addTemplate(readTemplate($template))
            ->addContent($content)
            ->render();
    }
    
    public static function loopContent($contents, $template) {
        $interpreter = new Interpreter();
        
    }
    
}