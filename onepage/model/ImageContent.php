<?php

namespace Onepage\Model;

class ImageContent extends Model {
    public $defaults = [];

    public $table = 'contents_image';

    public function get() {
        $this->leftJoin('images', 'value', 'id');
        $entries = parent::get();
        $values = [];
        foreach ($entries as $entry) {
            /*$values[$entry->key] = [
                'id' => $entry->id,
                'filename' => $entry->filename,
                'url' => getImageUrl($entry->filename),
                'title' => $entry->title,
                'alt' => $entry->alt
            ];*/
            $values[$entry->key] = $entry;
            $values[$entry->key]->url = getImageUrl($entry->filename);
            $values[$entry->key]->value = $values[$entry->key]->url;
        }
        return $values;
    }
}