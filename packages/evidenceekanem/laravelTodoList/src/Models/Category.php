<?php

namespace evidenceekanem\laravelTodoList\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function tasks()
    {
        return $this->hasMany('\evidenceekanem\laravelTodoList\Models\Task', 'category_id');
    }
}