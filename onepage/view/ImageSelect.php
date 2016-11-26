<?php

namespace Onepage\View;

class ImageSelect extends View {
    public function __construct($whatever) {

        $this->templatesPath = admin_template_path;
        $this->templateName = 'modal';
        $this->fileName = 'image.php';
        $this->createPath();
    }

    public static function make($irrelevant, $data = []) {
        $view = new static($irrelevant);
        $view->data = $data;
        $view->display();
    }
}