<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopegetAllEmployees(){
        return Employee::all();
    }

    public function scopesaveEmpDetails($query,$emp_data){
        Employee::insert($emp_data);
    }
}
