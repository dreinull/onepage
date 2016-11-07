<?php

namespace Onepage\Model;

use Illuminate\Database\Capsule\Manager as Capsule;

abstract class Model {

    /**
     * The table's name
     * @var string
     */
    public $table;

    /**
     * Fields for mass assignment
     * @var array
     */
    public $fillable = [];

    /**
     * List of joins
     * @var array
     */
    private $joins = [];

    /**
     * Filters for Where-Statements
     * @var array
     */
    private $filters = [];

    /**
     * Orderby-Statements
     * @var array
     */
    private $orders = [];

    private $limit = 0;

    /**
     * The columns in where the values are updated or edited
     * @var array
     */
    private $columns = [];

    /**
     * Inserted or upadted values
     * @var array
     */
    private $values = [];

    /**
     * The final SQL-Statement
     * @var string
     */
    private $request;

    /**
     * Entries selected from the database
     * @var array
     */
    private $entries = [];


    /**
     * Create select statement
     * @return static
     */
    public static function select() {
        return new static;
    }

    /**
     * Makes and runs a create statement
     * @param array $values
     */
    public static function create($values = []) {
        $model = new static();
        foreach (array_merge($model->defaults, $values) as $column => $value) {
            if(in_array($column, $model->fillable)) {
                $model->columns[] = $column;
                $model->values[] = sq($value);
            }
        }
        $model->createInsert();
        $model->run();
    }

    /**
     * Makes and runs an update statement
     * @param array $values
     */
    public static function update($values = []) {

    }

    /**
     * Runs the select statement
     * @return array
     */
    public function get() {
        $this->createSelect();
        $this->run();
        
        return $this->entries;
    }

    /**
     * Creates a left join
     * @param $foreignTable
     * @param $localKey
     * @param $foreignKey
     */
    public function leftJoin($foreignTable, $localKey, $foreignKey) {
        $this->joins[] = 'LEFT JOIN ' . $foreignTable . ' ON ' . $this->table . '.' . $localKey . '=' . $foreignTable . '.' . $foreignKey;
    }

    /**
     * Created a right join
     * @param $foreignTable
     * @param $localKey
     * @param $foreignKey
     */
    public function rightJoin($foreignTable, $localKey, $foreignKey) {
        $this->joins[] = 'RIGHT JOIN ' . $foreignTable . ' ON ' . $this->table . '.' . $localKey . '=' . $foreignTable . '.' . $foreignKey;
    }

    /**
     * Creates an inner join
     * @param $foreignTable
     * @param $localKey
     * @param $foreignKey
     */
    public function innerJoin($foreignTable, $localKey, $foreignKey) {
        $this->joins[] = 'INNER JOIN ' . $foreignTable . ' ON ' . $this->table . '.' . $localKey . '=' . $foreignTable . '.' . $foreignKey;
    }

    /**
     * Creates a full join
     * @param $foreignTable
     * @param $localKey
     * @param $foreignKey
     */
    public function fullJoin($foreignTable, $localKey, $foreignKey) {
        $this->joins[] = 'FULL OUTER JOIN ' . $foreignTable . ' ON ' . $this->table . '.' . $localKey . '=' . $foreignTable . '.' . $foreignKey;
    }

    /**
     * Makes a where statement in the query
     * @param $key
     * @param $val
     * @return $this
     */
    public function where($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' = ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Inverse of the where statement
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereNot($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' <> ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Selects entries with a bigger value than $key
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereGreaterThan($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' > ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Selects entries with a smaller value than $key
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereLessThan($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' < ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Selects entries with a bigger or equal value than $key
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereGreaterThanOrEqual($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' >= ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Selects entries with a smaller or equal value than $key
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereLessThanOrEqual($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' <= ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Selects entries with a bigger or equal value than $key
     * @param $key
     * @param $min
     * @param $max
     * @return $this
     */
    public function whereBetween($key, $min, $max) {
        $this->filters[] = 'WHERE ' . $key . ' BETWEEN ' . $this->formatValue($min) . ' AND ' . $this->formatValue($max);
        return $this;
    }

    /**
     * Makes a where like-statement
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereLike($key, $val) {
        $this->filters[] = 'WHERE ' . $key . ' LIKE ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Makes a where in-statement
     * @param $key
     * @param $values
     * @return $this
     */
    public function whereIn($key, $values) {
        $this->filters[] = 'WHERE ' . $key . ' IN (' . implode(array_map([$this, 'formatValue'], $values)) . ')';
        return $this;
    }

    /**
     * Makes an order by-statement
     * @param $value
     * @param string $order
     */
    public function orderBy($value, $order = 'ASC') {
        $this->orders[] = 'ORDER BY ' . tq($value) . ' ' . $order;
    }

    /**
     * Wraps quotes around the value if it's not numeric
     * @param $key
     * @return int|string
     */
    private function formatValue($key) {
        return is_numeric($key) ? $key : "'$key'";
    }

    /**
     * Creates the select statement as a string with all the joins, filters and orders
     */
    public function createSelect() {
        $requestParts[] = 'SELECT';
        $requestParts[] = '*';
        $requestParts[] = 'FROM';
        $requestParts[] = $this->table;
        foreach ($this->joins as $join) {
            $requestParts[] = $join;
        }
        foreach ($this->filters as $filter) {
            $requestParts[] = $filter;
        }
        foreach ($this->orders as $order) {
            $requestParts[] = $order;
        }
        $this->request = implode(' ', $requestParts) . ';';
    }

    /**
     * Creates a create statement with all the colums and values
     */
    public function createInsert() {
        $requestParts[] = 'INSERT INTO';
        $requestParts[] = $this->table;
        $requestParts[] = '(' . implode(', ', $this->columns) . ')';
        $requestParts[] = 'VALUES';
        $requestParts[] = '(' . implode(',', $this->values) . ')';
        $this->request = implode(' ', $requestParts) . ';';
    }

    /**
     * Runs a created statement
     */
    public function run() {
        $this->entries = Capsule::select($this->request);
    }

}