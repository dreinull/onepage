<?php

namespace Onepage\View;

class SpecialCss extends View {

    public function __construct($name) {

        $this->templatesPath = section_path;
        $this->templateName = $name;
        $this->fileName = 'style.php';
        $this->createPath();

    }
}