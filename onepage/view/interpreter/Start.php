<?php

namespace Onepage\View\Interpreter;

use Onepage\Config;

class Start extends Interpreter {
    
    private function getContent() {
        return [
            'title' => Config::app('name'),
            'description' => Config::app('description'),
            'keywords' => Config::app('keywords')
        ];
    }
    
    public static function run($file) {
        $interpreter = new self;
        
        $interpreter->input = $file;
        $interpreter->content = $interpreter->getContent(); 
        return $interpreter->replace()->get();
    }
}