<?php

namespace Onepage\Controller;

use Onepage\Model\Section;
use Onepage\View\Template;

class PageController {
    public function home() {
        $sections = Section::select()->get();

        $view = Template::make('example', compact('sections'));

    } 

}