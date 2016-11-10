<?php

namespace Onepage\View;


class SectionEdit extends View {

    public $config = [];

    public $fieldTemplate;

    public function __construct($name) {

        $this->templatesPath = section_path;
        $this->templateName = $name;
        $this->fileName = 'conf.json';
        $this->createPath();
        $this->config = json_decode(file_get_contents($this->path));
        $this->fieldTemplate = createPath(admin_template_path, '_field.php');
        
    }

    public function display() {
        $fields = $this->config->fields;
        $data = $this->data;
        include $this->fieldTemplate;
    }

}