<?php

namespace Onepage\Controller;

use Onepage\Model\Page;
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
        Page::create(Request::only(['name', 'slug']));
        Page::select()->run();
    }
    
    public function page($id) {
        echo 'editing ' . $id;
    }
}