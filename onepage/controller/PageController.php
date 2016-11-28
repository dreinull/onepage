<?php

namespace Onepage\Controller;

use Onepage\Model\Section;
use Onepage\Model\Page;
use Onepage\View\Template;
use Onepage\View\Css;
use Onepage\View\SpecialCss;

class PageController {
    public function home() {
        //var_dump(Section::select()->get());
        
        $page = Page::select()->where('default', 1)->firstOrFail();
        //var_dump($page->id);
        $sections = Section::select()->where('page_id', $page->id)->get();

        $css = [];
        $specialCss = [];
        foreach($sections as $section) {
            if(!array_key_exists($section->template, $specialCss)) {
                echo "\r\n<br>";
                $css[$section->template] = Css::getContent($section->template);
            }
            $specialCss[] = SpecialCss::getContent($section->template, sectionContent($section));
        }
        $glue = "\r\n";

        minifyCss(array_merge($css, $specialCss), app_style);

        //file_put_contents(app_style, implode($glue, $css) . $glue . implode($glue, $specialCss));

        $view = Template::make('page', compact('sections'));

    }

}