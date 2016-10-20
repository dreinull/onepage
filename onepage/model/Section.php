<?php

namespace Onepage\Model;

class Section extends Model {
    public $table = 'sections';

    private $withInvisible = false;

    public function get() {
        if($this->withInvisible === false) {
            $this->where('visible', 1);
        }

        $entries = parent::get();
        foreach ($entries as $section) {
            $section->contents = (object) Content::select()->where('section_id', $section->id)->get();
            foreach ($section->contents as $content) {
                $key = $content->key;
                $section->$key = $content->value;
            }
        }
        
        return $entries;
    }

    public function withInsisible() {
        $this->withInvisible = true;
    }  
}