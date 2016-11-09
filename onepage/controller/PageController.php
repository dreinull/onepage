<?php

namespace Onepage\Controller;

use Onepage\Model\Section;
use Onepage\Model\Page;
use Onepage\View\Template;

class PageController {
    public function home() {
        //var_dump(Section::select()->get());
        
        $page = Page::select()->where('default', 1)->firstOrFail();
        //var_dump($page->id);
        $sections = Section::select()->where('page_id', $page->id)->get();

        $view = Template::make('page', compact('sections'));

    } 

}