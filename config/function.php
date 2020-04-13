<?php

include "server.php"; 

function run_query($sql)
{
  return mysqli_query($GLOBALS['sqlconn'], $sql);
}

function query_get_row($sql)
{
  return mysqli_fetch_assoc(run_query($sql));
}

function db_insert($table, $data)
{
  $field = "";
  $values = "";
  foreach ($data as $key => $value) {
    $field = $field . "$key, ";
    $values = $values . "'$value', ";
  }
  $resfield = substr($field, 0, strlen($field) - 2);
  $resvalue = substr($values, 0, strlen($values) - 2);
  $sql = "INSERT INTO $table ($resfield) VALUES ($resvalue);";
  echo $sql;
  $query = run_query($sql);
}

function db_update($table, $data, $where)
{
  $setvalue = "";
  $where_ = "";
  foreach ($data as $key => $value) {
    $setvalue = $setvalue . "$key = '$value', ";
  }
  foreach ($where as $key => $value) {
    $where_ = $where_ . "$key = '$value'";
  }
  $resvalue = substr($setvalue, 0, strlen($setvalue) - 2);
  $sql = "UPDATE $table SET $resvalue WHERE $where_";
  $query = run_query($sql);
  echo "$sql";
}

?>