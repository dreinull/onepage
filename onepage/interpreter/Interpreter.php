<?php

namespace Onepage\Interpreter;

class Interpreter {
    
    public $data = [];

    public $file;
    
    public $input = '';

    public $output = '';

    public function __construct() {

    }
    
    public function setFile($file) {
        $this->file = $file;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function openFile() {

    }

    public function replace() {

    }

    public function replaceForeach() {
        
    }
}