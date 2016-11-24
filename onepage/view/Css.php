<?php

namespace Onepage\View;


class Css extends View {

    public function __construct($name) {

        $this->templatesPath = section_path;
        $this->templateName = $name;
        $this->fileName = 'style.css';
        $this->createPath();

    }
}