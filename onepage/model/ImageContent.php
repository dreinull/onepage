<?php

namespace Onepage\Model;

class ImageContent extends Model {
    public $defaults = [];

    public $table = 'contents_image';

    public function get() {
        $this->leftJoin('images', 'image_id', 'id');
        $entries = parent::get();
        $values = [];
        foreach ($entries as $entry) {
            $values[$entry->key] = [
                'id' => $entry->id,
                'url' => getImageUrl($entry->filename),
                'title' => $entry->title,
                'alt' => $entry->alt
            ];
        }
        return $values;
    }
}