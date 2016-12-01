<?php

namespace Onepage;


use Onepage\Model\Content;

class Section {
    public $id;

    public $template;

    public $name;

    private $filesLoaded = false;

    private $contentLoaded = false;

    public $title = '';

    public $description = '';

    public $fields = [];

    private $contents = [];

    private $templateContent = [];

    /* These vars include the file content or false if there is no file*/
    public $path = null;

    public $html = null;

    public $css = null;

    public $specialCss = null;

    public $conf = null;

    public function __construct($model) {
        $this->id = $model->id;
        $this->template = $model->template;
        $this->name = $model->name;
        $this->loadFiles();
        $this->loadContent();
    }

    public function templateContent($field = null) {
        if($this->contentLoaded === false) return null;

        if($field !== null) {
            if(array_key_exists($field, $this->templateContent)) {
                return $this->templateContent[$field];
            }
            return null;
        }

        return $this->templateContent;
    }

    private function loadFiles() {
        $this->path = createPath(section_path, $this->template);
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
            $this->title = $this->conf->title;
            $this->description = $this->conf->description;
            $this->filesLoaded = true;
            $this->fields = $this->conf->fields;
        }
    }

    private function loadContent() {
        if($this->id === null or $this->filesLoaded === false) return;

        $contents = Content::getAll($this->id);

        //if(count($contents) === 0) return;

        $this->contents = $contents;
        $this->contentLoaded = true;

        foreach ($this->fields as $field) {
            if(array_key_exists($field->name, $this->contents)) {
                $field->value = $this->contents[$field->name]->value;
                $field->id = $this->contents[$field->name]->id;
            } else {
                $field->value = null;
                $field->id = null;
            }
            $field->section = $this->id;
            $this->templateContent[$field->name] = $field->value;
        }
        $this->templateContent['id'] = 'section-' . $this->id;

    }

    public static function getAll() {
        $models = \Onepage\Model\Section::select()->get();
        $sections = [];
        foreach ($models as $model) {
            $sections[] = new static($model->template, $model->id);
        }
        return $sections;
    }

    public static function getAllForPage($page) {
        $models = \Onepage\Model\Section::select()->where('page_id', $page)->get();
        $sections = [];
        foreach ($models as $model) {
            $sections[] = new static($model);
        }
        return $sections;
    }
}