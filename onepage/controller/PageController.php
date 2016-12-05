<?php

namespace Onepage\Controller;

use Onepage\Model\Section as SectionModel;
use Onepage\Model\Page;
use Onepage\Section;
use Onepage\View\Template;
use Onepage\View\SpecialCss;

class PageController {
    public function home() {
        
        $page = Page::select()->where('default', 1)->firstOrFail();
        $this->buildPage($page);
    }
        
    public function page($slug) {
        $page = Page::select()->where('slug', $slug)->firstOrFail();
        $this->buildPage($page);

    }

    private function buildPage($page) {
        $fileName = $page->slug . '.html';
        $templateFile = createPath(cache_path, $fileName);
        
        if($templateFile !== false) {
            echo file_get_contents($templateFile);
        } else {
            $this->createHtmlFile($page, $fileName);
        }

        if(app_style === false) {
            $this->createCssFile();
        }

        
    }

    private function createHtmlFile($page, $fileName) {
        $sectionModels = SectionModel::select()
            ->where('page_id', $page->id)
            ->get();

        $sections = [];

        foreach ($sectionModels as $model) {
            $sections[] = new Section($model);
        }
        ob_start();
        Template::make('page', compact('sections'));
        $html = ob_get_clean();
        file_put_contents(cache_path . DIRECTORY_SEPARATOR . $fileName, $html);
        echo $html;
    }

    private function createCssFile() {
        $sections = SectionModel::select()->get();
        $file = component_path . DIRECTORY_SEPARATOR .  'css' . DIRECTORY_SEPARATOR . 'main.css';
        $css = [];
        $specialCss = [];
        foreach($sections as $section) {

            if(!array_key_exists($section->template, $specialCss)) {
                $css[$section->template] = $section->css;
            }
            $specialCss[] = SpecialCss::getContent($section->template, $section->templateContent());
        }
        minifyCss(array_merge($css, $specialCss), $file);
    }
}