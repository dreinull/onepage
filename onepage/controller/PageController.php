<?php

namespace Onepage\Controller;

use Onepage\Model\Section;
use Onepage\View\View;

class PageController {
    public function home() {
        $sections = Section::select()->get();
        $view = new View($sections);

    } 

}