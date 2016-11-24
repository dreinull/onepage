<?php

namespace Onepage\Model;

class Section extends Model {
    public $table = 'sections';
    public $defaults = [
        'visible' => 1,
        'order' => 0,
    ];
    public $fillable = ['page_id', 'template', 'name', 'order', 'visible'];

    private $withInvisible = false;

    public function get() {
        if($this->withInvisible === false) {
            $this->where('visible', 1);
        }

        $this->orderBy('order');

        $entries = parent::get();
        foreach ($entries as $section) {
            $section->content = Content::getAll($section->id);
        }
        return $entries;
    }

    public function withInsisible() {
        $this->withInvisible = true;
    }  
}