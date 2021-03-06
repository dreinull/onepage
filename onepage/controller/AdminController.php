<?php

namespace Onepage\Controller;

use Onepage\Model\Image;
use Onepage\Model\Page;
use Onepage\Model\Section;
use Onepage\View\Backend;
use Onepage\Request;
use Onepage\User;
use Onepage\View\ImageSelect;

class AdminController {
    public function __construct() {
        User::access();
    }

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
        $sections = \Onepage\Section::getAllForPage($page->id);
        $availableSections = getAllSections();
        Backend::make('page', compact('page', 'sections', 'availableSections'));

    }

    public function apiFieldUpdate($id) {
        $field = Request::all();
        $model = '\Onepage\Model\\' . ucfirst($field['type']) . 'Content';
        file_put_contents(__DIR__ . '/filename.txt', print_r($model , true));
        if(!class_exists($model)) { return false; }
        $t = $model::select()
            ->where('section_id', $field['section'])
            ->where('key', $field['key'])
            ->updateOrCreate(['value' => $field['value']]);
    }

    public function sectionPost() {
        $request = Request::all();
        Section::create($request);
        redirect(route(admin-page, $request['page']));
    }

    public function apiSectionOrder() {
        $order = Request::input('data');
        $i = 1;
        foreach($order as $sectionId) {
            Section::select()->where('id', ltrim($sectionId, 's'))->update(['order' => $i]);
            $i++;
        } 
    }

    public function apiSectionRename() {
        $request = Request::only(['section', 'value']);
        Section::select()
            ->where('id', $request['section'])
            ->update(['name' => $request['value']]);
    }

    public function apiImageSelect() {
        $images = Image::select()->get();
        ImageSelect::make(null, compact('images'));
    }
}