<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'image'];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
    public function supCategories()
    {
        return $this->hasMany(Category::class,'main_category_id');
    }
    public function mainCategory()
    {
        return $this->belongsTo(Category::class,'main_category_id');
    }
}
