<?php

namespace Onepage\View;

use Onepage\View\Interpreter\SectionInterpreter;

class View {
    
    private $start = [];
    
    private $header = [];

    private $navigation = [];
    
    private $content = [];
    
    private $footer = [];
    
    private $scripts = [];
    
    private $end = [];
    
    public function render() {
        return implode([
            implode($this->start),
            implode($this->header),
            implode($this->navigation),
            implode($this->content),
            implode($this->footer),
            implode($this->scripts),
            implode($this->end),
        ]);
    }
    
    public function addStart($line) {
        if(!$line) return;
        $this->start[] = $line;
    }
    
    public function addHeader($line) {
        if(!$line) return;
        $this->header[] = $line;
    }
    
    public function addNavigation($line) {
        if(!$line) return;
        $this->navigation[] = $line;
    }
    
    public function addContent($line) {
        if(!$line) return;
        $this->content[] = $line;
    }
    
    public function addFooter($line) {
        if(!$line) return;
        $this->footer[] = $line;
    }
    
    public function addScript($line) {
        if(!$line) return;
        $this->scripts[] = $line;
    }
    
    public function addEnd($line) {
        if(!$line) return;
        $this->end[] = $line;
    }
}