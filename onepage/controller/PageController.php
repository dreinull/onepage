<?php

namespace Onepage\Controller;

use Onepage\Model\Section;
use Onepage\View\Frontend;

class PageController {
    public function home() {
        $sections = Section::select()->get();
        $view = new Frontend($sections);

    } 

}