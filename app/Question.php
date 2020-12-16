<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $fillable = ['question', 'correct_answer', 'answer2', 'answer3', 'answer4', 'category_id', 'with_image', 'image', 'active'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
