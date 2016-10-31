<?php

namespace Onepage\View\Interpreter;

abstract class Interpreter {

    public $content;
    
    public $find = [];

    public $replace = [];

    public $leftDelimiter = '{{ ';

    public $rightDelimiter = ' }}';

    public $templateFolder;
    
    public $fileName;
    
    public $file;

    public $input;

    public $output;

    public function open() {
        $this->file = createPath(template_path, $this->templateFolder, $this->fileName);
        $this->input = file_get_contents($this->file);
        return $this;
    }

    public function replace() {
        foreach($this->content as $key => $value) {
            $this->find[] =
                $this->leftDelimiter .
                $key .
                $this->rightDelimiter;
            $this->replace[] = $value;
        }
        $this->output = str_replace($this->find, $this->replace, $this->input);
        return $this;
    }

    public function get() {
        return $this->output;
    }
}