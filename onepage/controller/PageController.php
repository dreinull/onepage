<?php

namespace Onepage\Controller;

use Onepage\Model\Section as SectionModel;
use Onepage\Model\Page;
use Onepage\Section;
use Onepage\View\Template;
use Onepage\View\SpecialCss;

class PageController {
    public function home() {
        //var_dump(Section::select()->get());
        
        $page = Page::select()->where('default', 1)->firstOrFail();
        //var_dump($page->id);
        $sectionsModels = SectionModel::select()->where('page_id', $page->id)->get();

        $sections = [];

        foreach ($sectionsModels as $model) {
            $sections[] = new Section($model);
        }

        $css = [];
        $specialCss = [];
        foreach($sections as $section) {

            if(!array_key_exists($section->template, $specialCss)) {
                $css[$section->template] = $section->css;
            }
            $specialCss[] = SpecialCss::getContent($section->template, $section->templateContent());
        }

        minifyCss(array_merge($css, $specialCss), app_style);

        //file_put_contents(app_style, implode($glue, $css) . $glue . implode($glue, $specialCss));

        $view = Template::make('page', compact('sections'));

    }

}