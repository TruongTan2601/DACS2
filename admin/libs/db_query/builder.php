<?php

namespace DBQuery;

class Builder
{
  use Execution;

  private string $sql;
  private string $table;
  private array $columns = ["*"];
  private array $conditions = [];
  private array $assignments = [];

  public function __construct($table, $as = null)
  {
    $this->table = $table;
    $this->as = $as;
  }

  public function select(...$columns)
  {
    $this->columns = implode(", ", $columns);
    return $this;
  }

  public function where($column, $operator = null, $value = null, $boolean = "and")
  {
    $condition = new Condition($column, $operator, $value);
    Helper::pushCondition($this->conditions, $condition->build(), $boolean);
    return $this;
  }

  public function not($column, $value, $boolean = "and")
  {
    $condition = new Condition($column, "not", $value);
    Helper::pushCondition($this->conditions, $condition->build(), $boolean);
    return $this;
  }

  public function like($column, $value, $boolean = "and")
  {
    $condition = new Condition($column, "like", $value);
    Helper::pushCondition($condition, $boolean);
    return $this;
  }


  public function offset($index)
  {
    $condition = new Condition("offset $index");
    Helper::pushCondition($this->conditions, $condition->build());
    return $this;
  }

  public function limit($size)
  {
    $condition = new Condition("limit $size");
    Helper::pushCondition($this->conditions, $condition->build());
    return $this;
  }

  public function get($columns = ["*"])
  {
    $this->columns = $columns;
    return $this->execSelect();
  }

  public function first(...$columns)
  {
    $this->columns = ($columns ?? ["*"]);
    return $this->execSelectSingle();
  }

  public function pluck(...$columns)
  {
    $this->columns = $columns;
    return $this->execSelect();
  }

  public function find($column, $value)
  {
    if (!empty($this->conditions)) return false;
    $condition = new Condition($column, $value);
    Helper::pushCondition($this->conditions, $condition->build());
    return $this->execSelectSingle();
  }

  public function insert($assignments)
  {
    foreach ($assignments as $column => $value) {
      $assignment = new Assignment($column, $value);
      Helper::pushAssignment($this->assignments, $assignment->build());
    }
    return $this->execInsert();
  }

  public function update($assignments)
  {
    foreach ($assignments as $column => $value) {
      $assignment = new Assignment($column, $value);
      Helper::pushAssignment($this->assignments, $assignment->build());
    }
    return $this->execUpdate();
  }

  public function delete()
  {
    return $this->execDelete();
  }

  private function buildSelect()
  {
    $columns = implode(", ", $this->columns);
    $sql = "SELECT $columns  FROM $this->table";
    if (!empty($this->conditions)) {
      $conditions = $this->buildConditions();
      $sql = $sql . " WHERE " . $conditions;
    }
    $this->sql = $sql;
  }

  private function buildInsert()
  {
    $sql = "INSERT INTO $this->table SET " . $this->buildAssignments();
    $this->sql = $sql;
  }

  private function buildUpdate()
  {
    $sql = "UPDATE $this->table SET " . $this->buildAssignments() . " WHERE " . $this->buildConditions();
    $this->sql = $sql;
  }

  private function buildDelete()
  {
    $sql = "DELETE FROM $this->table WHERE " . $this->buildConditions();
    $this->sql = $sql;
  }

  private function buildConditions()
  {
    return implode(" ", $this->conditions);
  }

  private function buildAssignments()
  {
    return implode(", ", $this->assignments);
  }
}
