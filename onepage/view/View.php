<?php

namespace Onepage\View;

abstract class View {
    
    public $data = [];

    public $templatesPath;

    public $templateName;

    public $fileName;

    public $path;

    public function __construct($name) {

        var_dump($this->templateName);

    }

    public static function make($name, $data = []) {

        $view = new static($name);
        $view->data = $data;
        $view->display();
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function createPath() {
        $this->path = createPath(
            $this->templatesPath,
            $this->templateName,
            $this->fileName
        );
    }

    public function display() {
        if($this->path !== FALSE) {
            extract($this->data);
            include $this->path;
        }
    }
}