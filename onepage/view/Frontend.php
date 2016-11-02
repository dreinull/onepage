<?php

namespace Onepage\View;

use Onepage\View\Interpreter\Interpreter;
use Onepage\View\Interpreter\SectionInterpreter;

class Frontend extends View {
    
    private $sections;

    public function __construct($sections) {
        $this->sections = $sections;
        $this->interpretSections();
        $this->loadDefaults();
        echo $this->render();
    }
    
    public function loadDefaults() {
        $this->addStart($this->interpretStart());
        $this->addEnd($this->readTemplate('end.php'));
    }
    
    public function readTemplate($name) {
        $file = createPath(template_path, $name);
        if($file)
            return file_get_contents($file);
    }

    private function interpretStart() {
        return Interpreter::run(
            $this->readTemplate('start.php'), [
                'title' => \Onepage\Config::app('name'),
                'description' => \Onepage\Config::app('description'),
                'keywords' => \Onepage\Config::app('keywords')
            ]
        );
    }

    private function interpretSections() {
        foreach ($this->sections as $section) {
            $this->addContent(SectionInterpreter::run($section));
        }

    }

}