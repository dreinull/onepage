<?php

namespace Onepage\Controller;

class AdminController {
    public function index() {
        
        $template = createPath(admin_template_path, 'start.php');
        $content = 'Hier ist mein Content';
        echo \Onepage\View\Interpreter\Interpreter::run($template, compact('content'));
    }
    
    public function page($id) {
        echo 'editing ' . $id;
    }
}