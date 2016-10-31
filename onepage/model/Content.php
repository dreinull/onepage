<?php
/**
 * Created by PhpStorm.
 * User: jasch
 * Date: 31.10.2016
 * Time: 10:14
 */

namespace Onepage\Model;


use Onepage\Model\Content\BooleanContent;
use Onepage\Model\Content\FloatContent;
use Onepage\Model\Content\IntegerContent;
use Onepage\Model\Content\StringContent;
use Onepage\Model\Content\TextContent;
use Onepage\Model\Content\TimestampContent;

class Content extends Model {
    public function get() {
        $entries = parent::get();
        $values = [];
        foreach ($entries as $entry) {
            $values[$entry->key] = $entry->value;
        }
        return $values;
    }

    public function getAll() {
        return array_merge(
            BooleanContent::select()->get(),
            FloatContent::select()->get(),
            IntegerContent::select()->get(),
            StringContent::select()->get(),
            TextContent::select()->get(),
            TimestampContent::select()->get()
        );
    }
}