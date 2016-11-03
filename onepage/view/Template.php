<?php
/**
 * Created by PhpStorm.
 * User: jasch
 * Date: 03.11.2016
 * Time: 22:01
 */

namespace Onepage\View;


class Template extends View {

    public function __construct($name) {

        $this->templatesPath = template_path;
        $this->templateName = '.';
        $this->fileName = $name . '.php';
        $this->createPath();

    }
}