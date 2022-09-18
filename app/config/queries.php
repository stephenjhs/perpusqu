<?php

use Illuminate\Database\Capsule\Manager as Capsule;

function sum($table, $column) {
    return Capsule::table($table)->sum($column);
}

function sumWhere($table, $column, $field, $sum) {
    return Capsule::table($table)->where($column, $field)->sum($sum);
}

function latter($table)
{
    return Capsule::table($table)->max("id");
}

function amount($table)
{
    return Capsule::table($table)->count();
}

function amountWhere($table, $column, $field)
{
    return Capsule::table($table)->where($column, $field)->count();
}

function all($table)
{
    return Capsule::table($table)->orderBy("id", "DESC")->get();
}

function allLimit($table, $limit)
{
    return Capsule::table($table)->orderBy("id", "DESC")->limit($limit)->get();
}

function allWhere($table, $column, $field)
{
    return Capsule::table($table)->where($column, $field)->orderBy("id", "DESC")->get();
}

function allBetween($table, $column, $field) {
    return Capsule::table($table)->whereBetween($column, $field)->orderBy("id", "DESC")->get();
}

function first($table)
{
    return Capsule::table($table)->first();
}

function get($table, $field)
{
    return Capsule::table($table)->where("id", $field)->first();
}

function getWhere($table, $column, $field)
{
    return Capsule::table($table)->where($column, $field)->first();
}

function pluck($table, $column, $field, $pluck) {
    return Capsule::table($table)->where($column, $field)->pluck($pluck);
}

function insert($table, $columns)
{
    return Capsule::table($table)->insert($columns);
}

function update($table, $field, $columns)
{
    return Capsule::table($table)->where("id", $field)->update($columns);
}

function updateWhere($table, $column, $field, $columns)
{
    return Capsule::table($table)->where($column, $field)->update($columns);
}

function delete($table, $field)
{
    return Capsule::table($table)->where("id", $field)->delete();
}

function deleteWhere($table, $column, $field)
{
    return Capsule::table($table)->where($column, $field)->delete();
}





































