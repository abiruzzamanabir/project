<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function author()
    {
        return $this-> belongsTo(Admin::class,'admin_id','id');
    }
    public function category()
    {
        return $this-> belongsToMany(PostCategory::class);
    }
    public function tag()
    {
        return $this-> belongsToMany(Tag::class);
    }
}
