<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded =[];


    public function users()
    {
        return $this -> hasMany(Admin::class,'role_id','id');
    }
}
