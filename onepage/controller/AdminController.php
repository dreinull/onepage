<?php

namespace Onepage\Controller;

class AdminController {
    public function index() {
        
        include createPath(admin_template_path, 'start.php');
    }
    
    public function page($id) {
        echo 'editing ' . $id;
    }
}