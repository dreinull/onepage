<?php

namespace Onepage\Model;

class Image extends Model {
    public $defaults = [
        'title' => null,
        'alt' => null
    ];

    public $table = 'images';
}