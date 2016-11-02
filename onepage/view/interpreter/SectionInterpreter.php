<?php

namespace Onepage\View\Interpreter;

class SectionInterpreter extends Interpreter {

    public $fileName = 'template.tpl';

    public static function run($section) {
        $interpreter = new static;
        $interpreter->templateFolder = $section->template;
        $interpreter->content = $section->content;

        return $interpreter->open()->replace()->get();
    }
   
}