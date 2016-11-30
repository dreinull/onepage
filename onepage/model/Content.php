<?php

namespace Onepage\Model;

class Content extends Model {
    public $fillable = ['section_id', 'key', 'value'];

    public function get() {
        $entries = parent::get();
        $values = [];
        foreach ($entries as $entry) {
            $values[$entry->key] = $entry;
        }
        return $values;
    }

    /**
     * Gets all types content
     * @return array
     */
    public static function getAll($section) {
        return array_merge(
            BooleanContent::select()->where('section_id', $section)->get(),
            DateContent::select()->where('section_id', $section)->get(),
            FileContent::select()->where('section_id', $section)->get(),
            FloatContent::select()->where('section_id', $section)->get(),
            ImageContent::select()->where('section_id', $section)->get(),
            IntegerContent::select()->where('section_id', $section)->get(),
            StringContent::select()->where('section_id', $section)->get(),
            TextContent::select()->where('section_id', $section)->get(),
            TimestampContent::select()->where('section_id', $section)->get()

        );
    }
}