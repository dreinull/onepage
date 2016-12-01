<?php

namespace Onepage\View;


class SectionEdit extends View {

    public $config = [];

    public $fieldTemplate;

    public function __construct($name) {

        $this->templatesPath = admin_template_path;
        $this->templateName = null;
        $this->fileName = '_field.php';
        $this->createPath();
        $this->config = json_decode(file_get_contents($this->path));
        $this->fieldTemplate = createPath(admin_template_path, '_field.php');
        
    }

}