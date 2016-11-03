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
    
    public static function create() {
        return self;
    }
    
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
        return $this;
    }
    
    public function addStart($line) {
        if(!$line) return;
        $this->start[] = $line;
        return $this;
    }
    
    public function addHeader($line) {
        if(!$line) return;
        $this->header[] = $line;
        return $this;
    }
    
    public function addNavigation($line) {
        if(!$line) return;
        $this->navigation[] = $line;
        return $this;
    }
    
    public function addContent($line) {
        if(!$line) return;
        $this->content[] = $line;
        return $this;
    }
    
    public function addFooter($line) {
        if(!$line) return;
        $this->footer[] = $line;
        return $this;
    }
    
    public function addScript($line) {
        if(!$line) return;
        $this->scripts[] = $line;
        return $this;
    }
    
    public function addEnd($line) {
        if(!$line) return;
        $this->end[] = $line;
        return $this;
    }
    
    public function addTemplate($template) {
        $parts = explode('{{ content }}', $template);
        $this
            ->addStart($parts[0])
            ->addEnd($parts[1]);
        return $this;
    }
    
    
}