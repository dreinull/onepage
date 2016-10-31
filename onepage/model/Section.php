<?php

namespace Onepage\Model;

class Section extends Model {
    public $table = 'sections';

    private $withInvisible = false;

    public function get() {
        if($this->withInvisible === false) {
            $this->where('visible', 1);
        }

        $this->orderBy('order');

        $entries = parent::get();
        foreach ($entries as $section) {
            $section->content = Content::select()->getAll();
        }
        return $entries;
    }

    public function withInsisible() {
        $this->withInvisible = true;
    }  
}