<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    protected $fillable = ['id', 'first_name', 'last_name', 'job_title', 'salary', 'period'];
    // use SoftDeletes;
    public static function createIfNotExist($req){

        $result = self::where($req)->first();
        if(!empty($result)){
            return false;
        }
        return self::create($req);
    }
}
