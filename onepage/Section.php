<?php

namespace Onepage;


class Section {
    public $name;

    public $loaded = false;

    public $path;

    public $html;

    public $css;

    public $specialCss;

    public $conf;

    public function __construct($name) {
        $this->name = $name;
        $this->path = createPath(section_path, $name);
        $paths = [
            'html' => createPath($this->path, 'template.php'),
            'css' => createPath($this->path, 'style.css'),
            'specialCss' => createPath($this->path, 'style.php'),
            'conf' => createPath($this->path, 'conf.json'),
        ];
        foreach($paths as $key => $path) {
            if($path !== false) {
                $this->$key = file_get_contents($path);
            }
        }
        $this->conf = json_decode($this->conf);
        if($this->html !== false && $this->conf !== null) {
            $this->loaded = true;
        }
    }

}