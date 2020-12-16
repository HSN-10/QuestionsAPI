<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'score'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
