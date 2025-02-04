<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
  
    public $timestamps = true;

    protected $fillable = [];
    protected $hidden = [];

    public static function getAll()
    {
        return static::all();
    }

    public static function findById($id)
    {
        return static::find($id);
    }

    public static function create(array $attributes = [])
    {
        return static::query()->create($attributes);
    }


    public function updateRecord(array $attributes = [], array $options = [])
    {
        return $this->update($attributes, $options);
    }

    public function deleteRecord()
    {
        return $this->delete();
    }
}