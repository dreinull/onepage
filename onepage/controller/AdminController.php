<?php

namespace Onepage\Controller;

use Onepage\Model\Page;
use Onepage\Model\Section;
use Onepage\View\Backend;
use Onepage\Request;

class AdminController {
    public function index() {
        $pages = Page::select()->get();
        Backend::make('home', compact('pages'));
    }

    public function options() {
        Backend::make('options');
    }

    public function optionsPost() {

    }

    public function addPage() {
        Backend::make('add-page');
    }

    public function addPagePost() {
        Page::create(Request::all());
    }
    
    public function page($id) {
        $page = Page::findOrFail($id);
        $sections = Section::select()->where('page_id', $page->id)->get();
        Backend::make('page', compact('page', 'sections'));

    }

    public function apiFieldUpdate($id) {
        $field = Request::all();
        $model = '\Onepage\Model\Content\\' . ucfirst($field['type']) . 'Content';
        file_put_contents(__DIR__ . '/filename.txt', print_r($model , true));
        if(!class_exists($model)) {echo 'return false'; return false;}
        $t = $model::select()
            ->where('section_id', $field['section'])
            ->where('key', $field['field'])
            ->updateOrCreate(['value' => $field['value']]);
    }
}