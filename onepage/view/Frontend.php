<?php

namespace Onepage\View;

use Onepage\View\Interpreter\Interpreter;
use Onepage\View\Interpreter\Start;
use Onepage\View\Interpreter\Section;

class Frontend extends View {
    
    private $sections;

    public function __construct($sections) {
        $this->sections = $sections;
        $this->interpretSections();
        $this->loadDefaults();
        return $this;
    }
    
    public function loadDefaults() {
        $this->addStart(Start::run($this->readTemplate('start.php')));
        $this->addEnd($this->readTemplate('end.php'));
    }
    
    public function readTemplate($name) {
        $file = createPath(template_path, $name);
        if($file) {
            return file_get_contents($file);
        }
        return null;
    }

    private function interpretStart() {
        return Start::run(
            $this->readTemplate('start.php'), [
                'title' => \Onepage\Config::app('name'),
                'description' => \Onepage\Config::app('description'),
                'keywords' => \Onepage\Config::app('keywords')
            ]
        );
    }

    private function interpretSections() {
        foreach ($this->sections as $section) {
            $this->addContent(Section::run($section));
        }

    }

}