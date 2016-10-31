<?php

namespace Onepage\View;

use Onepage\View\Interpreter\HtmlInterpreter;

class View {
    
    private $sections;

    private $sectionOutput = [];

    public function __construct($sections) {
        $this->sections = $sections;
        $this->interpretSections();
        $this->doTemplateStuff();
    }

    private function interpretSections() {
        foreach ($this->sections as $section) {
            $this->sectionOutput[] = HtmlInterpreter::run($section);
        }

    }

    private function doTemplateStuff() {
        $sections = $this->sectionOutput;
        include template_path . DIRECTORY_SEPARATOR . 'page.php';
    }
}