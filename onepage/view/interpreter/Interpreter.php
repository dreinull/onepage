<?php

namespace Onepage\View\Interpreter;

class Interpreter {

    private $values;
    
    private $find = [];

    private $replace = [];

    private $leftDelimiter = '{{ ';

    private $rightDelimiter = ' }}';

    private $templateName;

    private $fileName;
    
    private $file;

    private $input;

    private $output;

    public function open() {
        $this->input = file_get_contents($this->file);
    }

    public function replace() {
        foreach($this->values as $key => $val) {
            $this->find[] =
                $this->leftDelimiter .
                $key .
                $this->rightDelimiter;
            $this->replace[] = $val;
        }
        $this->output = str_replace($this->find, $this->replace, $this->input);
    }

    

}