<?php
/**
 * Created by PhpStorm.
 * User: jasch
 * Date: 09.11.2016
 * Time: 22:32
 */

namespace Onepage;


class Section {

    public $loaded = false;

    public function __construct($name) {
        $this->path = createPath(section_path, $name);
        if($this->path == false) {
            
        }
    }

}