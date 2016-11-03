<?php

namespace Onepage\Controller;

use Onepage\View\Backend;

class AdminController {
    public function index() {
        
        Backend::create();
    }
    
    public function page($id) {
        echo 'editing ' . $id;
    }
}