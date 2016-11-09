<?php
/**
 * Created by PhpStorm.
 * User: jasch
 * Date: 03.11.2016
 * Time: 22:44
 */

namespace Onepage\View;


class Section extends View {

    public function __construct($name) {

        $this->templatesPath = section_path;
        $this->templateName = $name;
        $this->fileName = 'template.php';
        $this->createPath();

    }

}