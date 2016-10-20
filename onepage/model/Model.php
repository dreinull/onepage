<?php

namespace Onepage\Model;

use Illuminate\Database\Capsule\Manager as Capsule;

abstract class Model {

    public $table;

    private $filters = [];

    private $orders = [];

    private $limit = 0;

    private $request;

    private $entries = [];

    public static function select() {
        return new static;
    }
    
    public function get() {
        $this->createRequest();
        $this->run();
        
        return $this->entries;
    }

    public function where($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' = ' . $this->formatValue($val);
        return $this;
    }

    public function whereNot($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' <> ' . $this->formatValue($val);
        return $this;
    }

    public function whereGreaterThan($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' > ' . $this->formatValue($val);
        return $this;
    }

    public function whereLessThan($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' < ' . $this->formatValue($val);
        return $this;
    }

    public function whereGreaterThanOrEqual($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' >= ' . $this->formatValue($val);
        return $this;
    }

    public function whereLessThanOrEqual($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' <= ' . $this->formatValue($val);
        return $this;
    }

    public function whereBetween($key, $min, $max) {
        $this->filters[] = 'WHERE ' . $key . ' BETWEEN ' . $this->formatValue($min) . ' AND ' . $this->formatValue($max);
        return $this;
    }
    
    public function whereLike($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' LIKE ' . $this->formatValue($val);
        return $this;
    }

    public function whereIn($key, $values) {
        $this->filters[] = 'WHERE ' . $key . ' IN (' . implode(array_map([$this, 'formatValue'], $values)) . ')';
        return $this;
    }

    public function orderBy($value, $order = 'ASC') {
        $this->orders[] = 'ORDER BY ' . $value . ' ' . $order;
    }

    private function formatValue($key) {
        return is_numeric($key) ? $key : "'$key'";
    }

    public function createRequest() {
        $requestParts[] = 'select';
        $requestParts[] = '*';
        $requestParts[] = 'from';
        $requestParts[] = $this->table;
        foreach ($this->filters as $filter) {
            $requestParts[] = $filter;
        }
        foreach ($this->orders as $order) {
            $requestParts[] = $order;
        }
        $this->request = implode(' ', $requestParts) . ';';
    }

    public function run() {
        $this->entries = Capsule::select($this->request);
    }

    



    /*
    protected static function getSections() {
        $sections = Capsule::select('select * from sections');
        foreach($sections as $section) {
            $section->contents = Capsule::select('select * from contents where section_id = ' . $section->id);
        }
        return $sections;
    }
    */
}