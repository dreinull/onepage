<?php

namespace Onepage\Model;

class Page extends Model {

    public $table = 'pages';

    public $fillable = ['parent_id', 'visible', 'order', 'name', 'slug'];

    public $defaults = [
        'visible' => 0,
        'default' => 0
    ];

}