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
     * Original where Statements
     * @var array
     */
    private $whereArray = [];

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
        print_r($values);
        $model = new static();
        foreach (array_merge($model->defaults, $values) as $column => $value) {
            if(in_array($column, $model->fillable)) {
                $model->columns[] = $column;
                $model->values[] = $model->formatValue($value);
            }
        }
        $model->createInsert();
        $model->run();
    }

    /**
     * Returns the first line by the column ID
     * @param $id
     * @return object
     */
    public static function find($id) {
        return static::select()->where('id', $id)->first();
    }

    /**
     * Returns the first line by the column ID or fails
     * @param $id
     * @return object
     */
    public static function findOrFail($id) {
        return static::select()->where('id', $id)->firstOrFail();
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
     * Runs the select statement and gives back the first element
     * @return array
     */
    public function first() {
        $entries = $this->get();
        if(count($entries) !== 0) {
            return $entries[0];
        }
        return null;
    }

    /**
     * Runs the select statement and gives back the first element
     * @return array
     */
    public function firstOrFail() {
        $entries = $this->get();
        //var_dump($entries);
        if(count($entries) !== 0) {
            return $entries[0];
        }
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo 'Page not found';
        die();
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
        $this->whereArray[$key] = $val;
        $this->filters[] = tq($key) . ' = ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Inverse of the where statement
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereNot($key, $val) {
        $this->filters[] = tq($key) . ' <> ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Selects entries with a bigger value than $key
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereGreaterThan($key, $val) {
        $this->filters[] = tq($key) . ' > ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Selects entries with a smaller value than $key
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereLessThan($key, $val) {
        $this->filters[] = tq($key) . ' < ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Selects entries with a bigger or equal value than $key
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereGreaterThanOrEqual($key, $val) {
        $this->filters[] = tq($key) . ' >= ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Selects entries with a smaller or equal value than $key
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereLessThanOrEqual($key, $val) {
        $this->filters[] = tq($key) . ' <= ' . $this->formatValue($val);
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
        $this->filters[] = tq($key) . ' BETWEEN ' . $this->formatValue($min) . ' AND ' . $this->formatValue($max);
        return $this;
    }

    /**
     * Makes a where like-statement
     * @param $key
     * @param $val
     * @return $this
     */
    public function whereLike($key, $val) {
        $this->filters[] = tq($key) . ' LIKE ' . $this->formatValue($val);
        return $this;
    }

    /**
     * Makes a where in-statement
     * @param $key
     * @param $values
     * @return $this
     */
    public function whereIn($key, $values) {
        $this->filters[] = tq($key) . ' IN (' . implode(array_map([$this, 'formatValue'], $values)) . ')';
        return $this;
    }

    /**
     * Makes an order by-statement
     * @param $value
     * @param string $order
     */
    public function orderBy($value, $order = 'ASC') {
        $this->orders[] = 'ORDER BY ' . tq($value) . ' ' . $order;
        return $this;
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
        if(count($this->filters)) {
            $requestParts[] = 'WHERE';
            $requestParts[] = implode(' AND ', $this->filters);
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
     * Checks if Filters match a record and update or else create it.
     * @param array $values
     */
    public function updateOrCreate($values = []) {
        $this->createSelect();
        $this->run();
        
        if(count($this->entries) == 0) {
            return self::create($this->whereArray + $values);
        } else {
            return $this->update($values);
        }
    }

    /**
     * Makes and runs an update statement
     * @param array $values with column => value
     * @param bool $withoutWhere
     */
    public function update($values = [], $withoutWhere = false) {
        
        /* Mass update (without using a where statement) is only able if $withoutWhere is true.
         * Just for not accidently update everything. */
        if(count($this->filters) > 0 && $withoutWhere = false) {
            return false;
        }
        /* Only makes sense with at least one column to update */
        if(count($values) === 0) {
            return false;
        }
        $requestParts[] = 'UPDATE';
        $requestParts[] = $this->table;
        $requestParts[] = 'SET';
        $updates = [];
        foreach($values as $column => $value) {
            $updates[] = tq($column) . '=' . $this->formatValue($value); 
        }
        $requestParts[] = implode(',', $updates);
        if(count($this->filters)) {
            $requestParts[] = 'WHERE';
            $requestParts[] = implode(' AND ', $this->filters);
        }
        foreach ($this->orders as $order) {
            $requestParts[] = $order;
        }
        $this->request = implode(' ', $requestParts) . ';';
        return $this->run();
    }

    /**
     * Runs a created statement
     */
    public function run() {
        echo $this->request;
        return $this->entries = Capsule::select($this->request);
    }

}