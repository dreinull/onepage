<?php

namespace Onepage\Controller;

use Onepage\Model\Section;

class HomeController {
    public function home() {
        $sections = Section::select()->get();
        var_dump($sections); die();
        include(template_path . '/page.php');
    } 

}